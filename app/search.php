<?php
session_start();
require_once("../util/yahoo_api.php");
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");

?>

<!DOCTYPE html>
<html>
  <head>
    <?php include '../lib/head-of-html.php' ?>
    <title>検索結果</title>
  </head>
  <body>
    <?php include '../lib/header.php' ?>
    <?php

    //フォームから受け取った値のチェック、セット
    $query = !empty($_GET["query"]) ? $_GET["query"] : "";
    $sort =  !empty($_GET["sort"]) && array_key_exists($_GET["sort"], YAHOO_API_DATA::$sortOrder) ? $_GET["sort"] : "-score";
    $category_id = ctype_digit($_GET["category_id"]) && array_key_exists($_GET["category_id"], YAHOO_API_DATA::$categories) ? $_GET["category_id"] : 1;

    // フォームから受け取った値をセッションに保存
    // 商品詳細ページから戻った時に検索画面を表示させるために使用
    $_SESSION['query'] = $query;
    $_SESSION['sort'] = $sort;
    $_SESSION['category_id'] = $category_id;

    //クエリが空じゃない場合
  if ($query != "") {
    //ユーザーからの入力値をもとに、検索結果をxmlで取得
    $hits = array();
    $xml = YAHOO_CONTROLLER::deliveryItemList($category_id, $query, $sort);
    $hits = $xml->Result->Hit;

    //検索キーワード、検索結果数を変数に格納
    $search_word = $_GET["query"];
    $search_num = $xml["totalResultsReturned"];

  } elseif ($query == "") {
    //検索キーワード、検索結果数を下記にセット
    $search_word = "検索キーワードを入力してください。";
    $search_num = 0;
  }
    ?>
  <div class="container">
    <p><?php echo '検索キーワード：' .$search_word; ?></p>
    <p><?php echo '検索結果数：' .$search_num; ?></p>
  </div>


    <?php foreach ($hits as $hit): ?>
    <div class="container">

      <div class="Item">
          <h2>
            <a href="<?php echo ITEM. '?itemcode=' .h($hit->Code); ?>">
              <?php echo h($hit->Name); ?>
            </a>
          </h2>
          <p>
            <a href="<?php echo h($hit->Url); ?>">
              <img src="<?php echo h($hit->Image->Medium); ?>" />
            </a>
            <?php echo h($hit->Description); ?>
          </p>
      </div>

    </div>
    <?php endforeach; ?>
    
    <div class="container">
      <?php echo return_top(); ?>
    </div>
  </body>
</html>
