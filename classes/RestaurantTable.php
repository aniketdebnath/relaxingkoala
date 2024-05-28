<?php
class RestaurantTable {
    private $id;
    private $table_number;
    private $capacity;
    private $is_available;

    public function __construct($id, $table_number, $capacity, $is_available) {
        $this->id = $id;
        $this->table_number = $table_number;
        $this->capacity = $capacity;
        $this->is_available = $is_available;
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
}
?>
