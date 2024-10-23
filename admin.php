<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];
    $works = $_POST['works'];

    $stmt = $pdo->prepare("INSERT INTO creators (name, description, image_url, works) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $description, $image_url, $works]);

    header("Location: admin.php");
    exit;
}

$query = $pdo->query("SELECT * FROM creators");
$creators = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Admin Panel</h1>
        
        <h2>Tambah Kreator Baru</h2>
        <form action="admin.php" method="POST">
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" required>

            <label for="description">Deskripsi:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="image_url">URL Gambar:</label>
            <input type="text" id="image_url" name="image_url" required>

            <label for="works">Karya (pisahkan dengan koma):</label>
            <input type="text" id="works" name="works" required>

            <button type="submit" class="btn">Tambah Kreator</button>
        </form>

        <h2>Daftar Kreator</h2>
        <div class="cards">
            <?php foreach ($creators as $creator): ?>
                <div class="card">
                    <h3><?php echo $creator['name']; ?></h3>
                    <p><?php echo $creator['description']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
