<?php
require_once __DIR__ . '/../_.php';
try {

  $item_id = $_POST['item_id'];

  $db = _db();
  $q = $db->prepare('
  UPDATE items
    SET item_deleted_at = :time
    WHERE item_id = :item_id
    AND item_created_by_user_fk = :user_id
   
  ');
  $q->bindValue(':time', time());
  $q->bindValue(':item_id', $item_id);
  $q->bindValue(':user_id', $_SESSION['user_id']);
  $q->execute();

  echo json_encode(['info' => 'it worked :)']);
} catch (Exception $e) {
  $status_code = !ctype_digit($e->getCode()) ? 500 : $e->getCode();
  $message = strlen($e->getMessage()) == 0 ? 'error - ' . $e->getLine() : $e->getMessage();
  http_response_code($status_code);
  echo json_encode(['info' => $message]);
}
