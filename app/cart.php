<?php
session_start();

require_once("../util/yahoo_api.php");
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");

//合計金額の初期化
$totalPrice = 0;

//add.phpからセッションで商品詳細の情報を受け取る
!isset( $_SESSION['itemsInfo']) ? $itemsInfo = array() :$itemsInfo = $_SESSION['itemsInfo'];

/*
* 削除処理
*
* 削除したい商品の配列番号を受け取って、それと一致する商品をセッションから削除
* 最後に、削除後の値をセッションに代入することで、セッションの値を更新している
*/

isset($_GET['deleteId']) ? $deleteId = $_GET['deleteId'] : $deleteId = "";
unset($itemsInfo[$deleteId]);
$_SESSION['itemsInfo'] = $itemsInfo;

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

      <?php if ($_SESSION['itemsInfo'] === array()): ?>
        <p><?php echo "カートの中身が空です" ?></p>

      <?php else: ?>
        <?php foreach ($itemsInfo as $id => $itemInfo): ?>


        <!-- セッションで受け取った商品情報を順番に表示 -->
        <h2>商品名：<?php echo $itemInfo['name']; ?></h2>
        <img src="<?php echo $itemInfo['image']; ?>" alt="商品画像" onerror="this.src='../img/image-not-found.jpg'" height="150" width="150"/></a>
        <p>価格：<?php echo $itemInfo['price']; ?>円<br><br>

        <!-- カートの中身を削除 -->
        <!-- 個別の商品を識別するために、hideenで配列の番号を送っている -->
        <form class="" action="cart.php" method="GET">
          <input type="hidden" name="deleteId" value="<?php echo $id; ?>">
          <input type="submit" value="カートから削除">
        </form>
        <hr>

        <!-- 合計金額をセット -->
        <!-- foreachの中で合計金額をechoしてしまうと、各商品ごとに合計金額が表示されてしまうので、echoは後にする -->
        <?php $totalPrice += $itemInfo['price']; ?>

        <?php endforeach ?>

        <p>合計金額：<?php echo $totalPrice;?>円</p>

        <!-- ログインしているかどうかで、表示される画面を分けている -->
        <?php if ($_SESSION['username'] === 'Guestユーザー'): ?>
          <a href="<?php echo LOGIN; ?>">ログインして購入する</a>
        <?php else: ?>
          <form action="<?php echo BUY_CONF; ?>" method="POST">
            <button type="submit" name="buy_conf" value="buy_conf">購入画面へ進む</button>
          </form>
        <?php endif; ?>

      <?php endif; ?>
    </div>
    <?php echo return_top(); ?>
  </body>
</html>
