<?php

require_once __DIR__ . '/../_.php';
try {

  $db = _db();
  $q = $db->prepare('
      INSERT INTO items 
      (item_name, item_price, item_created_at, item_updated_at, item_deleted_at, item_created_by_user_fk, item_private)
      VALUES 
      (:item_name, :item_price, :item_created_at, :item_updated_at, :item_deleted_at, :item_created_by_user_fk, :item_private)
    ');
  $q->bindValue(':item_name', $_POST['add_item_name']);
  $q->bindValue(':item_price', $_POST['add_item_price']);
  $q->bindValue(':item_created_at', time());
  $q->bindValue(':item_updated_at', time());
  $q->bindValue(':item_deleted_at', 0);
  $q->bindValue(':item_created_by_user_fk', $_SESSION['user_id']);
  $q->bindValue(':item_private', 0);
  $q->execute();


  echo json_encode(['success' => 'Item added successfully']);
} catch (Exception $e) {
  $status_code = !ctype_digit($e->getCode()) ? 500 : $e->getCode();
  $message = strlen($e->getMessage()) == 0 ? 'An error occurred' : $e->getMessage();
  http_response_code($status_code);
  echo json_encode(['error' => $message]);
}
