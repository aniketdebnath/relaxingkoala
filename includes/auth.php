<?php
function checkAuthentication() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../scripts/login.php");
        exit();
    }
}

function checkAdmin() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../scripts/index.php");
        exit();
    }
}
?>
