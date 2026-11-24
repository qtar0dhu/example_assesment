<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fleamarket.css">
    <title>商品詳細</title>
</head>
<body>
    <div class="header">
        <h1><a href="index.php">MAIN PAGE</a></h1>
        <nav>
            <a href="#">授業・履修</a>
            <a href="#">課題</a>
            <a href="#">問い合わせ</a>
            <a href="#">学生情報</a>
            <a href="#">お知らせ</a>
            <a href="fleamarket_top.php">DHU生フリマ</a>
        </nav>
    </div>
    <div class="main-content">
        <?php
        try {
            $pdo = new PDO('mysql:host=localhost;port=3306;dbname=finalassesment;charset=utf8;', 'root', '');
            $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($product) {
                echo '<div class="product-detail">';
                echo '<img src="' . htmlspecialchars($product['image_url']) . '" alt="' . htmlspecialchars($product['name']) . '">';
                echo '<h2>' . htmlspecialchars($product['name']) . '</h2>';
                echo '<p>カテゴリー: ' . htmlspecialchars($product['category']) . '</p>';
                echo '<p>¥' . htmlspecialchars(number_format($product['price'])) . '</p>';
                echo '<p>' . htmlspecialchars($product['description']) . '</p>';
                echo '</div>';
            } else {
                echo '<p>商品が見つかりませんでした。</p>';
            }
        } catch (PDOException $e) {
            echo 'データベースエラー: ' . htmlspecialchars($e->getMessage());
        }
        ?>
    </div>
</body>
</html>
