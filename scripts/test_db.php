<?php
require_once '../classes/config.php';

try {
    $stmt = $pdo->query('SELECT 1');
    if ($stmt) {
        echo "Database connection is working.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
include '../includes/header.php';
?>
