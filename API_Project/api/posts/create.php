<?php
include '../../includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->title) && !empty($data->body)) {
        $user_id = $_SESSION['user_id'];
        $title = $data->title;
        $body = $data->body;

        $sql = "INSERT INTO posts (user_id, title, body) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([$user_id, $title, $body])) {
            echo json_encode(['message' => 'Post created successfully']);
        } else {
            echo json_encode(['error' => 'Failed to create post']);
        } 
    } else {
        echo json_encode(['error' => 'Incomplete data']);
    }
}
?>