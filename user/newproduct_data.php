<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $image = $_FILES['image'];
    $user_id = $_SESSION['current_user']['id']; // ユーザーIDを取得

    $uploadDir = 'uploads/';
    
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $uploadFile = $uploadDir . basename($image['name']);

    if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
        try {
            $pdo = new PDO('mysql:host=localhost;port=3306;dbname=finalassesment;charset=utf8;', 'root', '');
            $stmt = $pdo->prepare("INSERT INTO products (name, price, category, description, image_url, user_id) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $price, $category, $description, $uploadFile, $user_id]);
            echo '商品が登録されました。';
            echo '<a href="index.php">メインページに戻る</a>';
        } catch (PDOException $e) {
            echo 'データベースエラー: ' . htmlspecialchars($e->getMessage());
        }
    } else {
        echo '画像のアップロードに失敗しました。';
        echo 'エラーコード: ' . $image['error'];
    }
} else {
    echo '無効なリクエストです。';
}
?>
