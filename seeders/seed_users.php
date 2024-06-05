<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/Faker/autoload.php';
$faker = Faker\Factory::create();

try {

  $db = _db();
  $q = $db->prepare('DROP TABLE IF EXISTS users');
  $q->execute();

  // Get roles to assign to users
  $q = $db->prepare('SELECT role_name FROM roles');
  $q->execute();
  $roles = $q->fetchAll(PDO::FETCH_COLUMN); // ["admin","partner","user","employee"]

  $q = $db->prepare('
    CREATE TABLE users(
      user_id           int NOT NULL AUTO_INCREMENT,
      user_name         TEXT,
      user_last_name    TEXT,
      user_email        TEXT,
      user_password     TEXT,
      user_address      TEXT,
      user_role_name    TEXT,
      user_tag_color    TEXT,
      user_created_at   TEXT,
      user_updated_at   TEXT,
      user_deleted_at   TEXT,
      user_is_blocked   int,
      user_image	      varchar(255),
      PRIMARY KEY (user_id),
      UNIQUE (user_email(255))
    )
  ');
  $q->execute();

  $values = '';

  $user_password = password_hash('password', PASSWORD_DEFAULT); // too long time in loop
  for ($i = 0; $i < 100; $i++) {
    $user_name = str_replace("'", "''", $faker->firstName);
    $user_last_name = str_replace("'", "''", $faker->lastName);
    $user_email = $faker->unique->email;
    $user_address = str_replace("'", "''", $faker->address);
    $user_role_name = $roles[array_rand($roles)];
    $user_tag_color = $faker->hexcolor;
    $user_created_at = time();
    $user_updated_at = time();
    $user_deleted_at = 0;
    $user_is_blocked = 0;
    $user_image   = "";
    $values .= "(null, '$user_name', '$user_last_name', '$user_email', '$user_password', 
    '$user_address', '$user_role_name', '$user_tag_color', $user_created_at, $user_updated_at, $user_deleted_at, $user_is_blocked, $user_image),";
  }

  // Admin roles

  $admin_password = password_hash('password', PASSWORD_DEFAULT);
  $admin_created_at = time();
  $admin_updated_at = 0;
  $admin_deleted_at = 0;
  $admin_is_blocked = 0;
  $values .= "(null, 'Admin', 'Admin', 'admin@company.com', 
  '$admin_password', 'Admin address', 'admin', '#0ea5e9', $admin_created_at, $admin_updated_at, $admin_deleted_at, $user_is_blocked, $user_image),";

  //partner 

  $partner_password = password_hash('password', PASSWORD_DEFAULT);
  $partner_created_at = time();
  $partner_updated_at = 0;
  $partner_deleted_at = 0;
  $partner_is_blocked = 0;
  $values .= "(null, 'Partner', 'Partner', 'partner@company.com', 
  '$partner_password', 'Partner address', 'partner', '#0ea5e9', $partner_created_at, $partner_updated_at, $partner_deleted_at, $user_is_blocked, $user_image),";

  //employee

  $employee_password = password_hash('password', PASSWORD_DEFAULT);
  $employee_created_at = time();
  $employee_updated_at = 0;
  $employee_deleted_at = 0;
  $employee_is_blocked = 0;
  $values .= "(null, 'Employee', 'Employee', 'employee@company.com', 
  '$employee_password', 'employee address', 'employee', '#0ea5e9', $employee_created_at, $employee_updated_at, $employee_deleted_at, $user_is_blocked, $user_image),";

  //customer

  $customer_password = password_hash('password', PASSWORD_DEFAULT);
  $customer_created_at = time();
  $customer_updated_at = 0;
  $customer_deleted_at = 0;
  $customer_is_blocked = 0;
  $values .= "(null, 'Customer', 'Customer', 'customer@company.com', 
  '$customer_password', 'customer address', 'customer', '#0ea5e9', $customer_created_at, $customer_updated_at, $customer_deleted_at, $user_is_blocked, $user_image),";

  $values = rtrim($values, ',');
  $q = $db->prepare("INSERT INTO users VALUES $values");
  $q->execute();

  echo "+ users" . PHP_EOL;
} catch (Exception $e) {
  echo $e;
}
