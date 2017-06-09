<?php
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");

//ユーザー名が未入力の場合に、Guestユーザーをセットする
//これをしないとユーザー名が未入力の場合に、undefinedというエラーが画面に表示されてしまう
if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = "Guestユーザー";
}

?>

<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<div class="container">

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo ROOT_URL; ?>">かごゆめ</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo MYDATE; ?>" class="scroll">ようこそ<?php echo $_SESSION['username']; ?>さん！</a></li>
        <li><a href="<?php echo CART; ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> User Account <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">User Account</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo MYDATE; ?>">MyInfo</a></li>
            <li><a href="<?php echo LOGIN; ?>">Login</a></li>
            <li><a href="<?php echo LOGOUT; ?>">Logout</a></li>
            <li><a href="<?php echo REGIST; ?>">Registrarion</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>
