<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>

<?php
  $id = $_POST['id'];
  $password = $_POST['password'];

  $json = file_get_contents('../data/administrators/secret.json');
  $administrator_map = json_decode($json, TRUE);

  array_push($administrator_map['administrators'], [
    'id' => $id,
    'password' => password_hash($password, PASSWORD_DEFAULT)
  ]);

  $json = json_encode($administrator_map);
  file_put_contents('../data/administrators/secret.json', $json);

  echo '登録しました。';
  ?>

      <a href="ad_login_form.php">LOGIN</a>
</body>
</html>
