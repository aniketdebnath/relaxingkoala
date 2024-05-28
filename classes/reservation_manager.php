<?php
require_once 'config.php';
require_once 'RestaurantTable.php';

class ReservationManager {
    private $tables = [];

    public function __construct() {
        $this->loadTablesFromDatabase();
    }

    private function loadTablesFromDatabase() {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM restaurant_tables');
        while ($row = $stmt->fetch()) {
            $this->tables[] = new RestaurantTable($row['id'], $row['table_number'], $row['capacity'], $row['is_available']);
        }
    }

    public function getTables() {
        return $this->tables;
    }

    public function bookTable($user_id, $table_id, $date, $time, $guests) {
        global $pdo;
        // Insert into reservations table
        $stmt = $pdo->prepare('INSERT INTO reservations (customer_id, table_id, reservation_date, reservation_time, guests) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$user_id, $table_id, $date, $time, $guests]);
        
        // Update table availability
        $this->updateTableAvailability($table_id, false);
    }

    private function updateTableAvailability($table_id, $availability) {
        global $pdo;
        $stmt = $pdo->prepare('UPDATE restaurant_tables SET is_available = ? WHERE id = ?');
        $stmt->execute([$availability, $table_id]);
    }
}
?>
