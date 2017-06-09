<?php
session_start();

require_once("../util/yahoo_api.php");
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
require_once("../util/dbaccessUtil.php");

$userID = return_userID($_SESSION['username']);
$username = $_POST['username'];
$password = $_POST['password'];
$mail = $_POST['mail'];
$address = $_POST['address'];

update_users($userID, $username, $password, $mail, $address);
$update_user = search_users($username);

foreach ($update_user as $stmt => $row) {
  $_SESSION['username'] = $row['name'];
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include '../lib/head-of-html.php' ?>
  <title>更新結果</title>
<body>
  <?php include '../lib/header.php' ?>
  <div class="container">
    <h1>更新完了</h1>
    <p>以下の内容で更新しました。</p>
    <p>
      名前：<?php echo $username; ?><br>
      パスワード：<?php echo $password; ?><br>
      Email：<?php echo $mail; ?><br>
      住所：<?php echo $address; ?><br>
    </p>
  </div>
  <?php echo return_top(); ?>
</body>
</html>
