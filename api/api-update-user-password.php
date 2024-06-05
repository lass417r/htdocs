<?php
require_once __DIR__ . '/../_.php';

try {
    // Check if user is logged in
    if (!isset($_SESSION['user'])) {
        throw new Exception('User not logged in', 401);
    }

    // Validate the new password and confirm password
    _validate_user_password(); // Assumes this function checks password strength and length
    _validate_user_confirm_password(); // Assumes this function checks if confirm password is set

    $user = $_SESSION['user'];
    $db = _db(); // Get database connection

    // Fetch the current password from the database
    $q = $db->prepare('SELECT user_password FROM users WHERE user_id = :user_id');
    $q->bindValue(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
    $q->execute();
    $current_password = $q->fetchColumn();

    // Verify the old password
    if (!password_verify($_POST['user_old_password'], $current_password)) {
        throw new Exception('Old password is incorrect', 400);
    }

    // Check if new password matches the confirm password
    if ($_POST['user_password'] !== $_POST['user_confirm_password']) {
        throw new Exception('New password and confirm password do not match', 400);
    }

    // Hash the new password
    $new_password_hashed = password_hash($_POST['user_password'], PASSWORD_DEFAULT);

    // Update the password in the database
    $q = $db->prepare('UPDATE users SET user_password = :new_password, user_updated_at = :user_updated_at WHERE user_id = :user_id');
    $q->bindValue(':new_password', $new_password_hashed, PDO::PARAM_STR);
    $q->bindValue(':user_updated_at', time(), PDO::PARAM_INT);
    $q->bindValue(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
    $q->execute();

    // Re-fetch the user information from the database to update the session
    $q = $db->prepare('SELECT * FROM users WHERE user_id = :user_id');
    $q->bindValue(':user_id', $user['user_id'], PDO::PARAM_INT);
    $q->execute();
    $user = $q->fetch(PDO::FETCH_ASSOC);

    // Update the session with the latest user information
    $_SESSION['user'] = $user;

    // Return a success message
    echo json_encode(['info' => 'Password updated successfully']);
} catch (Exception $e) {
    // Handle exceptions and set appropriate HTTP status code
    http_response_code($e->getCode() ?: 500);
    echo json_encode(['info' => $e->getMessage()]);
}
