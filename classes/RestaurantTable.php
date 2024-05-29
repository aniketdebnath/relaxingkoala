<?php
class RestaurantTable {
    private $id;
    private $table_number;
    private $capacity;
    private $is_available;
    private $reservation_time_start;
    private $reservation_time_end;
    private $reservation_date;

    public function __construct($id, $table_number, $capacity, $is_available, $reservation_time_start, $reservation_time_end, $reservation_date) {
        $this->id = $id;
        $this->table_number = $table_number;
        $this->capacity = $capacity;
        $this->is_available = $is_available;
        $this->reservation_time_start = $reservation_time_start;
        $this->reservation_time_end = $reservation_time_end;
        $this->reservation_date = $reservation_date; 
    }

    public function getId() {
        return $this->id;
    }

    public function getTableNumber() {
        return $this->table_number;
    }

    public function getCapacity() {
        return $this->capacity;
    }

    public function isAvailable() {
        return $this->is_available;
    }

    public function getReservationTimeStart() {
        return $this->reservation_time_start;
    }

    public function getReservationTimeEnd() {
        return $this->reservation_time_end;
    }

    public function getReservationDate() { 
        return $this->reservation_date;
    }
}
?>