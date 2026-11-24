<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fleamarket.css">
    <title>DHU生フリマ</title>
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
        <div class="sidebar">
            <h2>カテゴリー</h2>
            <ul>
                <li><a href="?category=必修">必修科目教科書</a></li>
                <li><a href="?category=参考書">参考書</a></li>
                <li><a href="?category=画材">画材</a></li>
                <li><a href="?category=デバイス">デバイス</a></li>
                <li><a href="?category=古着">古着</a></li>
                <li><a href="?category=アクセサリー">アクセサリー</a></li>
                <li><a href="?category=グッズ">グッズ</a></li>
                <li><a href="?category=ゲーム">ゲーム</a></li>
                <li><a href="?category=書籍">書籍</a></li>
                <li><a href="?category=その他">その他</a></li>
            </ul>
            <h2>検索</h2>
            <form action="" method="GET">
                <input type="text" name="search" placeholder="商品名で検索">
                <button type="submit">検索</button>
            </form>
            <a href="newproduct_form.php" class="button">出品</a>
        </div>
        <div class="products_list">
            <h2>商品一覧</h2>
            <?php
            session_start();

            try {
                $pdo = new PDO('mysql:host=localhost;port=3306;dbname=finalassesment;charset=utf8;', 'root', '');
                $query = 'SELECT * FROM products';
                $params = [];

                if (isset($_GET['category'])) {
                    $query .= ' WHERE category = ?';
                    $params[] = $_GET['category'];
                }

                if (isset($_GET['search'])) {
                    $query .= isset($_GET['category']) ? ' AND' : ' WHERE';
                    $query .= ' name LIKE ?';
                    $params[] = '%' . $_GET['search'] . '%';
                }

                $stmt = $pdo->prepare($query);
                $stmt->execute($params);

                while ($product = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="product">';
                    echo '<a href="flea_product.php?id=' . htmlspecialchars($product['id']) . '">';
                    echo '<img src="' . htmlspecialchars($product['image_url']) . '" alt="' . htmlspecialchars($product['name']) . '">';
                    echo '<h2>' . htmlspecialchars($product['name']) . '</h2>';
                    echo '</a>';
                    echo '<p>カテゴリー: ' . htmlspecialchars($product['category']) . '</p>';
                    echo '<p>¥' . htmlspecialchars(number_format($product['price'])) . '</p>';
                    if (isset($_SESSION['current_user']) && $_SESSION['current_user']['id'] == $product['user_id']) {
                        echo '<a href="product_edit_form.php?id=' . htmlspecialchars($product['id']) . '" class="button">編集</a>';
                        echo '<a href="product_delete.php?id=' . htmlspecialchars($product['id']) . '" class="button">削除</a>';
                    }
                    echo '</div>';
                }
            } catch (PDOException $e) {
                echo 'データベースエラー: ' . htmlspecialchars($e->getMessage());
            }
            ?>
        </div>
    </div>
</body>
</html>
