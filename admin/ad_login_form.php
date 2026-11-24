<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>
<body>
<h1>ADMINISTRATOR LOGIN</h1>
    <form action="ad_login_data.php" method="POST">
        <div>
            <label>ID</label>
            <input type="text" name="id" required>
        </div>
        <div>
            <label>PASSWORD</label>
            <input type="password" name="password" required>
        </div>
        <button>LOGIN</button>
    </form>
    <a href="ad_sign_up.php">ADD ADMINISTRATOR</a>



</body>
</html>
