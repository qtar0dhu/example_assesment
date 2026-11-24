<?php
session_start();
$_SESSION = array();
session_destroy();

echo '<p>ログアウトしました</p>';
echo '<a href="login_form.php">LOGIN</a>';
