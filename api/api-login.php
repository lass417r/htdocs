<?php
require_once __DIR__ . '/../_.php';

function rate_limit_by_ip($ip)
{
  $db = _db();
  $q = $db->prepare('SELECT COUNT(*) as attempts, MAX(attempt_time) as last_attempt FROM login_attempts WHERE ip_address = :ip AND attempt_time > DATE_SUB(NOW(), INTERVAL 1 HOUR)');
  $q->bindValue(':ip', $ip);
  $q->execute();
  $result = $q->fetch();

  if ($result['attempts'] >= 10 && strtotime($result['last_attempt']) > strtotime('-1 hour')) {
    throw new Exception('Too many login attempts from this IP address. Please try again later.', 429);
  }

  $q = $db->prepare('INSERT INTO login_attempts (ip_address, user_login_email, attempt_time) VALUES (:ip, :user_login_email, NOW())');
  $q->bindValue(':ip', $ip);
  $q->bindValue(':user_login_email', $_POST['user_email']);
  $q->execute();
}

function rate_limit_by_user($user)
{
  if ($user['lockout_time'] && strtotime($user['lockout_time']) > time()) {
    throw new Exception('Too many login attempts for this user. Please try again later.', 403);
  }
}

try {
  _validate_user_email();
  _validate_user_password();

  $ip_address = $_SERVER['REMOTE_ADDR'];
  rate_limit_by_ip($ip_address);

  $db = _db();
  $q = $db->prepare('SELECT * FROM users WHERE user_email = :user_email');
  $q->bindValue(':user_email', $_POST['user_email']);
  $q->execute();
  $user = $q->fetch();

  if (!$user || !isset($user)) {
    throw new Exception('Invalid credentials', 400);
  }

  rate_limit_by_user($user);

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
    $q = $db->prepare('UPDATE users SET login_attempts = login_attempts + 1 WHERE user_email = :user_email');
    $q->bindValue(':user_email', $_POST['user_email']);
    $q->execute();

    // Check if login attempts exceed the limit
    if ($user['login_attempts'] + 1 >= 5) {
      $lockoutTime = date('Y-m-d H:i:s', strtotime('+30 minutes')); // lockout for 30 minutes
      $q = $db->prepare('UPDATE users SET lockout_time = :lockout_time WHERE user_email = :user_email');
      $q->bindValue(':lockout_time', $lockoutTime);
      $q->bindValue(':user_email', $_POST['user_email']);
      $q->execute();
    }
    throw new Exception('Invalid password', 400);
  }

  // Reset login attempts on successful login
  $q = $db->prepare('UPDATE users SET login_attempts = 0, lockout_time = NULL WHERE user_email = :user_email');
  $q->bindValue(':user_email', $_POST['user_email']);
  $q->execute();

  // Regenerate session ID to prevent session fixation
  session_regenerate_id(true);
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
