<?php
session_start();

require_once("../util/yahoo_api.php");
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");

/* -------------------------------------------------------------------

フォームから受け取った値のセット

------------------------------------------------------------------- */

$query = !isset($_GET["query"]) ? "" : $_GET["query"];

// $_GET['sort']の値が不正な場合、「おすすめ順」にセットする
$sort =  !array_key_exists($_GET["sort"], YAHOO_API_DATA::$sortOrder) ? "-score" : $_GET["sort"];

// $_GET['category_id']の値が不正な場合、「すべてのカテゴリから」にセットする
$category_id = !array_key_exists($_GET["category_id"], YAHOO_API_DATA::$categories) ? 1 : $_GET["category_id"];


/**
* 商品詳細ページからこの検索画面に戻ったときに、検索内容を保持するためにセッションをセット
*  このセッションの値はitem.phpにて使用する。
*/
$_SESSION['query'] = $query;
$_SESSION['sort'] = $sort;
$_SESSION['category_id'] = $category_id;

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
      if ($query !== ""):
        //ユーザーからの入力値をもとに、検索結果をxmlで取得
        $hits = array();
        $xml = YAHOO_CONTROLLER::deliveryItemList($category_id, $query, $sort);
        $hits = $xml->Result->Hit;

        //検索キーワード、検索結果数を変数に格納
        $search_word = $_GET["query"];
        $search_num = $xml["totalResultsReturned"];
        ?>

        <?php foreach ($hits as $hit): ?>
          <div class="container">
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
        <?php endforeach; ?>

          <?php
        elseif ($query == ""):
        $search_word = "検索キーワードを入力してください。";
        $search_num = 0;

        endif;
        ?>

        <div class="container">
          <p><?php echo '検索キーワード：' .$search_word; ?></p>
          <p><?php echo '検索結果数：' .$search_num; ?></p>
        </div>

        <?php echo return_top(); ?>
      </body>
</html>
