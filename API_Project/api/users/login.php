<?php
include '../../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->username) && !empty($data->password)) {
        $username = $data->username;
        $password = $data->password;

        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            echo json_encode(['message' => 'Login successful']);
        } else {
            echo json_encode(['error' => 'Invalid username or password']);
        }
    } else {
        echo json_encode(['error' => 'Incomplete data']);
    }
}
?>