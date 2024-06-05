<?php
require_once __DIR__ . '/../_.php';

try {

  $db = _db();
  $q = $db->prepare('DROP TABLE IF EXISTS comments');
  $q->execute();

  $q = $db->prepare('
    CREATE TABLE comments(
      comment_id        SERIAL PRIMARY KEY,
      fk_order_id       bigint(20),
      created_at        timestamp,
      name              varchar(20),
      comment           varchar(140)
    )
  ');
  $q->execute();

  echo "+ comments" . PHP_EOL;
} catch (Exception $e) {
  echo $e;
}
