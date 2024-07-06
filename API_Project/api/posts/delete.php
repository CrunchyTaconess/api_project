<?php
include '../../includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->id)) {
        $user_id = $_SESSION['user_id'];
        $post_id = $data->id;

        $sql = "DELETE FROM posts WHERE id = ? AND user_id = ?";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([$post_id, $user_id])) {
            echo json_encode(['message' => 'Post deleted successfully']);
        } else {
            echo json_encode(['error' => 'Failed to delete post']);
        }
    } else {
        echo json_encode(['error' => 'Incomplete data']);
    }
}
?>