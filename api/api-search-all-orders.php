<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../_.php';
try {

  $search = $_POST['query'] ?? '';
  // Trim and sanitize the search query
  $search = htmlspecialchars(trim($search), ENT_QUOTES, 'UTF-8');

  $db = _db();
  $q = $db->prepare('
    SELECT *
    FROM orders
    WHERE order_id LIKE :order_id
    OR order_created_by_user_fk LIKE :order_created_by
  ');
  $q->bindValue(':order_id', '%' . $search . '%');
  $q->bindValue(':order_created_by', '%' . $search . '%');
  $q->execute();
  $orders = $q->fetchAll();
  echo json_encode($orders);
} catch (Exception $e) {
  $status_code = !ctype_digit($e->getCode()) ? 500 : $e->getCode();
  $message = strlen($e->getMessage()) == 0 ? 'error - ' . $e->getLine() : $e->getMessage();
  http_response_code($status_code);
  echo json_encode(['info' => $message]);
}
