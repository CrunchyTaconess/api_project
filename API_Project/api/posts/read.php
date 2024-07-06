<?php
include '../../includes/db.php';

$sql = "SELECT posts.id, posts.title, posts.body, posts.created_at, users.username FROM posts JOIN users ON posts.user_id = users.id";
$stmt = $pdo->query($sql);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($posts);
?>