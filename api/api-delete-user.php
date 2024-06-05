<?php
require_once __DIR__ . '/../_.php';
try {
  session_start();
  if (!isset($_SESSION['user']['user_id'])) {
    throw new Exception('user not logged', 400);
  }
  $user_id = $_SESSION['user']['user_id'];
  $db = _db();
  $q = $db->prepare('
    UPDATE users
    SET user_deleted_at = :time
    WHERE user_id = :user_id
  ');
  $q->bindValue(':time', time());
  $q->bindValue(':user_id', $user_id);
  $q->execute();
  $counter = $q->rowCount();
  if ($counter != 1) {
    throw new Exception('could not delete user', 500);
  }
  http_response_code(204);

  session_destroy();
  header("Refresh:0");
  exit();
} catch (Exception $e) {
  try {
    if (!$e->getCode() || !$e->getMessage()) {
      throw new Exception();
    }
    http_response_code($e->getCode());
    echo json_encode(['info' => $e->getMessage()]);
  } catch (Exception $ex) {
    http_response_code(500);
    echo json_encode($ex);
  }
}
