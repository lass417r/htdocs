<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/Faker/autoload.php';
$faker = Faker\Factory::create();

try {

  $db = _db();
  $q = $db->prepare('DROP TABLE IF EXISTS items');
  $q->execute();


  $user_role_name = 'partner';
  $q = $db->prepare("SELECT user_id FROM users WHERE user_role_name = '$user_role_name'");
  $q->execute();
  $users_ids = $q->fetchAll(PDO::FETCH_COLUMN); // ["admin","partner","user","employee"]

  $q = $db->prepare('
    CREATE TABLE items(
      item_id                   int NOT NULL AUTO_INCREMENT,
      item_name                 TEXT,
      item_price                TEXT,
      item_created_at           TEXT,
      item_updated_at           TEXT,
      item_deleted_at           TEXT,
      item_created_by_user_fk   int,
      item_private              TEXT,
      PRIMARY KEY (item_id)
    )
  ');
  $q->execute();
  $values = '';
  $foodItems = ['Pizza', 'Burger', 'Pasta', 'Salad', 'Sushi', 'Steak', 'Tacos', 'Sandwich', 'Soup', 'Chicken', 'Fish', 'Rice', 'Noodles', 'Curry', 'Dumplings', 'Ice Cream', 'Cake', 'Coffee', 'Tea', 'Juice'];

  for ($i = 0; $i < 100; $i++) {
    $item_name = $foodItems[array_rand($foodItems)] . ' ' . $faker->unique()->word;
    $item_price = $faker->numberBetween(10, 100);
    $item_created_at = time();
    $item_updated_at = 0;
    $item_deleted_at = 0;
    $item_created_by_user_fk = $users_ids[array_rand($users_ids)];
    $item_private = 0;
    $values .= "(null, '$item_name', $item_price, $item_created_at, $item_updated_at, $item_deleted_at, '$item_created_by_user_fk', '$item_private'),";
  }
  $values = rtrim($values, ',');
  $q = $db->prepare("INSERT INTO items VALUES $values");
  $q->execute();

  echo "+ items" . PHP_EOL;
} catch (Exception $e) {
  echo $e;
}
