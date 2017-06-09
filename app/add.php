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


/* item.phpから商品コードを受け取り、APIを叩いて商品詳細を取得 */
$itemcode = $_POST['itemcode'];

$xml = YAHOO_CONTROLLER::getItemDetail($itemcode);
$hits = array();
$hits = $xml->Result->Hit;

/**
* cart.phpでカートの中身を表示させるために、商品情報をセッションに格納
*
* ※空の[]は、多次元配列としてセッションを格納するためにある。
* これがないとセッションを一つしか保存できず、毎回上書きされることになってしまうため。
*/
  $_SESSION['itemsInfo'][] =
    array(
      'image'    => h($hits->Image->Medium),
      'name'     => h($hits->Name),
      'price'    => h($hits->Price),
      'itemcode' => $itemcode
    );

?>

<!DOCTYPE html>
<html>
  <head>
    <?php include '../lib/head-of-html.php'; ?>
    <title>商品追加ページ</title>
  </head>
  <body>
    <?php include '../lib/header.php' ?>
    <div class="container">
        
      <h2>以下の商品をカートに追加しました。</h>
      <h2>商品名：<?php echo $hits->Name; ?></h2>
      <img src="<?php echo $hits->Image->Medium; ?>" alt="商品画像" />
      <p>
        詳細：<?php echo $hits->Description; ?><br><br>
        価格：<?php echo $hits->Price; ?><br>
        評価：<?php echo $hits->Review->Rate; ?>
      </p>

      <a href="<?php echo CART ?>">カートの中身を見る</a>
      <a href="<?php echo SEARCH. '?query=' .$query. '&sort=' .$sort. '&category_id=' .$category_id; ?>">検索結果に戻る</a>
    </div>
  </body>
</html>
