<?php
header('Content-Type: application/json'); // Set the content type to JSON
require_once __DIR__ . '/../_.php'; // Include the required file for database connection and other functions

try {
  // Get the search query from POST request, default to an empty string if not set
  $search = $_POST['query'] ?? '';
  // Trim and sanitize the search query
  $search = htmlspecialchars(trim($search), ENT_QUOTES, 'UTF-8');

  // Establish a secure database connection
  $db = _db();

  // Prepare the SQL query using prepared statements to prevent SQL injection
  $q = $db->prepare('
  SELECT items.*, partners.partner_name, partners.user_partner_id
  FROM items 
  INNER JOIN users ON items.item_created_by_user_fk = users.user_id 
  INNER JOIN partners ON users.user_id = partners.user_partner_id 
  WHERE (items.item_name LIKE :item_name OR partners.partner_name LIKE :partner_name)
  AND items.item_deleted_at = 0
  AND items.item_private = 0
  ORDER BY partners.partner_name, partners.user_partner_id
  ');

  // Bind the search parameters securely
  $q->bindValue(':item_name', '%' . $search . '%', PDO::PARAM_STR);
  $q->bindValue(':partner_name', '%' . $search . '%', PDO::PARAM_STR);

  // Execute the query
  $q->execute();

  // Fetch all results
  $items = $q->fetchAll();

  // Return the results as a JSON response
  echo json_encode($items);
} catch (Exception $e) {
  // Determine the status code to return based on the exception
  $status_code = !ctype_digit((string)$e->getCode()) ? 500 : $e->getCode();
  // Determine the message to return based on the exception
  $message = strlen($e->getMessage()) == 0 ? 'error - ' . $e->getLine() : $e->getMessage();

  // Set the HTTP response code
  http_response_code($status_code);

  // Return the error message as a JSON response
  echo json_encode(['info' => $message]);
}
