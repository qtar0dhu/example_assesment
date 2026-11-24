<?php
session_start();

if (!isset($_SESSION['current_user'])) {
    header('Location: login_form.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user_id = $_SESSION['current_user']['id']; // ユーザーIDを取得

    try {
        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=finalassesment;charset=utf8;', 'root', '');
        $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ? AND user_id = ?');
        $stmt->execute([$id, $user_id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            echo '削除権限がありません。';
            exit;
        }

        $stmt = $pdo->prepare('DELETE FROM products WHERE id = ?');
        $stmt->execute([$id]);

        // 削除後にリダイレクト
        header('Location: fleamarket_top.php');
        exit;
    } catch (PDOException $e) {
        echo 'データベースエラー: ' . htmlspecialchars($e->getMessage());
    }
} else {
    echo '無効なリクエストです。';
}
?>
