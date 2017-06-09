<?php
session_start();

require_once("../util/yahoo_api.php");
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
require_once("../util/dbaccessUtil.php");

$username = $_SESSION['username'];
$userID = return_userID($username);
$itemInfo = search_items(intval($userID));

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include '../lib/head-of-html.php'; ?>
  <title>購入履歴</title>
</head>
<body>
  <?php include '../lib/header.php' ?>
  <div class="container">
    <h1>購入履歴</h1>
  </div>

    <?php
      foreach ($itemInfo as $stmt => $row) {
        $xml = YAHOO_CONTROLLER::getItemDetail($row['itemCode']);
        ?>
      <div class="container">
        <div class="itemDetailImg col-sm-4">
          <img src="<?php echo $xml->Result->Hit->Image->Medium; ?>" alt="商品画像" />
        </div>
        <div class="itemDetailSentence col-sm-8">
          <h2>商品名：<?php echo $xml->Result->Hit->Name; ?></h2>
          <p>
          価格：<?php echo $xml->Result->Hit->Price; ?><br>
          評価：<?php echo $xml->Result->Hit->Review->Rate; ?>
          </p>
          <hr>
        </div>
      </div>
    <?php
      }
    ?>
    <div class="container">
      <a href="<?php echo MYDATE; ?>">戻る</a>
    </div>
</body>
</html>
