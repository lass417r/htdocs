<?php

ini_set('display_errors', 1); // Enable error reporting for debugging
session_start(); // Start a new or resume the existing session

// ##############################
// Function to establish a database connection using PDO
function _db()
{
  try {
    // Database connection parameters
    $user_name = "root";
    $user_password = "root";
    $db_connection = "mysql:host=localhost;dbname=company;charset=utf8mb4";

    // PDO options to ensure secure and consistent behavior
    $db_options = array(
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Enable exceptions for errors
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Set default fetch mode to associative array
      //PDO::ATTR_EMULATE_PREPARES   => false,                  // Use native prepared statements
    );
    // Create a new PDO instance
    return new PDO($db_connection, $user_name, $user_password, $db_options);
  } catch (PDOException $e) {
    // Handle any errors that occur during the connection attempt
    throw new Exception('ups... system under maintenance', 500);
    exit();
  }
}

// ##############################
// Define minimum and maximum lengths for user_name
define('USER_NAME_MIN', 2);
define('USER_NAME_MAX', 20);

// ##############################
// Define minimum and maximum lengths for comment name and comment text
define('COMMENT_NAME_MIN', 2);
define('COMMENT_NAME_MAX', 20);
define('COMMENT_TEXT_MIN', 2);
define('COMMENT_TEXT_MAX', 140);

// Function to validate user_name
function _validate_user_name()
{
  $error = 'user_name min ' . USER_NAME_MIN . ' max ' . USER_NAME_MAX;

  if (!isset($_POST['user_name'])) {
    throw new Exception($error, 400); // Throw an exception if user_name is not set
  }
  // Trim and sanitize the user_name input
  $_POST['user_name'] = trim($_POST['user_name']);
  $_POST['user_name'] = htmlspecialchars($_POST['user_name'], ENT_QUOTES, 'UTF-8');

  // Check if the user_name length is within the defined range
  if (strlen($_POST['user_name']) < USER_NAME_MIN || strlen($_POST['user_name']) > USER_NAME_MAX) {
    throw new Exception($error, 400); // Throw an exception if the length is invalid
  }
}

// ##############################
// Define minimum and maximum lengths for user_last_name
define('USER_LAST_NAME_MIN', 2);
define('USER_LAST_NAME_MAX', 20);

// Function to validate user_last_name
function _validate_user_last_name()
{
  $error = 'user_last_name min ' . USER_LAST_NAME_MIN . ' max ' . USER_LAST_NAME_MAX;

  if (!isset($_POST['user_last_name'])) {
    throw new Exception($error, 400); // Throw an exception if user_last_name is not set
  }
  // Trim and sanitize the user_last_name input
  $_POST['user_last_name'] = trim($_POST['user_last_name']);
  $_POST['user_last_name'] = htmlspecialchars($_POST['user_last_name'], ENT_QUOTES, 'UTF-8');

  // Check if the user_last_name length is within the defined range
  if (strlen($_POST['user_last_name']) < USER_LAST_NAME_MIN || strlen($_POST['user_last_name']) > USER_LAST_NAME_MAX) {
    throw new Exception($error, 400); // Throw an exception if the length is invalid
  }
}

// ##############################
// Function to validate user_email
function _validate_user_email()
{
  $error = 'user_email invalid';
  if (!isset($_POST['user_email'])) {
    throw new Exception($error, 400); // Throw an exception if user_email is not set
  }
  // Trim and sanitize the user_email input
  $_POST['user_email'] = trim($_POST['user_email']);
  $_POST['user_email'] = filter_var($_POST['user_email'], FILTER_SANITIZE_EMAIL);
  // Validate the email format
  if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
    throw new Exception($error, 400); // Throw an exception if the email format is invalid
  }
}

// ##############################
// Define minimum and maximum lengths for user_password
define('USER_PASSWORD_MIN', 6);
define('USER_PASSWORD_MAX', 50);

// Function to validate user_password
function _validate_user_password()
{
  $error = 'user_password min ' . USER_PASSWORD_MIN . ' max ' . USER_PASSWORD_MAX;

  if (!isset($_POST['user_password'])) {
    throw new Exception($error, 400); // Throw an exception if user_password is not set
  }
  // Trim the user_password input
  $_POST['user_password'] = trim($_POST['user_password']);

  // Check if the user_password length is within the defined range
  if (strlen($_POST['user_password']) < USER_PASSWORD_MIN || strlen($_POST['user_password']) > USER_PASSWORD_MAX) {
    throw new Exception($error, 400); // Throw an exception if the length is invalid
  }
}

// ##############################
// Function to validate user_confirm_password
function _validate_user_confirm_password()
{
  $error = 'user_confirm_password must match the user_password';
  if (!isset($_POST['user_confirm_password'])) {
    throw new Exception($error, 400); // Throw an exception if user_confirm_password is not set
  }
  // Trim the user_confirm_password input
  $_POST['user_confirm_password'] = trim($_POST['user_confirm_password']);
  // Check if the user_confirm_password matches the user_password
  if ($_POST['user_password'] != $_POST['user_confirm_password']) {
    throw new Exception($error, 400); // Throw an exception if passwords do not match
  }
}

// ##############################
// Functions to check user roles
function _is_admin()
{
  return (isset($_SESSION['user']) && $_SESSION['user']['user_role_name'] == 'admin');
}

function _is_partner()
{
  return (isset($_SESSION['user']) && $_SESSION['user']['user_role_name'] == 'partner');
}

function _is_employee()
{
  return (isset($_SESSION['user']) && $_SESSION['user']['user_role_name'] == 'employee');
}

function _is_customer()
{
  return (isset($_SESSION['user']) && $_SESSION['user']['user_role_name'] == 'customer');
}

// ##############################
// Function to safely output text to prevent XSS attacks
function out($text)
{
  echo htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}
