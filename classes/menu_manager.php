<?php
require_once 'config.php';

class MenuManager {
    private static $instance;
    private $items = [];

    private function __construct() {
        $this->loadItems();
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new MenuManager();
        }
        return self::$instance;
    }

    private function loadItems() {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM items');
        $this->items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getItems() {
        return $this->items;
    }

    public function getItemById($id) {
        foreach ($this->items as $item) {
            if ($item['id'] == $id) {
                return $item;
            }
        }
        return null;
    }

    public function addItem($name, $description, $price) {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO items (name, description, price) VALUES (?, ?, ?)');
        $stmt->execute([$name, $description, $price]);
        $this->loadItems(); // Reload items after adding
    }

    public function deleteItem($id) {
        global $pdo;
        $stmt = $pdo->prepare('DELETE FROM items WHERE id = ?');
        $stmt->execute([$id]);
        $this->loadItems(); // Reload items after deleting
    }
}
?>
