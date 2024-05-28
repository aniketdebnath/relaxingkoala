<?php
require_once 'config.php';

class Analysis {
    public function analyzeSalesData() {
        global $pdo;
        $stmt = $pdo->query('SELECT SUM(amount) as total_sales FROM sales_records');
        return $stmt->fetch()['total_sales'];
    }

    public function analyzeReviews() {
        global $pdo;
        $stmt = $pdo->query('SELECT COUNT(*) as total_reviews FROM reviews');
        return $stmt->fetch()['total_reviews'];
    }
}
?>
