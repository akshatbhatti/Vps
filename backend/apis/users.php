<?php

require_once __DIR__ . '/../db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$method = $_SERVER['REQUEST_METHOD'];


// GET USERS
if ($method === 'GET') {

    $stmt = $conn->query("SELECT * FROM users");

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($users);
}



// CREATE USER
if ($method === 'POST') {

    $data = json_decode(file_get_contents("php://input"), true);

    $email = $data['email'];
    $username = $data['username'];
    $message = $data['message'];

    $sql = "INSERT INTO users (email, username, message)
            VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->execute([$email, $username, $message]);

    echo json_encode([
        "message" => "User created successfully"
    ]);
}



// UPDATE USER
if ($method === 'PUT') {

    $data = json_decode(file_get_contents("php://input"), true);

    $id = $data['id'];

    $sql = "UPDATE users
            SET email=?, username=?, message=?
            WHERE id=?";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        $data['email'],
        $data['username'],
        $data['message'],
        $id
    ]);

    echo json_encode([
        "message" => "User updated successfully"
    ]);
}



// DELETE USER
if ($method === 'DELETE') {

    $data = json_decode(file_get_contents("php://input"), true);

    $id = $data['id'];

    $stmt = $conn->prepare("DELETE FROM users WHERE id=?");

    $stmt->execute([$id]);

    echo json_encode([
        "message" => "User deleted successfully"
    ]);
}