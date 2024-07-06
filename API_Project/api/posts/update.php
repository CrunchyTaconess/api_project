<?php
include '../../includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->id) && !empty($data->title) && !empty($data->body)) {
        $user_id = $_SESSION['user_id'];
        $post_id = $data->id;
        $title = $data->title;
        $body = $data->body;

        $sql = "UPDATE posts SET title = ?, body = ? WHERE id =? AND user_id = ?";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([$title, $body, $post_id, $user_id])) {
            echo json_encode(['message' => 'Post updated successfully']);
        } else {
            echo json_encode(['error' => 'Failed to update post']);
        }
    } else {
        echo json_encode(['error' => 'Incomplete data']);
    }
}
?>