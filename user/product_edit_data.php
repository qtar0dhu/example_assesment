<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $image = $_FILES['image'];
    $user_id = $_SESSION['current_user']['id']; // ユーザーIDを取得

    try {
        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=finalassesment;charset=utf8;', 'root', '');
        $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ? AND user_id = ?');
        $stmt->execute([$id, $user_id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            echo '編集権限がありません。';
            exit;
        }

        $uploadFile = $product['image_url'];
        if ($image['size'] > 0) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $uploadFile = $uploadDir . basename($image['name']);
            move_uploaded_file($image['tmp_name'], $uploadFile);
        }

        $stmt = $pdo->prepare("UPDATE products SET name = ?, price = ?, category = ?, description = ?, image_url = ? WHERE id = ?");
        $stmt->execute([$name, $price, $category, $description, $uploadFile, $id]);

        echo '商品が更新されました。';
        echo '<a href="flea_product.php?id=' . htmlspecialchars($id) . '">商品詳細に戻る</a>';
    } catch (PDOException $e) {
        echo 'データベースエラー: ' . htmlspecialchars($e->getMessage());
    }
} else {
    echo '無効なリクエストです。';
}
?>
