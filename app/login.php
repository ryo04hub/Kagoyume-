<?php
session_start();
require_once ('../util/defineUtil.php');
require_once("../util/dbaccessUtil.php");
require_once("../util/scriptUtil.php");

!isset($_POST['username']) ? $_SESSION['username'] = 'Guestユーザー' : $_SESSION['username'] = $_POST['username'];

!isset($_POST['password']) ? $password = '' : $password = $_POST['password'];

!isset($_POST['username']) ? $userdatas = array() : $userdatas = search_users($_POST['username']);


//初期化
$loginMessage = '';

//後のパスワード判定に使うために配列を展開
if (!empty($userdatas)) {
  foreach ($userdatas as $key => $value) {
    $userdata =  $value;
  }

} else {
    $userdata['deleteFlg'] = ""; //後のerror回避のため
}

// search_usersで検索した$userdatasは、一致するユーザーが見つからないときにarray(0){}を返す
// そして、emptyを使って、そのnullを検知する
if (!empty($userdatas) && array_search($password, $userdata) !== false && $userdata['deleteFlg'] == 0) {
   $loginMessage =  "ログインに成功しました。<br>" ."<a href='".ROOT_URL."'>トップページへ</a>";

} elseif ($userdata['deleteFlg'] == 1) {
  $loginMessage = "これは削除されたユーザーです";

} elseif(!empty($_POST)) {

  if (empty($userdatas)) {
    $loginMessage = "ユーザーが見つかりません。正しいユーザー名を入力してください。<br>";

  } else {
    $loginMessage .= "正しいパスワードを入力してください";
  }
}

 ?>


<!DOCTYPE html>
<html>
  <head>
    <?php include '../lib/head-of-html.php'; ?>
    <title>ログイン</title>
  </head>
  <body>
    <?php include '../lib/header.php' ?>

    <div class="container">

      <h1>ログイン</h1>

      <form action="login.php" method="post">
        <div class="form-group">
          <label for="username">username</label>
          <input type="text" class="form-control" name="username" placeholder="username">
        </div>
        <div class="form-group">
          <label for="password">password</label>
          <input type="password" class="form-control" name="password" placeholder="password">
        </div>
          <input type="hidden" name="loginToBuyFlg" value="true">
        <button type="submit" class="btn btn-default">ログイン</button>
      </form>

    <!-- ログインに成功した場合、成功した場合でメッセージが変化 -->
    <p><?php echo $loginMessage; ?></p>

  </div>

  </body>
</html>
