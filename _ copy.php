<?php

ini_set('display_errors', 1);
session_start();

// ##############################
function _db()
{
  try {
    $user_name = "root";
    $user_password = "root";
    // $db_connection = 'sqlite:' . __DIR__ . '/database/data.sqlite';
    $db_connection = "mysql:host=localhost; dbname=company; charset=utf8mb4";

    // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    //   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ   [{}]    $user->id
    $db_options = array(
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // [['id'=>1, 'name'=>'A'],[]]  $user['id']
    );
    return new PDO($db_connection, $user_name, $user_password, $db_options);
  } catch (PDOException $e) {
    throw new Exception('ups... system under maintainance', 500);
    exit();
  }
}


// ##############################
define('USER_NAME_MIN', 2);
define('USER_NAME_MAX', 20);
function _validate_user_name()
{

  $error = 'user_name min ' . USER_NAME_MIN . ' max ' . USER_NAME_MAX;

  if (!isset($_POST['user_name'])) {
    throw new Exception($error, 400);
  }
  $_POST['user_name'] = trim($_POST['user_name']);

  if (strlen($_POST['user_name']) < USER_NAME_MIN) {
    throw new Exception($error, 400);
  }

  if (strlen($_POST['user_name']) > USER_NAME_MAX) {
    throw new Exception($error, 400);
  }
}

// ##############################
define('USER_LAST_NAME_MIN', 2);
define('USER_LAST_NAME_MAX', 20);
function _validate_user_last_name()
{

  $error = 'user_last_name min ' . USER_LAST_NAME_MIN . ' max ' . USER_LAST_NAME_MAX;

  if (!isset($_POST['user_last_name'])) {
    throw new Exception($error, 400);
  }
  $_POST['user_last_name'] = trim($_POST['user_last_name']);

  if (strlen($_POST['user_last_name']) < USER_LAST_NAME_MIN) {
    throw new Exception($error, 400);
  }

  if (strlen($_POST['user_last_name']) > USER_LAST_NAME_MAX) {
    throw new Exception($error, 400);
  }
}

// ##############################
function _validate_user_email()
{
  $error = 'user_email invalid';
  if (!isset($_POST['user_email'])) {
    throw new Exception($error, 400);
  }
  $_POST['user_email'] = trim($_POST['user_email']);
  if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
    throw new Exception($error, 400);
  }
}

// ##############################
define('USER_PASSWORD_MIN', 6);
define('USER_PASSWORD_MAX', 50);
function _validate_user_password()
{

  $error = 'user_password min ' . USER_PASSWORD_MIN . ' max ' . USER_PASSWORD_MAX;

  if (!isset($_POST['user_password'])) {
    throw new Exception($error, 400);
  }
  $_POST['user_password'] = trim($_POST['user_password']);

  if (strlen($_POST['user_password']) < USER_PASSWORD_MIN) {
    throw new Exception($error, 400);
  }

  if (strlen($_POST['user_password']) > USER_PASSWORD_MAX) {
    throw new Exception($error, 400);
  }
}

// ##############################
function _validate_user_confirm_password()
{
  $error = 'user_confirm_password must match the user_password';
  if (!isset($_POST['user_confirm_password'])) {
    throw new Exception($error, 400);
  }
  $_POST['user_confirm_password'] = trim($_POST['user_confirm_password']);
  if ($_POST['user_password'] != $_POST['user_confirm_password']) {
    throw new Exception($error, 400);
  }
}


// ##############################
function _is_admin()
{
  return (!isset($_SESSION['user']) || $_SESSION['user']['user_role_name'] != 'admin') ? false : true;
}
function _is_partner()
{
  return (!isset($_SESSION['user']) || $_SESSION['user']['user_role_name'] != 'partner') ? false : true;
}
function _is_employee()
{
  return (!isset($_SESSION['user']) || $_SESSION['user']['user_role_name'] != 'employee') ? false : true;
}
function _is_customer()
{
  return (!isset($_SESSION['user']) || $_SESSION['user']['user_role_name'] != 'customer') ? false : true;
}

// ##############################
function out($text)
{
  echo htmlspecialchars($text);
}
