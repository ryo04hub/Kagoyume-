<?php
session_start();
require_once ('../util/defineUtil.php');
require_once("../util/dbaccessUtil.php");
require_once("../util/scriptUtil.php");

/* -------------------------------------------------------------------

  POSTでログインフォームからの情報を受け取る処理

------------------------------------------------------------------- */

!isset($_POST['username']) ? $_SESSION['username'] = 'Guestユーザー' : $_SESSION['username'] = $_POST['username'];

!isset($_POST['password']) ? $password = '' : $password = $_POST['password'];

!isset($_POST['username']) ? $userdatas = array() : $userdatas = search_users($_POST['username']); //未入力時に配列として初期化しているのは、のちにforeachで展開する際のエラーを回避するため


/* -------------------------------------------------------------------

  ログイン時、エラーメッセージを表示するための処理

------------------------------------------------------------------- */

$loginMessage = ''; //初期化

//後のパスワード判定に使うために配列を展開
if (!empty($userdatas)) {
  foreach ($userdatas as $key => $value) {
    $userdata =  $value;
  }
} else {
    $userdata['deleteFlg'] = ""; //後のerror回避のため。$userdata['deleteFlg']になにも入っていないとログイン判定時にエラーが出てしまう。
}

/**
* ログイン成功時の判定の解説
*
* !empty($userdatas)
*   $userdatasはsearch_usersというユーザー定義関数で検索して取得しているが、これは一致するユーザーが見つからないときにarray(0){}を返す。
*   array(0){}はnullということなので、emptyを使ってそのnullを検知する
*
* array_search($password, $userdata) !== false
*   $userdataの中に、フォームから受け取ったパスワードが存在しているかをチェックしている。見つからなかった場合にはfalseを返す。
*   なお、$userdataは上記のforeach文で取得している。
*
* $userdata['deleteFlg'] == 0
*   ユーザーが削除されているかどうかの判定
*/

if (!empty($userdatas) && array_search($password, $userdata) !== false && $userdata['deleteFlg'] == 0) {
   $loginMessage =  "ログインに成功しました。<br>" ."<a href='".ROOT_URL."'>トップページへ</a>";

} elseif ($userdata['deleteFlg'] == 1) {
  $loginMessage = "これは削除されたユーザーです";

} elseif (!empty($_POST)) {

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
