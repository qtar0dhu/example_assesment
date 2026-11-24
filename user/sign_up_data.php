<?php
  $email = $_POST['email'];
  $password  = password_hash($_POST['password'], PASSWORD_DEFAULT); // パスワードをハッシュ化
  try {
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=finalassesment;charset=utf8;', 'root', '');
    $stmt = $pdo->prepare("INSERT INTO user_accounts (email, password) VALUES(?, ?)");
    $stmt->execute([$email, $password]);
    echo '<p>登録しました</p>';
    echo '<a href="login_form.php">ログイン画面</a>';
  } catch (PDOException $e) {
    var_dump($e->getMessage());
  }
?>
      <p>登録しました</p>
      <a href="login_form.php">ログイン画面</a>
</body>
</html>
