<?php
require 'db.php';

$query = $pdo->query("SELECT * FROM creators");
$creators = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karya Kreator</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Daftar Kreator</h1>
        <div class="cards">
            <?php foreach ($creators as $creator): ?>
                <div class="card">
                    <img src="<?php echo $creator['image_url']; ?>" alt="<?php echo $creator['name']; ?>">
                    <div class="card-body">
                        <h3><?php echo $creator['name']; ?></h3>
                        <p><?php echo $creator['description']; ?></p>
                        <a href="creator.php?id=<?php echo $creator['id']; ?>" class="btn">Lihat Selengkapnya</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
