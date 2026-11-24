<?php
  session_start();

  $id = $_POST['id'];
  $password = $_POST['password'];

  $json = file_get_contents('../data/administrators/secret.json');
  $administrator_map = json_decode($json, TRUE);

  $ids = array_map('map_id', $administrator_map['administrators']);
  $key = array_search($id, $ids);
  if ($key !== FALSE) {
    $administrator = $administrator_map['administrators'][$key];
    if (password_verify($password, $administrator['password'])) {
      $_SESSION['current_administrator'] = $administrator;

      echo 'ログインしました。';
      echo '<a href = "../admin/shop/index.php">ADMINISTRATOR HOME</a>';

    } else {
      echo 'パスワードが一致しませんでした。';
    }
  } else {
    echo 'IDが一致しません。';
  }

  function map_id($record) {
    return $record['id'];
  }
?>
