<?php
session_start();

require_once("../util/yahoo_api.php");
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");

?>

<html>
    <head>
      <title>かごゆめ</title>
      <?php include '../lib/head-of-html.php'; ?>
    </head>
    <body>
      <?php include '../lib/header.php' ?>

      <div class="container">

        <form action="<?php echo SEARCH; ?>" class="Search">

          <div class="input-group">
              <select class="form-control" name="sort">
              <?php foreach (YAHOO_API_DATA::$sortOrder as $key => $value) { ?>
              <option value="<?php echo h($key); ?>"><?php echo h($value);?></option>
              <?php } ?>
            </select>
          </div>

          <div class="input-group">
            <select class="form-control" name="category_id">
              <?php foreach (YAHOO_API_DATA::$categories as $id => $name) { ?>
              <option value="<?php echo h($id); ?>"><?php echo h($name);?></option>
              <?php } ?>
            </select>
          </div>

          <div class="input-group">
            <input class="form-control" type="text" name="query" placeholder="キーワード">
          </div>

          <input class="btn btn-primary col-sm-3" type="submit" value="Yahooショッピングで検索"/>

        </form>
    <!-- Begin Yahoo! JAPAN Web Services Attribution Snippet -->
    <a href="http://developer.yahoo.co.jp/about">
    <img src="http://i.yimg.jp/images/yjdn/yjdn_attbtn2_105_17.gif" width="105" height="17" title="Webサービス by Yahoo! JAPAN" alt="Webサービス by Yahoo! JAPAN" border="0" style="margin:15px 15px 15px 15px"></a>
    <!-- End Yahoo! JAPAN Web Services Attribution Snippet -->

    </div>
    </body>
</html>
