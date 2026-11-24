<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>
<body>
    <h1>ログイン</h1>
    <form action="login_data.php" method="POST">
        <div>
            <label>メールアドレス: <input type="text" name="email" required></label>
        </div>
        <div>
            <label>パスワード: <input type="password" name="password" required></label>
        </div>
        <button type="submit">ログイン</button>
    </form>
    <a href="sign_up.php">登録はお済ですか？</a>
</body>
</html>
