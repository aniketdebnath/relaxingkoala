<?php
class RestaurantStaff {
    protected $staffID;
    protected $name;

    public function __construct($staffID, $name) {
        $this->staffID = $staffID;
        $this->name = $name;
    }
}
?>
