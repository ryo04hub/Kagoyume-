<?php
session_start();

require_once("../util/yahoo_api.php");
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
require_once("../util/dbaccessUtil.php");

$username = $_SESSION['username'];
$userID = return_userID($username);
delete_user($userID);

$_SESSION['username'] = 'Guestユーザー';

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include '../lib/head-of-html.php'; ?>
<title>削除結果</title>
</head>
<body>
  <?php include '../lib/header.php' ?>
  <div class="container">
    <h1>削除完了</h1>
    <p>削除しました。</p>
    <p><?php echo return_top(); ?></p>
  </div>
</body>
</html>
