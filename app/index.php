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

          <div class="input-group col-md-3 center">
              <select class="form-control" name="sort">
              <?php foreach (YAHOO_API_DATA::$sortOrder as $key => $value) { ?>
              <option value="<?php echo h($key); ?>"><?php echo h($value);?></option>
              <?php } ?>
            </select>
          </div>

          <div class="input-group col-md-3">
            <select class="form-control" name="category_id">
              <?php foreach (YAHOO_API_DATA::$categories as $id => $name) { ?>
              <option value="<?php echo h($id); ?>"><?php echo h($name);?></option>
              <?php } ?>
            </select>
          </div>

          <div class="input-group col-md-3">
            <input class="form-control" type="text" name="query" placeholder="キーワード">
          </div>

          <br>

          <input class="btn btn-primary col-sm-3" type="submit" value="Yahooショッピングで検索"/>

        </form>

    </div>
    </body>
</html>
