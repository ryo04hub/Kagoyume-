<?php
session_start();

require_once("../util/yahoo_api.php");
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");

//registration_confirmで戻るボタンが押された際に値を保持するための処理
$_SESSION['username'] === 'Guestユーザー' ? $username = '' : $username = $_SESSION['username'];
isset( $_SESSION['password']) ? $password = $_SESSION['password'] : $password = '';
isset( $_SESSION['email']) ? $email = $_SESSION['email'] : $email = '';
isset( $_SESSION['address']) ? $address = $_SESSION['address'] : $address = '';

 ?>

<!DOCTYPE html>
<html>
  <head>
    <?php include '../lib/head-of-html.php'; ?>
    <title>新規登録ページ</title>
  </head>
  <body>
    <?php include '../lib/header.php' ?>

    <div class="container">

      <h1>新規登録</h1>
      <h3>登録情報を入力してください</h3>

      <form action="<?php echo REGIST_CONF ?>" method="post">
        <div class="form-group">
          <label for="username">username</label>
          <input type="text" class="form-control" name="username" placeholder="username" value="<?php echo $username; ?>">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" placeholder="password" value="<?php echo $password; ?>">
        </div>
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" name="email" placeholder="email" value="<?php echo $email; ?>">
        </div>
        <div class="form-group">
          <label for="c">Adress</label>
          <input type="address" class="form-control" name="address" placeholder="address" value="<?php echo $address; ?>">
        </div>
        <button type="submit" class="btn btn-default">登録</button>
      </form>

    </div>
  </body>
</html>
