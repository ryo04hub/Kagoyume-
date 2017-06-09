<?php
session_start();

require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
require_once("../util/dbaccessUtil.php");

!isset($_SESSION['username']) ? $username = '' : $username  = $_SESSION['username'] ;

 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <title>ユーザー情報</title>
      <?php include '../lib/head-of-html.php'; ?>
   </head>
   <body>
     <?php include '../lib/header.php' ?>

     <?php if ($username === "Guestユーザー"): ?>
       <p>ログインすると会員情報が見れるようになります。<a href="<?php echo LOGIN; ?>">ログイン  </a></p>
       <p>まだ会員でない方はこちら：<a href="<?php echo REGIST; ?>">新規会員登録</a></p>
     <?php else: ?>
       <a href="<?php echo MY_HISTORY; ?>">購入履歴</a>
       <a href="<?php echo MY_DELETE; ?>">会員情報削除</a>
       <a href="<?php echo MY_UPDATE; ?>">登録情報更新</a>
     <?php endif; ?>

     <?php return_top(); ?>
   </body>
 </html>
