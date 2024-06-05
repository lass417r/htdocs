<?php
require_once __DIR__ . '/../_.php';

try {
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('User not logged in', 401);
    }

    $user_id = $_SESSION['user_id'];

    // Define the target directory for uploads
    $target_dir = __DIR__ . '/../assets/profile_pictures/';
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    // Ensure the uploaded file exists and check for errors
    if (!isset($_FILES["user_profile_picture"]) || $_FILES["user_profile_picture"]["error"] != UPLOAD_ERR_OK) {
        throw new Exception('File upload error.', 400);
    }

    // Check if the upload_tmp_dir is set and writable
    $upload_tmp_dir = ini_get('upload_tmp_dir') ?: '/Applications/MAMP/htdocs/tmp';
    if (!is_writable($upload_tmp_dir)) {
        throw new Exception('Temporary upload directory is not writable.', 500);
    }

    // Get the file extension of the uploaded file
    $imageFileType = strtolower(pathinfo($_FILES["user_profile_picture"]["name"], PATHINFO_EXTENSION));

    // Check if the file is an actual image
    $check = getimagesize($_FILES["user_profile_picture"]["tmp_name"]);
    if ($check === false) {
        throw new Exception("File is not an image.", 400);
    }

    // Check file size (limit to 5MB)
    if ($_FILES["user_profile_picture"]["size"] > 5000000) {
        throw new Exception("Sorry, your file is too large.", 400);
    }

    // Allow certain file formats
    $allowed_file_types = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowed_file_types)) {
        throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.", 400);
    }

    // Validate the MIME type to prevent MIME type spoofing
    $mime_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($check['mime'], $mime_types)) {
        throw new Exception("Invalid image MIME type.", 400);
    }

    // Ensure the uploaded file is not a PHP file by validating its MIME type
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($_FILES["user_profile_picture"]["tmp_name"]);
    if (strpos($mime, 'image/') !== 0) {
        throw new Exception("Invalid file type.", 400);
    }

    // Give a unique name to the file to avoid conflicts
    $new_file_name = $user_id . '.' . $imageFileType;
    $target_file = $target_dir . $new_file_name;

    // Move the uploaded file from the temporary directory to the target directory
    if (!move_uploaded_file($_FILES["user_profile_picture"]["tmp_name"], $target_file)) {
        throw new Exception("Sorry, there was an error uploading your file.", 500);
    }

    // Store the relative path to the profile picture
    $profile_picture_url = '/assets/profile_pictures/' . $new_file_name;

    // Update the user's profile picture path in the database
    $db = _db();
    $q = $db->prepare('UPDATE users SET profile_picture = :profile_picture WHERE user_id = :user_id');
    $q->bindValue(':profile_picture', $profile_picture_url, PDO::PARAM_STR);
    $q->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $q->execute();

    // Update the $_SESSION['user'] variable with the latest user information
    $_SESSION['user']['profile_picture'] = $profile_picture_url;

    echo json_encode(['message' => 'Profile picture updated successfully']);
} catch (Exception $e) {
    http_response_code($e->getCode() ?: 500);
    echo json_encode(['info' => $e->getMessage()]);
}
