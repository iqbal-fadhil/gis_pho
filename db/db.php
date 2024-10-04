<?php
// db/db.php

$host = 'localhost';
$db = 'map_cms';
$user = 'your_username';
$password = 'your_password';
$log_file = '../logs/error.log';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $password);
    // Enable PDO error logging
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Log error to file
    file_put_contents($log_file, '[' . date('Y-m-d H:i:s') . '] Connection failed: ' . $e->getMessage() . PHP_EOL, FILE_APPEND);
    die('Database connection failed.');
}
?>
