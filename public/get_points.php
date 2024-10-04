<?php
include '../db/db.php';

$log_file = '../logs/error.log';

try {
    $query = $pdo->query("SELECT id, name, description, ST_AsGeoJSON(geom) as geom FROM points");
    $points = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($points);
} catch (PDOException $e) {
    // Log error to file
    file_put_contents($log_file, '[' . date('Y-m-d H:i:s') . '] Failed to fetch points: ' . $e->getMessage() . PHP_EOL, FILE_APPEND);
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch points.']);
}
?>
