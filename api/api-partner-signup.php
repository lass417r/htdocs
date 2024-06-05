<?php

require_once __DIR__ . '/../_.php';

try {
  // Validate user inputs
  _validate_user_name();
  _validate_user_last_name();
  _validate_user_email();
  _validate_user_password();
  _validate_user_confirm_password();

  // Sanitize partner name input
  if (!isset($_POST['partner_name'])) {
    throw new Exception('Partner name is required', 400);
  }
  $partner_name = htmlspecialchars(trim($_POST['partner_name']), ENT_QUOTES, 'UTF-8');

  $db = _db();
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception
  $db->beginTransaction(); // Start transaction

  // Insert into users table
  $q = $db->prepare('
    INSERT INTO users 
    (user_name, user_last_name, user_email, user_password, user_address, user_role_name, user_tag_color, user_created_at, user_updated_at, user_deleted_at, user_is_blocked)
    VALUES 
    (:user_name, :user_last_name, :user_email, :user_password, :user_address, :user_role_name, :user_tag_color, :user_created_at, :user_updated_at, :user_deleted_at, :user_is_blocked)
    ');
  $q->bindValue(':user_name', htmlspecialchars(trim($_POST['user_name']), ENT_QUOTES, 'UTF-8'));
  $q->bindValue(':user_last_name', htmlspecialchars(trim($_POST['user_last_name']), ENT_QUOTES, 'UTF-8'));
  $q->bindValue(':user_email', filter_var(trim($_POST['user_email']), FILTER_SANITIZE_EMAIL));
  $q->bindValue(':user_password', password_hash(trim($_POST['user_password']), PASSWORD_DEFAULT));
  $q->bindValue(':user_address', '');
  $q->bindValue(':user_role_name', 'partner');
  $q->bindValue(':user_tag_color', '#0ea5e9');
  $q->bindValue(':user_created_at', time());
  $q->bindValue(':user_updated_at', time());
  $q->bindValue(':user_deleted_at', 0);
  $q->bindValue(':user_is_blocked', 0);

  $q->execute();

  if ($q->rowCount() != 1) {
    throw new Exception('User creation failed', 500);
  }

  $user_id = $db->lastInsertId();

  // Insert into partners table
  $q = $db->prepare('
    INSERT INTO partners 
    (user_partner_id, partner_geo, partner_name)
    VALUES 
    (:user_partner_id, :partner_geo, :partner_name)
    ');

  // Generate random latitude and longitude for geo location
  $latitude = number_format(mt_rand(-900000, 900000) / 10000, 5, '.', '');
  $longitude = number_format(mt_rand(-1800000, 1800000) / 10000, 5, '.', '');
  $geo = $latitude . ',' . $longitude;

  $q->bindValue(':user_partner_id', $user_id, PDO::PARAM_INT);
  $q->bindValue(':partner_geo', $geo, PDO::PARAM_STR);
  $q->bindValue(':partner_name', $partner_name, PDO::PARAM_STR);

  $q->execute();

  if ($q->rowCount() != 1) {
    throw new Exception('Partner creation failed', 500);
  }

  $db->commit(); // Commit the transaction

  echo json_encode(['user_id' => $user_id]);
} catch (PDOException $pdoe) {
  $db->rollBack(); // Roll back the transaction in case of error
  http_response_code(500);
  echo json_encode(['error' => $pdoe->getMessage()]);
} catch (Exception $e) {
  if ($db->inTransaction()) {
    $db->rollBack(); // Roll back the transaction in case of error
  }
  http_response_code($e->getCode() ?: 500);
  echo json_encode(['info' => $e->getMessage()]);
}
