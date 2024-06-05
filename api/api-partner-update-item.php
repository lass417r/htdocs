<?php
require_once __DIR__ . '/../_.php';

try {
  // Check if user is logged in
  if (!isset($_SESSION['user'])) {
    throw new Exception('User not logged in', 401);
  }

  // Validate and sanitize input
  if (!isset($_POST['item_name']) || !isset($_POST['item_price']) || !isset($_POST['item_id'])) {
    throw new Exception('Missing required fields', 400);
  }

  $item_name = htmlspecialchars(trim($_POST['item_name']), ENT_QUOTES, 'UTF-8');
  $item_price = filter_var(trim($_POST['item_price']), FILTER_VALIDATE_FLOAT);
  $item_id = filter_var(trim($_POST['item_id']), FILTER_VALIDATE_INT);
  $item_created_by_user_fk = $_SESSION['user']['user_id'];

  if ($item_price === false || $item_id === false) {
    throw new Exception('Invalid input format', 400);
  }

  // Get database connection
  $db = _db();

  // Prepare the update query
  $q = $db->prepare('
    UPDATE items
    SET item_name = :item_name, 
        item_price = :item_price, 
        item_updated_at = :item_updated_at 
    WHERE item_id = :item_id
      AND item_created_by_user_fk = :item_created_by_user_fk
    ');

  // Bind the parameters securely
  $q->bindValue(':item_name', $item_name, PDO::PARAM_STR);
  $q->bindValue(':item_price', $item_price, PDO::PARAM_STR);
  $q->bindValue(':item_updated_at', time(), PDO::PARAM_INT);
  $q->bindValue(':item_id', $item_id, PDO::PARAM_INT);
  $q->bindValue(':item_created_by_user_fk', $item_created_by_user_fk, PDO::PARAM_INT);

  // Execute the query
  $q->execute();

  // Check if any rows were updated
  if ($q->rowCount() == 0) {
    throw new Exception('No rows updated', 400);
  }

  // Return success message
  echo json_encode(['info' => 'Product updated successfully']);
} catch (Exception $e) {
  // Handle exceptions and set appropriate HTTP status code
  $status_code = !ctype_digit((string)$e->getCode()) ? 500 : $e->getCode();
  $message = strlen($e->getMessage()) == 0 ? 'error - ' . $e->getLine() : $e->getMessage();
  http_response_code($status_code);
  echo json_encode(['info' => $message]);
}
