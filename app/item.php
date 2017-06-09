<?php
session_start();

require_once("../util/yahoo_api.php");
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");

/**
* serch.phpからセッションの値を受け取る
*
* この値は、下記の「検索結果に戻る」のリンクをクリックしてsearch.phpに戻る際に、URLにクエリを付与するために用いる。
* これにより、serach.phpは値を保持することができる
*/
$query = $_SESSION['query'];
$sort = $_SESSION['sort'];
$category_id = $_SESSION['category_id'];


/**
* serach.phpからGETで商品コードを受け取る
*
* その商品コードをもとに、検索結果をxml形式で受け取る
*/
$itemcode = $_GET['itemcode'];
$xml = Yahoo_Controller::getItemDetail($itemcode);
$hits = array();
$hits = $xml->Result->Hit
?>

<!DOCTYPE html>
<html>
  <head>
    <?php include '../lib/head-of-html.php' ?>
    <title>商品詳細</title>
  </head>
  <body>
    <?php include '../lib/header.php' ?>

    <div class="container">

      <h2>商品名：<?php echo $hits->Name; ?></h2>
      <img src="<?php echo $hits->Image->Medium; ?>" alt="商品画像" />
      <p>
        詳細：<?php echo $hits->Description; ?><br><br>
        価格：<?php echo $hits->Price; ?><br>
        評価：<?php echo $hits->Review->Rate; ?>
      </p>

      <form action="<?php echo ADD; ?>" method="POST">
        <button name="add">カートに入れる</button>
        <input type="hidden" name="itemcode" value="<?php echo $itemcode; ?>">
      </form>

      <a href="<?php echo SEARCH. '?query=' .$query. '&sort=' .$sort. '&category_id=' .$category_id; ?>">検索結果に戻る</a>
    </div>
  </body>
</html>
