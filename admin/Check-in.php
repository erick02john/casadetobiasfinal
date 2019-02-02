<?php
session_start();
include("../dbconn.php");

$type = $_SESSION['UserType'];
$name = $_SESSION['Name'];

if(!empty($_SESSION['Username'])){
if($type != 'Admin'){
     echo ("<script language='JavaScript'>
        window.alert('Please Log In')
        window.location.href='../__login.php';
        </SCRIPT>");}
}else{
  echo ("<script language='JavaScript'>
        window.alert('Please Log In')
        window.location.href='../__login.php';
        </SCRIPT>");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Check-in</title>
<link rel="stylesheet" type="text/css" href="../backext/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../backext/css/admin.css">
<meta name="viewport" content="width=device-width, initial-scale=1">


<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<style type="text/css">
body{
  padding-right: 0 !important;
}
  li.one a:hover {
    background-color: #52697F;
    color: #003366;
  }

  li.one a:hover {
    background-color: #52697F;
    color: #003366;
  }


</style>

</head>
<body>
<script src="../backext/js/jquery.min.js"></script>
<script src="../backext/js/bootstrap.min.js"></script>
<script src = "../backext/js/admin.js"></script>
<div class="wrap">
  <nav class="nav-bar navbar-inverse" role="navigation">
      <div id ="top-menu" class="container-fluid active">
          <a class="navbar-brand" href="index.php" style="color:#dfab21; font-family: Arial Black, Helvetica, sans-serif; margin-left: 80px;">Casa de Tobias Mountain Resort</a>
          <ul class="nav navbar-nav">

              <li class="dropdown movable">

                      <li><a href="../Admin/logout.php" class="view btn-sm active" data-toggle="modal"  style="font-size: 15px; margin-top: 13px;"><i class="glyphicon glyphicon-log-out"></i>&nbsp;Log Out</a></li>
                  </ul>
              </li>

          </ul>
      </div>
  </nav>

  <aside id="side-menu" class="aside" role="navigation">
    <ul class="nav nav-list accordion">
      <li><img src="../images/logos/admin.png" width="100px" height="100px" style="margin-left: 50px;"></li>
      <li style="margin-left: 70px; font-family: Arial Black, Helvetica, sans-serif; font-size: 15px;">Admin</li>
   </ul>
   <ul class="nav nav-list accordion">
          <li class="nav-header">
            <div class="link"><i class="fa fa-lg fa-globe"></i>Transactions<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu">
              <li><a href="Reserved.php">Reserved</a></li>
              <li><a href="Pending.php">Pending</a></li>
              <li><a href="Check-in.php">Check-in</a></li>
              <li><a href="Check-out.php">Check-out</a></li>
            </ul>
          </li>
      </ul>
      <ul class="nav nav-list accordion">
          <li class="one">
            <a href="Rooms.php">Rooms</a>
          </li>
      </ul>

      <ul class="nav nav-list accordion">
          <li class="one">
            <a href="Billing.php">Billing</a>
          </li>
      </ul>
      <ul class="nav nav-list accordion">
          <li class="one">
            <a href="Accounts.php">Accounts</a>
          </li>
      </ul>
      <ul class="nav nav-list accordion">
          <li class="one">
            <a href="Discounts.php">Discount</a>
          </li>
      </ul>
      <ul class="nav nav-list accordion">
          <li class="one">
            <a href="datepickerform.php">Walk-in Guest</a>
          </li>
      </ul>
      <ul class="nav nav-list accordion">
          <li class="one">
            <a href="Reports.php">Reports</a>
          </li>
      </ul>

  </aside>
  <div class="content">
    <div class="top-bar">
      <a href="#menu" class="side-menu-link burger">
        <span class='burger_inside' id='bgrOne'></span>
        <span class='burger_inside' id='bgrTwo'></span>
        <span class='burger_inside' id='bgrThree'></span>
      </a>
    </div>
    <section class="content-inner">
      <section class="content-inner">
      <div class="well" style="margin-top:5px">
         <h1>Check-in</h1>
    <hr class="style-four">
    <div class="row">
    <div>
    <?php include 'displayCheck-in.php';?>

    </div>
    </div>
  </div>


      </section>
  </div>

  </div>

</div>
</body>
</html>
