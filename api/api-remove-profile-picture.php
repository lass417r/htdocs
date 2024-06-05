<?php
require_once __DIR__ . '/../_.php';

try {
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('User not logged in', 401);
    }

    $user_id = $_SESSION['user_id'];

    // Get the current profile picture path
    $db = _db();
    $q = $db->prepare('SELECT profile_picture FROM users WHERE user_id = :user_id');
    $q->bindValue(':user_id', $user_id);
    $q->execute();
    $user = $q->fetch(PDO::FETCH_ASSOC);

    if (!$user || empty($user['profile_picture'])) {
        throw new Exception('No profile picture to remove', 400);
    }

    $profile_picture_path = __DIR__ . '/../' . $user['profile_picture'];

    // Delete the profile picture file
    if (file_exists($profile_picture_path)) {
        unlink($profile_picture_path);
    }

    // Update the database to remove the profile picture path
    $q = $db->prepare('UPDATE users SET profile_picture = "" WHERE user_id = :user_id');
    $q->bindValue(':user_id', $user_id);
    $q->execute();

    // Update the session
    $_SESSION['user']['profile_picture'] = "";

    echo json_encode(['message' => 'Profile picture removed successfully']);
} catch (Exception $e) {
    http_response_code($e->getCode() ?: 500);
    echo json_encode(['info' => $e->getMessage()]);
}
