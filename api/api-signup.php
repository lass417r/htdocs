<?php

require_once __DIR__ . '/../_.php';

try {
  // Validate user inputs
  _validate_user_name();
  _validate_user_last_name();
  _validate_user_email();
  _validate_user_password();
  _validate_user_confirm_password();

  $db = _db();

  // Check if the email already exists
  $email_check = $db->prepare('SELECT COUNT(*) FROM users WHERE user_email = :user_email');
  $email_check->bindValue(':user_email', $_POST['user_email']);
  $email_check->execute();
  if ($email_check->fetchColumn() > 0) {
    throw new Exception('Email already in use', 400);
  }

  // Prepare the insert query with named placeholders
  $q = $db->prepare(
    '
    INSERT INTO users 
    (user_id, user_name, user_last_name, user_email, user_password, user_address, user_role_name, user_tag_color, user_created_at, user_updated_at, user_deleted_at, user_is_blocked)
    VALUES (
      :user_id, 
      :user_name, 
      :user_last_name, 
      :user_email, 
      :user_password, 
      :user_address,
      :user_role_name,
      :user_tag_color, 
      :user_created_at, 
      :user_updated_at,
      :user_deleted_at,
      :user_is_blocked)'
  );

  // Bind the parameters securely
  $q->bindValue(':user_id', null, PDO::PARAM_NULL); // Auto-increment field, set to NULL
  $q->bindValue(':user_name', htmlspecialchars(trim($_POST['user_name']), ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
  $q->bindValue(':user_last_name', htmlspecialchars(trim($_POST['user_last_name']), ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
  $q->bindValue(':user_email', filter_var(trim($_POST['user_email']), FILTER_SANITIZE_EMAIL), PDO::PARAM_STR);
  $q->bindValue(':user_password', password_hash(trim($_POST['user_password']), PASSWORD_DEFAULT), PDO::PARAM_STR);
  $q->bindValue(':user_address', "", PDO::PARAM_STR); // Assuming address is optional and empty for now
  $q->bindValue(':user_role_name', "customer", PDO::PARAM_STR);
  $q->bindValue(':user_tag_color', '#0ea5e9', PDO::PARAM_STR); // Default color
  $q->bindValue(':user_created_at', time(), PDO::PARAM_INT);
  $q->bindValue(':user_updated_at', time(), PDO::PARAM_INT);
  $q->bindValue(':user_deleted_at', 0, PDO::PARAM_INT); // Default value, assuming not deleted
  $q->bindValue(':user_is_blocked', 0, PDO::PARAM_INT); // Default value, assuming not blocked

  // Execute the query
  $q->execute();
  $counter = $q->rowCount();
  if ($counter != 1) {
    throw new Exception('ups...', 500);
  }

  // Return the user ID of the newly created user
  echo json_encode(['user_id' => $db->lastInsertId()]);
} catch (Exception $e) {
  try {
    if (!ctype_digit((string)$e->getCode())) {
      throw new Exception();
    }
    http_response_code($e->getCode());
    echo json_encode(['info' => $e->getMessage()]);
  } catch (Exception $ex) {
    // Handle the exception and return a generic error message
    http_response_code(500);
    echo json_encode(['info' => 'Internal Server Error']);
  }
}
