<?php
include '../db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($data['action'] === 'start') {
        $stmt = $pdo->prepare('INSERT INTO timers (task_id, start_time) VALUES (?, NOW())');
        $stmt->execute([$data['task_id']]);
    } elseif ($data['action'] === 'stop') {
        $stmt = $pdo->prepare('UPDATE timers SET end_time = NOW() WHERE task_id = ? AND end_time IS NULL');
        $stmt->execute([$data['task_id']]);
    }
}
?>