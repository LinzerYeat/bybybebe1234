<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include("../db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Админ-панель</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="admin-header">
        <h1>Админ-панель MobileShop</h1>
        <a href="logout.php" class="logout">Выйти</a>
    </div>

    <div class="admin-menu">
        <a href="products.php">Товары</a>
        <a href="orders.php">Заказы</a>
    </div>

    <div class="admin-content">
        <h2>Добро пожаловать, <?php echo $_SESSION['admin']; ?></h2>
        <p>Здесь вы можете управлять товарами и заказами.</p>
    </div>
</body>
</html>