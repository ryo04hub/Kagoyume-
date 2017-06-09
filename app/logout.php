<?php
session_start();

require_once("../util/scriptUtil.php");
require_once("../util/defineUtil.php");

$_SESSION = array();
session_destroy();

//ユーザー名の初期化
$_SESSION['username'] = ' ';


?>

<!DOCTYPE html>
<html>
  <head>
    <?php include '../lib/head-of-html.php'; ?>
    <title>ログアウト</title>
  </head>
  <body>
    <?php include '../lib/header.php' ?>
    <div class="container">
      <h1>ログアウト</h1>
      <p>ログアウト完了</p>
    </div>
    <?php echo return_top(); ?>
  </body>
</html>
