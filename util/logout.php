<?php
session_start();
$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>ログアウト</title>
  </head>
  <body>
    <h1>ログアウト</h1>
    <p>ログアウト完了</p>
    <p><a href="login.php">再ログインする</a></p>
  </body>
</html>
