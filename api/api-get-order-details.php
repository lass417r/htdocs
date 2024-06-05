<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../_.php';
try {
  $order_id = $_GET['id'] ?? '';
  $db = _db();
  $q = $db->prepare('
  SELECT `item_name`, `item_price`, `orders_items_item_quantity`, `orders_items_total_price` FROM `orders_items`
  INNER JOIN `items` ON `orders_items`.`orders_items_item_fk` = `items`.`item_id` WHERE `orders_items_order_fk` = :order_id
  ');
  $q->bindValue(':order_id', $order_id);
  $q->execute();
  $order = $q->fetchAll();
  echo json_encode($order);
} catch (Exception $e) {
  $status_code = !ctype_digit($e->getCode()) ? 500 : $e->getCode();
  $message = strlen($e->getMessage()) == 0 ? 'error - ' . $e->getLine() : $e->getMessage();
  http_response_code($status_code);
  echo json_encode(['info' => $message]);
}
