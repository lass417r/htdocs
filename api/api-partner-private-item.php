<?php
require_once __DIR__ . '/../_.php';
try {
  // Retrieve form data
  $item_id = $_POST['item_id'];
  $private_status = $_POST['private_status'];

  // Database connection
  $db = _db();

  // Update query
  $q = $db->prepare('
    UPDATE items
    SET item_private = :private_status
    WHERE item_id = :item_id
    AND item_created_by_user_fk = :user_id
  ');

  // Bind parameters
  $q->bindValue(':private_status', $private_status, PDO::PARAM_INT);
  $q->bindValue(':item_id', $item_id, PDO::PARAM_INT);
  $q->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

  // Execute query
  $q->execute();

  // Success response
  echo json_encode(['info' => 'it worked :)']);
} catch (Exception $e) {
  // Error handling
  $status_code = is_numeric($e->getCode()) ? (int)$e->getCode() : 500;
  $message = !empty($e->getMessage()) ? $e->getMessage() : 'error - ' . $e->getLine();
  http_response_code($status_code);
  echo json_encode(['info' => $message]);
}
