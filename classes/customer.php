<?php
require_once 'config.php';

class Customer {
    private $id;
    private $name;
    private $email;
    private $phone;

    public function __construct($id) {
        $this->id = $id;
        $this->loadCustomerDetails();
    }

    private function loadCustomerDetails() {
        global $pdo;
        $stmt = $pdo->prepare('SELECT name, email, phone FROM customers WHERE id = ?');
        $stmt->execute([$this->id]);
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($customer) {
            $this->name = $customer['name'];
            $this->email = $customer['email'];
            $this->phone = $customer['phone'];
        } else {
            throw new Exception('Customer not found');
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPhone() {
        return $this->phone;
    }
}
?>
