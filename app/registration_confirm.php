<?php
session_start();

require_once("../util/yahoo_api.php");
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");


//登録内容を配列に格納
$conf_value = array(
  'username' => bind_p2s('username'),
  'password' => bind_p2s('password'),
  'email'    => bind_p2s('email'),
  'address'  => bind_p2s('address')
);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>登録内容確認</title>
  </head>
  <body>
    <?php if (!in_array(null, $conf_value, true)): ?>
      <div class="container">
        <h1>登録確認</h1>
        <p>ユーザーネーム：<?php echo $conf_value['username']; ?></p>
        <p>パスワード：<?php echo $conf_value['password']; ?></p>
        <p>メール：<?php echo $conf_value['email']; ?></p>
        <p>住所：<?php echo $conf_value['address']; ?></p>

        <p>上記の内容で登録いたします。よろしいですか？</p>
        <form class="" action="<?php echo REGIST_COMP; ?>" method="post">
          <button type="submit" name="regist">はい</button>
        </form>

        <form class="" action="<?php echo REGIST; ?>" method="post">
          <button type="submit" name="">いいえ</button>
        </form>
      </div>

    <?php else:
      foreach ($conf_value as $key => $value) {
        switch ($key) {
          case 'username':
          echo "ユーザー名を正しく入力してください<br>";
            break;
          case 'password':
            echo "パスワードを正しく入力してください<br>";
            break;
          case 'email':
            echo "メールアドレスを正しく入力してください<br>";
            break;
          case 'address':
            echo "住所を正しく入力してください<br>";
            break;
        }
      }
      ?>

      <div class="container">
        <form class="" action="<?php echo REGIST; ?>" method="post">
          <button type="submit" name="">登録画面へ戻る</button>
        </form>
      </div>

    <?php endif; ?>
  </body>
</html>
