<?php
include '../db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->query('SELECT * FROM tasks');
    echo json_encode($stmt->fetchAll());
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $stmt = $pdo->prepare('INSERT INTO tasks (name, description) VALUES (?, ?)');
    $stmt->execute([$data['name'], $data['description']]);
    echo json_encode(['id' => $pdo->lastInsertId()]);
}
?>