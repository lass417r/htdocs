<?php
require_once __DIR__ . '/../_.php';
try {

  _validate_user_email();
  _validate_user_password();

  $db = _db();
  // $q = $db->prepare('SELECT * FROM users WHERE user_email = :user_email');
  // $q = $db->prepare('SELECT * FROM users WHERE user_email = $_POST['user_email]');
  $q = $db->prepare('CALL login(:user_email)');
  $q->bindValue(':user_email', $_POST['user_email']);
  $q->execute();
  $user = $q->fetch();


  if (!$user || !isset($user)) {
    throw new Exception('Invalid credentials', 400);
  }

  // Check if user is blocked
  if ($user['user_is_blocked'] != 0) {
    throw new Exception('Invalid credentials', 400);
  }

  // Check if user is deleted
  if ($user['user_deleted_at'] != 0) {
    throw new Exception('Invalid credentials', 400);
  }

  // Check if the found user has a valid password
  if (!password_verify($_POST['user_password'], $user['user_password'])) {
    throw new Exception('Invalid password', 400);
  }

  $_SESSION['user'] = $user;
  $_SESSION['user_id'] = $user['user_id'];



  echo json_encode($_SESSION['user']);
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
