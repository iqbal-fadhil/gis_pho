<?php
include '../db/db.php';
$log_file = '../logs/error.log';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $geom = $_POST['geom'];  // This should be in GeoJSON format.

    try {
        $stmt = $pdo->prepare("INSERT INTO points (name, description, geom) VALUES (?, ?, ST_GeomFromGeoJSON(?))");
        $stmt->execute([$name, $description, $geom]);
        echo json_encode(['success' => 'Point added successfully']);
    } catch (PDOException $e) {
        // Log error
        file_put_contents($log_file, '[' . date('Y-m-d H:i:s') . '] Failed to add point: ' . $e->getMessage() . PHP_EOL, FILE_APPEND);
        http_response_code(500);
        echo json_encode(['error' => 'Failed to add point.']);
    }
}
?>
