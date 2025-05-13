<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include("../db.php");

// Добавление товара
if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $target = "../images/" . basename($image);

    move_uploaded_file($_FILES['image']['tmp_name'], $target);
    $query = "INSERT INTO products (name, price, image) VALUES ('$name', '$price', '$image')";
    mysqli_query($conn, $query);
}

// Удаление товара
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id=$id");
}

$products = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Управление товарами</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="admin-header">
        <h1>Управление товарами</h1>
        <a href="index.php" class="back">Назад</a>
    </div>

    <div class="admin-content">
        <h2>Добавить новый товар</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Название" required>
            <input type="number" name="price" placeholder="Цена" required>
            <input type="file" name="image" required>
            <button type="submit" name="add_product">Добавить</button>
        </form>

        <h2>Список товаров</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Изображение</th>
                <th>Действия</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($products)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['price']; ?> ₽</td>
                <td><img src="../images/<?php echo $row['image']; ?>" width="50"></td>
                <td>
                    <a href="products.php?delete=<?php echo $row['id']; ?>" class="delete">Удалить</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>