<?php
  $user_accounts= array();
  try {
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=finalassesment;charset=utf8;', 'root', '');
    $stmt = $pdo->query('SELECT * FROM user_accounts');
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      array_push($user_accounts, $row);
    }
  } catch (PDOException $e) {
    var_dump($e->getMessage());
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user sign up</title>
</head>
<body>
<h1>user新規登録</h1>

  <form action="sign_up_data.php" method="POST">

    <div>
      <label>email: <input type="text" name="email" required></label>
    </div>

    <div>
      <label>password: <input type="password" name="password" autocomplete="new-password" required></label>
    </div>

    <button>登録</button>
    
  </form>
<a href="login_form.php">登録がお済の方はこちら</a>
</body>
</html>
