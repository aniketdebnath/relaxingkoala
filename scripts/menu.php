<?php
session_start();
require_once '../includes/auth.php';
checkAuthentication();
require_once '../classes/menu_manager.php';

$menuManager = MenuManager::getInstance();
$items = $menuManager->getItems();
include '../includes/header.php';
?>

<h1>Menu</h1>
<ul>
    <?php foreach ($items as $item): ?>
        <li>
            <strong><?php echo htmlspecialchars($item['name']); ?></strong>
            <p><?php echo htmlspecialchars($item['description']); ?></p>
            <p>Price: $<?php echo number_format($item['price'], 2); ?></p>
        </li>
    <?php endforeach; ?>
</ul>

<?php include '../includes/footer.php'; ?>
