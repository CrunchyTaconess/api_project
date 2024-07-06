<?php
include '../../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->username) && !empty($data->password) && !empty($data->email)) {
        $username = $data->username;
        $password = password_hash($data->password, PASSWORD_BCRYPT);
        $email = $data->email;

        $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([$username, $password, $email])) {
            echo json_encode(['message' => 'User registered successfully']);
        } else {
            echo json_encode(['error' => 'Failed to register user']);
        }
    } else {
        echo json_encode(['error' => 'Incomplete data']);
    }
}
?>