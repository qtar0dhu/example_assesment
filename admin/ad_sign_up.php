<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
</head>
<body>
<h1>管理者登録</h1>

  <form action="ad_sign_up_data.php" method="POST">

    <div>
      <label>ID: <input type="text" name="id" required></label>
    </div>

    <div>
      <label>PASSWORD: <input type="password" name="password" autocomplete="new-password" required></label>
    </div>

    <button>登録</button>
    
  </form>
<a href="ad_login_form.php">LOGIN</a>
</body>
</html>
