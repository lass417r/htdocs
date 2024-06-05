<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/Faker/autoload.php';
$faker = Faker\Factory::create();

try {

  // Get users whos role is "customer" to assign to orders
  $user_role_name = 'customer';
  $db = _db();
  $q = $db->prepare("SELECT user_id FROM users WHERE user_role_name = '$user_role_name'");
  $q->execute();
  $users_ids = $q->fetchAll(PDO::FETCH_COLUMN);

  // Get employees assign to orders
  $user_role_name = 'employee';

  $q = $db->prepare("SELECT user_id FROM users WHERE user_role_name = '$user_role_name'");
  $q->execute();
  $employees_ids = $q->fetchAll(PDO::FETCH_COLUMN);

  $q = $db->prepare("SELECT user_partner_id FROM partners");
  $q->execute();
  $partners_ids = $q->fetchAll(PDO::FETCH_COLUMN);

  // Get items_ids to assign to order
  $q = $db->prepare("SELECT item_id FROM items");
  $q->execute();
  $items_ids = $q->fetchAll(PDO::FETCH_COLUMN);

  $db = _db();
  $q = $db->prepare('DROP TABLE IF EXISTS orders');
  $q->execute();

  $q = $db->prepare('
    CREATE TABLE orders(
      order_id                      int NOT NULL AUTO_INCREMENT,
      order_created_by_user_fk      int,
      order_created_at              TEXT,
      order_updated_at              TEXT,
      order_deleted_at              TEXT,
      order_delivered_at            TEXT,
      order_delivered_by_user_fk    int,
      order_placed_at_partner_fk    int,
      PRIMARY KEY (order_id)
    )
  ');
  $q->execute();

  $values = '';
  for ($i = 0; $i < 100; $i++) {
    $order_created_by_user_fk = $users_ids[array_rand($users_ids)];
    $order_created_at = time();
    $order_updated_at = 0;
    $order_deleted_at = 0;
    $order_delivered_at = rand(0, 1) ? rand($order_created_at, $order_created_at + 60 * 60 * 24 * 30) : 0;
    $order_delivered_by_user_fk = $employees_ids[array_rand($employees_ids)];
    $order_placed_at_partner_fk = $partners_ids[array_rand($partners_ids)]; 

    $values .= "(null, '$order_created_by_user_fk', '$order_created_at', '$order_updated_at', 
    '$order_deleted_at', '$order_delivered_at', '$order_delivered_by_user_fk', '$order_placed_at_partner_fk'),";
}
  $values = rtrim($values, ',');
  $q = $db->prepare("INSERT INTO orders VALUES $values");
  $q->execute();

  echo "+ orders" . PHP_EOL;
} catch (Exception $e) {
  echo $e;
}
