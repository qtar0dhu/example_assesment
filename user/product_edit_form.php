<?php
session_start();

if (!isset($_SESSION['current_user'])) {
    header('Location: login_form.php');
    exit;
}

try {
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=finalassesment;charset=utf8;', 'root', '');
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ? AND user_id = ?');
    $stmt->execute([$_GET['id'], $_SESSION['current_user']['id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo '編集権限がありません。';
        exit;
    }
} catch (PDOException $e) {
    echo 'データベースエラー: ' . htmlspecialchars($e->getMessage());
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品編集</title>
</head>
<body>
    <h1>商品編集</h1>
    <form action="product_edit_data.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
        <div>
            <label>商品名: <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required></label>
        </div>
        <div>
            <label>金額: <input type="number" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required></label>
        </div>
        <div>
            <label>カテゴリー: 
                <select name="category" required>
                    <option value="必修" <?php if ($product['category'] == '必修') echo 'selected'; ?>>必修科目教科書</option>
                    <option value="参考書" <?php if ($product['category'] == '参考書') echo 'selected'; ?>>参考書</option>
                    <option value="画材" <?php if ($product['category'] == '画材') echo 'selected'; ?>>画材</option>
                    <option value="デバイス" <?php if ($product['category'] == 'デバイス') echo 'selected'; ?>>デバイス</option>
                    <option value="古着" <?php if ($product['category'] == '古着') echo 'selected'; ?>>古着</option>
                    <option value="アクセサリー" <?php if ($product['category'] == 'アクセサリー') echo 'selected'; ?>>アクセサリー</option>
                    <option value="グッズ" <?php if ($product['category'] == 'グッズ') echo 'selected'; ?>>グッズ</option>
                    <option value="ゲーム" <?php if ($product['category'] == 'ゲーム') echo 'selected'; ?>>ゲーム</option>
                    <option value="書籍" <?php if ($product['category'] == '書籍') echo 'selected'; ?>>書籍</option>
                    <option value="その他" <?php if ($product['category'] == 'その他') echo 'selected'; ?>>その他</option>
                </select>
            </label>
        </div>
        <div>
            <label>説明文: <textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea></label>
        </div>
        <div>
            <label>写真: <input type="file" name="image" accept="image/*"></label>
        </div>
        <button type="submit">更新</button>
    </form>
</body>
</html>
