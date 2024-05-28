<?php
require_once 'config.php';

class SalesRecord {
    public function addSale($orderId, $amount) {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO sales_records (order_id, amount) VALUES (?, ?)');
        $stmt->execute([$orderId, $amount]);
    }

    public function getSalesRecords() {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM sales_records');
        return $stmt->fetchAll();
    }

    public function getTotalSales() {
        global $pdo;
        $stmt = $pdo->query('SELECT SUM(amount) as total_sales FROM sales_records');
        return $stmt->fetch()['total_sales'];
    }
}
?>
