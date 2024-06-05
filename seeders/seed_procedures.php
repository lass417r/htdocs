<?php
require_once __DIR__ . '/../_.php';

try {
    $db = _db();
    $q = $db->prepare('DROP PROCEDURE IF EXISTS login');
    $q->execute();

    $q = $db->prepare('
        CREATE DEFINER=`root`@`localhost` 
        PROCEDURE `login`(IN `the_users_email` VARCHAR(100) CHARSET utf8mb4) NOT DETERMINISTIC CONTAINS SQL SQL SECURITY DEFINER 
        SELECT * FROM users WHERE user_email = the_users_email
    ');
    $q->execute();

    echo "+ procedures" . PHP_EOL;
} catch (Exception $e) {
    echo $e;
}
