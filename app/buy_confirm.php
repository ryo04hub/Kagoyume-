<?php
session_start();

require_once("../util/yahoo_api.php");
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");

//合計金額の初期化
$totalPrice = 0;

//add.phpからセッションで商品詳細の情報を受け取る
$itemsInfo = $_SESSION['itemsInfo'];

?>

<!DOCTYPE html>
<html>
  <head>
    <?php include '../lib/head-of-html.php' ?>
    <title>カート</title>
  </head>
  <body>
    <?php include '../lib/header.php' ?>

    <div class="container">

      <?php
      foreach ($itemsInfo as $id => $itemInfo): ?>

        <!-- セッションで受け取った商品情報を順番に表示 -->
        <p>商品名：<?php echo $itemInfo['name']; ?><p>
        <p>価格：<?php echo $itemInfo['price']; ?>円<br>
        <hr>

        <!-- 合計金額をセット -->
        <!-- foreachの中で合計金額をechoしてしまうと、各商品ごとに合計金額が表示されてしまうので、echoは後にする -->
        <?php $totalPrice += $itemInfo['price']; ?>

        <?php endforeach ?>

        <p>合計金額：<?php echo $totalPrice;?>円</p>

        <form action="<?php echo BUY_COMP; ?>" method="POST">
          発送方法：
          <input type="radio" value="1" name="delivery" checked>メール便
          <input type="radio" value="2" name="delivery">通常便<br>
          <input type="hidden" name="totalPrice" value="<?php echo $totalPrice; ?>">
          <button type="submit" name="buy_comp" value="buy_comp">上記の内容で購入する</button>
        </form>

      <p><a href="<?php echo CART; ?>">カートに戻る</a></p>
      <?php echo return_top(); ?>
  </div>
  </body>
</html>
