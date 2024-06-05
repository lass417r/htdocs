<?php
require_once __DIR__ . '/../_.php';

try {
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('User not logged in', 401);
    }

    $db = _db();

    // Determine if the user is an admin or the current user
    if (_is_admin()) {
        // Admin can update any user
        if (!isset($_POST['user_id'])) {
            throw new Exception('User ID is required', 400);
        }
        $user_id = $_POST['user_id'];
    } else {
        // Non-admin users can only update their own profile
        $user_id = $_SESSION['user_id'];
    }

    // Fetch the current user data
    $q = $db->prepare('SELECT * FROM users WHERE user_id = :user_id');
    $q->bindValue(':user_id', $user_id);
    $q->execute();
    $user = $q->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        throw new Exception('User not found', 404);
    }

    // Input validation and sanitization
    if (isset($_POST['user_name'])) {
        _validate_user_name();
        $user_name = htmlspecialchars(strip_tags(trim($_POST['user_name'])));
    } else {
        $user_name = $user['user_name'];
    }

    if (isset($_POST['user_last_name'])) {
        _validate_user_last_name();
        $user_last_name = htmlspecialchars(strip_tags(trim($_POST['user_last_name'])));
    } else {
        $user_last_name = $user['user_last_name'];
    }

    if (isset($_POST['user_email'])) {
        _validate_user_email();
        $user_email = htmlspecialchars(strip_tags(trim($_POST['user_email'])));
    } else {
        $user_email = $user['user_email'];
    }

    $user_address = isset($_POST['user_address']) ? htmlspecialchars(strip_tags(trim($_POST['user_address']))) : $user['user_address'];
    $user_tag_color = isset($_POST['user_tag_color']) ? htmlspecialchars(strip_tags(trim($_POST['user_tag_color']))) : ($user['user_tag_color'] ?? '#000000');

    // Prepare the update query
    $q = $db->prepare('
        UPDATE users 
        SET user_name = :user_name, 
            user_last_name = :user_last_name, 
            user_email = :user_email, 
            user_address = :user_address, 
            user_tag_color = :user_tag_color, 
            user_updated_at = :user_updated_at 
        WHERE user_id = :user_id
    ');

    // Bind parameters
    $q->bindValue(':user_id', $user_id);
    $q->bindValue(':user_name', $user_name);
    $q->bindValue(':user_last_name', $user_last_name);
    $q->bindValue(':user_email', $user_email);
    $q->bindValue(':user_address', $user_address);
    $q->bindValue(':user_tag_color', $user_tag_color);
    $q->bindValue(':user_updated_at', time());

    // Execute the update query
    $q->execute();

    if ($q->rowCount() == 0) {
        throw new Exception('No rows were updated', 400);
    }

    // Re-fetch the updated user information
    if (!_is_admin() || $_SESSION['user_id'] == $user_id) {
        $q = $db->prepare('SELECT * FROM users WHERE user_id = :user_id');
        $q->bindValue(':user_id', $user_id);
        $q->execute();
        $user = $q->fetch(PDO::FETCH_ASSOC);

        // Update the session user information
        $_SESSION['user'] = $user;
    }

    echo json_encode(['message' => 'User updated successfully']);
} catch (Exception $e) {
    http_response_code($e->getCode() ?: 500);
    echo json_encode(['info' => $e->getMessage()]);
}
