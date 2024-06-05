<?php
require_once __DIR__ . '/../_.php';


try {
  $db = _db();
  $q = $db->prepare('
    SELECT * FROM items
    WHERE item_id = :item_id
    AND item_created_by_user_fk = :item_created_by_user_fk
  ');
  $q->bindValue(':item_id', $_GET['item_id']);
  $q->bindValue(':item_created_by_user_fk', $_SESSION['user_id']);
  $q->execute();

  $item = $q->fetch(PDO::FETCH_ASSOC);

  if ($item) {
    echo json_encode(['item' => $item]);
  } else {
    echo json_encode(['info' => 'No item found']);
  }
} catch (Exception $e) {
  $status_code = !ctype_digit($e->getCode()) ? 500 : $e->getCode();
  $message = strlen($e->getMessage()) == 0 ? 'error - ' . $e->getLine() : $e->getMessage();
  http_response_code($status_code);
  echo json_encode(['error' => $message]);
}
