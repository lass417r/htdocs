<?php
require_once __DIR__ . '/../_.php';

try {

  $db = _db();
  $q = $db->prepare('DROP TABLE IF EXISTS login_attempts');
  $q->execute();

  $q = $db->prepare('
    CREATE TABLE login_attempts(
      id                SERIAL PRIMARY KEY,
      ip_address        varchar(45),
      user_login_email  varchar(255),
      attempt_time      datetime
    )
  ');
  $q->execute();

  echo "+ login_attempts" . PHP_EOL;
} catch (Exception $e) {
  echo $e;
}
