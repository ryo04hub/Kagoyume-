<?php
session_start();

require_once("../util/yahoo_api.php");
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
require_once("../util/dbaccessUtil.php");

$username = $_SESSION['username'];
$password = $_SESSION['password'];
$email = $_SESSION['email'];
$address = $_SESSION['address'];

// DBへのユーザー情報の登録
$insert_result = insert_users($username, $password, $email, $address);

/*
* データベースへの挿入に失敗（=返り値がnullではない）した場言にエラーメッセージを表示
*
*   insert_users関数の戻り値
*     DBへの挿入に成功：null
*     DBへの挿入に失敗：$e->getMessage();
*
*/
if ($insert_result != null) {
  $result_message = "データベースへの挿入に失敗しました。登録内容を確認の上、登録しなおしてください";
  echo $result_message;
  echo 'エラー内容：' .$insert_result;
} else {
  $result_message = '以上の内容で登録しました';
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>登録完了ページ</title>
  </head>
  <body>
    <div class="container">
      <h1>登録結果</h1>
      <p>ユーザーネーム：<?php echo $username; ?></p>
      <p>パスワード：<?php echo $password; ?></p>
      <p>メール：<?php echo $email; ?></p>
      <p>住所：<?php echo $address; ?></p>

      <!-- 登録完了メッセージまたはエラーメッセージをecho -->
      <p><?php echo $result_message; ?></p>
    </div>
    <?php echo return_top(); ?>
  </body>
</html>
