<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit();
include '../includes/header.php';
?>
<?php include '../includes/footer.php'; ?>
