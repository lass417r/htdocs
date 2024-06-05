<?php

require_once __DIR__ . '/../_.php';

try {

    // sanitize input before saving it to the database
    // convert special characters to HTML entities
    $_POST['comment'] = htmlspecialchars($_POST['comment']);
    $_POST['name'] = htmlspecialchars($_POST['name']);

    $db = _db();
    $q = $db->prepare('
      INSERT INTO comments
      (comment_id, fk_order_id, name, comment)
      VALUES
      (:comment_id, :fk_order_id, :name, :comment)
    ');
    $q->bindValue(':comment_id', null);
    $q->bindValue(':fk_order_id', $_POST['fk_order_id']);
    $q->bindValue(':name', $_POST['name']);
    $q->bindValue(':comment', $_POST['comment']);
    $q->execute();


    echo json_encode(['success' => 'comment added successfully']);
} catch (Exception $e) {
    $status_code = !ctype_digit($e->getCode()) ? 500 : $e->getCode();
    $message = strlen($e->getMessage()) == 0 ? 'An error occurred' : $e->getMessage();
    http_response_code($status_code);
    echo json_encode(['error' => $message]);
}
