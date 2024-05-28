<?php
require_once 'config.php';
require_once 'menu_manager.php';

class Manager {
    private $id;
    private $name;
    private $email;

    public function __construct($id) {
        $this->id = $id;
        $this->loadManagerDetails();
    }

    private function loadManagerDetails() {
        global $pdo;
        $stmt = $pdo->prepare('SELECT name, email FROM admins WHERE id = ?');
        $stmt->execute([$this->id]);
        $manager = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($manager) {
            $this->name = $manager['name'];
            $this->email = $manager['email'];
        } else {
            throw new Exception('Manager not found');
        }
    }

    public function addItem($name, $description, $price) {
        $menuManager = MenuManager::getInstance();
        $menuManager->addItem($name, $description, $price);
    }

    public function deleteItem($id) {
        $menuManager = MenuManager::getInstance();
        $menuManager->deleteItem($id);
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
}
?>
