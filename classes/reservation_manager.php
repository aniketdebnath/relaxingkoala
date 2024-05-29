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
        $query = 'SELECT * FROM restaurant_tables';
        $stmt = $pdo->query($query);
        while ($row = $stmt->fetch()) {
            $this->tables[$row['id']] = new RestaurantTable(
                $row['id'], 
                $row['table_number'], 
                $row['capacity'], 
                $row['is_available'],
                $row['reservation_time_start'],
                $row['reservation_time_end'],
                $row['reservation_date']  
            );
        }
    }

    public function getTables() {
        return $this->tables;
    }

    public function getReservations() {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM reservations');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bookTable($user_id, $table_id, $date, $timeStart, $timeEnd, $guests) {
        global $pdo;

        if (isset($this->tables[$table_id])) {
            $table = $this->tables[$table_id];

            if ($guests > $table->getCapacity()) {
                return "Unable to accommodate the number of guests.";
            }
            if (!$table->isAvailable()) {
                return "Table is currently not available.";
            }

            // Convert input and table reservation dates to DateTime objects
            $inputDate = new DateTime($date);
            $reservationDate = new DateTime($table->getReservationDate());

            // date matches or exceeds date in the database
            if ($inputDate < $reservationDate) {
                return "Reservations for this table start from " . $table->getReservationDate() . ".";
            }

            // Check if resturant is opened
            if ($timeStart < $table->getReservationTimeStart() || $timeEnd > $table->getReservationTimeEnd()) {
                return "Requested time " . $timeStart . " to " . $timeEnd . " is outside the table's available hours from " . $table->getReservationTimeStart() . " to " . $table->getReservationTimeEnd() . ".";
            }

            // Check for tables already reserved overlapping times
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM reservations WHERE table_id = ? AND reservation_date = ? AND NOT (reservation_time_end <= ? OR reservation_time_start >= ?)');
            $stmt->execute([$table_id, $date, $timeStart, $timeEnd]);
            if ($stmt->fetchColumn() > 0) {
                return "Table is already booked for the specified times.";
            }

            try {
                $pdo->beginTransaction();

              
                $stmt = $pdo->prepare('INSERT INTO reservations (customer_id, table_id, reservation_date, reservation_time_start, reservation_time_end, guests) VALUES (?, ?, ?, ?, ?, ?)');
                $stmt->execute([$user_id, $table_id, $date, $timeStart, $timeEnd, $guests]);

                $pdo->commit();
                return "Table has been booked successfully!";
            } catch (Exception $e) {
                $pdo->rollBack();
                return "Failed to book the table: " . $e->getMessage();
            }
        } else {
            return "Table does not exist.";
        }
    }

 
}
?>