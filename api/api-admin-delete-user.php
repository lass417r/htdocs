<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../_.php';
try {

  $user_id = $_POST['user_id'];

  $db = _db();
  $sql = $db->prepare('UPDATE users SET user_deleted_at = :user_deleted_at, user_updated_at = :user_updated_at WHERE user_id = :user_id');
  $sql->bindValue(':user_deleted_at', time());
  $sql->bindValue(':user_updated_at', time());
  $sql->bindValue(':user_id', $user_id);
  $sql->execute();
} catch (Exception $e) {
  $status_code = !ctype_digit($e->getCode()) ? 500 : $e->getCode();
  $message = strlen($e->getMessage()) == 0 ? 'error - ' . $e->getLine() : $e->getMessage();
  http_response_code($status_code);
  echo json_encode(['info' => $message]);
}
