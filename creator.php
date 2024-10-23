<?php
require 'db.php';

$id = $_GET['id'];

$query = $pdo->prepare("SELECT * FROM creators WHERE id = ?");
$query->execute([$id]);
$creator = $query->fetch(PDO::FETCH_ASSOC);

$works = explode(',', $creator['works']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karya <?php echo $creator['name']; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1><?php echo $creator['name']; ?>'s Works</h1>
        <p><?php echo $creator['description']; ?></p>
        
        <div class="works-container">
            <?php foreach ($works as $work): ?>
                <div class="work-item">
                    <img src="<?php echo trim($work); ?>" alt="Karya <?php echo $creator['name']; ?>">
                    <h3>Nama Karya</h3>
                    <p>Deskripsi singkat karya.</p>
                    <a href="#" class="btn">Klik di sini</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
