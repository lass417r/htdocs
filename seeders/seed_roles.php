<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/Faker/autoload.php';
$faker = Faker\Factory::create();

try {

  $db = _db();
  $q = $db->prepare('DROP TABLE IF EXISTS roles');
  $q->execute();

  $q = $db->prepare('
    CREATE TABLE roles(
      role_id           int NOT NULL AUTO_INCREMENT,
      role_name         TEXT,
      role_created_at   TEXT,
      role_updated_at   TEXT,
      PRIMARY KEY (role_id)
    )
  ');
  $q->execute();
  $created_at = time();
  $q = $db->prepare(" INSERT INTO roles VALUES 
                      (null, 'partner', $created_at, 0),
                      (null, 'customer', $created_at, 0),
                      (null, 'employee', $created_at, 0)");
  $q->execute();

  echo "+ roles" . PHP_EOL;
} catch (Exception $e) {
  echo $e;
}
