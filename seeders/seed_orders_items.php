<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/Faker/autoload.php';
$faker = Faker\Factory::create();

try {

  $db = _db();
  // Get order's id
  $q = $db->prepare('SELECT order_id FROM orders');
  $q->execute();
  $orders_ids = $q->fetchAll(PDO::FETCH_COLUMN);

  // Get items_ids to assign to order
  $q = $db->prepare("SELECT item_id, item_price FROM items");
  $q->execute();
  $items = $q->fetchAll(PDO::FETCH_NUM);

  // echo json_encode($items); exit();

  $db = _db();
  $q = $db->prepare('DROP TABLE IF EXISTS orders_items');
  $q->execute();

  $q = $db->prepare('
    CREATE TABLE orders_items(
      orders_items_id             int NOT NULL AUTO_INCREMENT,
      orders_items_order_fk       TEXT,
      orders_items_item_fk        TEXT,
      orders_items_total_price    TEXT,
      orders_items_item_quantity  TEXT,
      orders_items_created_at     TEXT,
      orders_items_updated_at     TEXT,
      orders_items_deleted_at     TEXT,
      PRIMARY KEY (orders_items_id)
    )
  ');
  $q->execute();

  $orders_items = [];
  $values = '';
  for ($i = 0; $i < 100; $i++) {
    $item = $items[array_rand($items)];
    $orders_items_order_fk = $orders_ids[array_rand($orders_ids)];
    $orders_items_item_fk = $item[0];
    // Same order with same item cannot repeat
    $order_item = $orders_items_order_fk . $orders_items_item_fk;
    if (in_array($order_item, $orders_items)) {
      $i--;
      continue;
    }
    array_push($orders_items, $order_item);
    $orders_items_item_quantity = rand(1, 5);
    $orders_items_total_price = $item[1] * $orders_items_item_quantity;
    $orders_items_created_at = rand(time() - 1602343484, time());
    $orders_items_updated_at = 0;
    $orders_items_deleted_at = 0;

    $values .= "(null, '$orders_items_order_fk', '$orders_items_item_fk',
                  $orders_items_total_price, $orders_items_item_quantity, $orders_items_created_at,
                  $orders_items_updated_at, $orders_items_deleted_at),";
  }
  $values = rtrim($values, ',');
  $q = $db->prepare("INSERT INTO orders_items VALUES $values");
  $q->execute();

  echo "+ orders_items" . PHP_EOL;
} catch (Exception $e) {
  echo $e;
}
