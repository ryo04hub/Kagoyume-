<?php
session_start();

require_once("../util/defineUtil.php");
require_once("../util/dbaccessUtil.php");

$username = $_SESSION['username'];
$userInfo = search_users($username);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include '../lib/head-of-html.php' ?>
  <title>ユーザー削除</title>
</head>
<body>
  <?php include '../lib/header.php' ?>

  <div class="container">
    <h1>削除確認</h1>
    <?php
    foreach ($userInfo as $stmt => $row) {
    ?>
    <p>
    名前：<?php echo $row['name']; ?><br>
    パスワード：<?php echo $row['password']; ?><br>
    Email：<?php echo $row['mail']; ?><br>
    住所：<?php echo $row['address']; ?><br>
    </p>
    <?php
    }
    ?>
    <p>このユーザーをマジで削除しますか？</p>
    <p>
      <a href="<?php echo MY_DE_RESULT; ?>">はい</a><br>
      <a href="<?php echo ROOT_URL; ?>">いいえ</a>
    </p>
  </div>
</body>
</html>
