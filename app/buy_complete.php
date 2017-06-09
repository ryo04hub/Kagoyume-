<?php
session_start();

require_once("../util/yahoo_api.php");
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
require_once("../util/dbaccessUtil.php");

/* -------------------------------------------------------------------

  DB挿入の下準備

------------------------------------------------------------------- */

/**
* ユーザー名を変数にセット。三項演算子で未入力時の処理
*
*   なお、セッションにユーザー名がセットされるタイミングは、login.phpでログインした時
*
*/
!isset($_SESSION['username']) ? $username = '' :  $username = $_SESSION['username'] ;

/* 上記の$username元にuserIDを取得 */
$userID = return_userID($username);

/**
* add.phpにてセットしたセッションを取得
*
*   なお、セッションの中身は以下の通りである
*
*     $_SESSION['itemsInfo'][] =
*      array(
*        'image'    => h($hits->Image->Medium),
*        'name'     => h($hits->Name),
*        'price'    => h($hits->Price),
*        'itemcode' => $itemcode
*    );
*/
$itemsInfo = $_SESSION['itemsInfo'];

/* buy_confirm.phpのhiddenに指定したフォームから、合計金額を受け取る */
$totalPrice = $_POST['totalPrice'];

/* buy_confirm.phpから配送方法の情報を受け取る */
$type = $_POST['delivery'];


/* -------------------------------------------------------------------

  購入情報をDBに挿入

------------------------------------------------------------------- */

foreach ($itemsInfo as $id => $itemInfo) {
  $itemcode = $itemInfo['itemcode'];
  insert_items($userID, $itemcode, $type);
}

/* -------------------------------------------------------------------

   合計購入金額を更新

------------------------------------------------------------------- */
total_price_add($userID, $totalPrice);


/* -------------------------------------------------------------------

   カートの中身を空にする

------------------------------------------------------------------- */
$_SESSION['itemsInfo'] = array();

?>

<!DOCTYPE html>
<html>
  <head>
    <?php include '../lib/head-of-html.php' ?>
    <title>購入完了ページ</title>
  </head>
  <body>
    <?php include '../lib/header.php' ?>

    <div class="container">

      <h3>購入が完了しました</h3>

      <?php
      foreach ($itemsInfo as $id => $itemInfo): ?>

      <!-- セッションで受け取った商品情報を順番に表示 -->
      <p>商品名：<?php echo $itemInfo['name']; ?><p>
      <p>価格：<?php echo $itemInfo['price']; ?>円<br><br>
      <p>配送方法：<?php echo $type; ?></p>
      <p>※(1)メール便, (2)通常配送</p>
      <hr>

      <?php endforeach ?>

      <p>合計金額：<?php echo $totalPrice;?>円</p>

      <?php echo return_top(); ?>
    </div>
  </body>
</html>
