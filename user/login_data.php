<?php
  session_start();

  if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
      $pdo = new PDO('mysql:host=localhost;port=3306;dbname=finalassesment;charset=utf8;', 'root', '');
      $stmt = $pdo->prepare('SELECT * FROM user_accounts WHERE email = ?');
      $stmt->execute([$email]);
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($user && password_verify($password, $user['password'])) {
        $_SESSION['current_user'] = $user;

        echo 'ログインに成功しました。';
        echo '<a href="index.php">HOME</a>';
      } else {
        echo 'メールアドレスまたはパスワードが一致しませんでした。';
      }
    } catch (PDOException $e) {
      var_dump($e->getMessage());
    }
  } else {
    echo 'メールアドレスまたはパスワードが送信されていません。';
  }
?>
