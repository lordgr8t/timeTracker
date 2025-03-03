<?php
include '../db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->query('
        SELECT t.id, t.name, SUM(TIMESTAMPDIFF(SECOND, tm.start_time, tm.end_time)) as total_time
        FROM tasks t
        LEFT JOIN timers tm ON t.id = tm.task_id
        GROUP BY t.id
    ');
    echo json_encode($stmt->fetchAll());
}
?>