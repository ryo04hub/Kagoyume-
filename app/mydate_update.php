<?php
session_start();

require_once("../util/yahoo_api.php");
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
require_once("../util/dbaccessUtil.php");

$username = $_SESSION['username'];
$userInfo = search_users($username);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>更新画面</title>
  <?php include '../lib/head-of-html.php' ?>
</head>
<body>
  <?php include '../lib/header.php' ?>
  <div class="container">
    <h1>マイデータ更新画面</h1>
    <form action="<?php echo MY_UP_RESULT; ?>" method="POST">
      <?php
      foreach ($userInfo as $stmt => $row) {
      ?>
        <div class="form-group">
            <label>ユーザー名</label>
            <input type="text" name="username" class="form-control" value="<?php print $row['name']; ?>" required>
        </div>
        <div class="form-group">
            <label>パスワード</label>
            <input type="password" name="password" class="form-control" value="<?php print $row['password']; ?>" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="mail" class="form-control" value="<?php print $row['mail']; ?>" required>
        </div>
        <div class="form-group">
            <label>住所</label>
            <input type="textarea" name="address" class="form-control" value="<?php print $row['address']; ?>" required>
        </div>
        <button type="submit" name="update">更新</button>
        <input type="hidden" name="mode" value="UPDATE">
      <?php } ?>
    </form>
    <p><a href="<?php echo MYDATE; ?>">戻る</a></p>
  </div>

</body>
</html>
