<?php
session_start();
include("../db.php");
$name = $_SESSION['Name'];

$type = $_SESSION['UserType'];

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
<title>Admin</title>
<link rel="stylesheet" type="text/css" href="../backext/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../backext/css/admin.css">
<meta name="viewport" content="width=device-width, initial-scale=1">


<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<style type="text/css">
body{
    overflow: hidden;
    width: 100%;
  padding-right: 0 !important;
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

  <div class="tableposition">
        <div class="well" style="margin-top:50px">
    <h1>Generate Reports</h1>
    <hr class="style-four">

    <div class="row">
    <div class="col-md-8 col-lg-offset-3 text-center" style="margin-left: 20px">
      <h2>Reservations</h2>

    <!-- <a href="#all" data-toggle="modal" class="btn btn-lg btn-primary" >&nbsp;&nbsp;&nbsp;&nbsp;All&nbsp;&nbsp;&nbsp;&nbsp;</a> -->
     <a href="#dailyreservation" data-toggle="modal" class="btn btn-lg btn-primary" >Daily</a>
     <a href="#weeklyreservation" data-toggle="modal" class="btn btn-lg btn-primary" >Weekly</a>
     <a href="#monthlyreservation" data-toggle="modal" class="btn btn-lg btn-primary" >Monthly</a>
     <a href="#yearlyreservation" data-toggle="modal" class="btn btn-lg btn-primary" >Yearly</a>
     <!--<a href="#reservation" data-toggle="modal" class="btn btn-lg btn-primary" >overall</a>-->
           <hr style="padding: 1px;">
     <!-- <a href="#allreservation" data-toggle="modal" class="btn btn-lg btn-primary" >all</a> -->


   <br>
      <h2>Billing</h2>
   <!--  <a href="#billing" data-toggle="modal" class="btn btn-lg btn-primary" >Billing Transactions</a> -->
    <a href="#dailybilling" data-toggle="modal" class="btn btn-lg btn-primary" >Daily</a>
     <a href="#weeklybilling" data-toggle="modal" class="btn btn-lg btn-primary" >Weekly</a>
     <a href="#monthlybilling" data-toggle="modal" class="btn btn-lg btn-primary" >Monthly</a>
     <a href="#yearlybilling" data-toggle="modal" class="btn btn-lg btn-primary" >Yearly</a>
     <!--<a href="#billing" data-toggle="modal" class="btn btn-lg btn-primary" >overall</a>-->
    <!-- <a href="#sales" data-toggle="modal" class="btn btn-lg btn-primary" >Point of sales</a> -->

    </div>
    </div>
  </div>
<!-- daily -->
<div class="modal fade" id="dailyreservation" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reservation Reports</h4>
        </div>
        <div class="modal-body">
        <div>
    <div class='table-responsive'>
    <table class="table">
       <form method="post" target="_blank" action="reservationdailypdf.php">
             <input type="hidden" name="id"  value="<?php echo $name; ?>" >
          <h3>Select day of this week:</h3>
          <br>
          <select class="form-control" name = "day">
            <option value="Monday" selected>Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
            <option value="Sunday">Sunday</option>
            </select>
          </br>

           <select class="form-control" name = "status" onchange = "filterFunction2();">
            <option value='All Reservation' SELECTED>All Reservation</option>
            <option value='Pending'>Pending</option>
            <option value='Reserved'>Reserved</option>
            <option value="Checked-in">Checked-in</option>
            <option value="Checked-out">Checked-out</option>
            <option value="No show">No show</option>

          </select>
    </table>
    </div>
    </div>
    </div>
        <div class='modal-footer'>
                    <a class='btn btn-default' data-dismiss='modal'>Cancel</a>
                    <input type='submit' class='btn btn-warning' name='Generate' value='Generate' />
                    </form>
                  </div>
                </div>
                 </div>
                  </div>

<!-- weekly -->
<div class="modal fade" id="weeklyreservation" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reservation Reports</h4>
        </div>
        <div class="modal-body">
        <div>
    <div class='table-responsive'>
    <table class="table">
       <form method="post" target="_blank" action="reservationweeklypdf.php">
             <input type="hidden" name="id"  value="<?php echo $name; ?>" >
          <h3>Select week of this month:</h3>
          <br>
          <select class="form-control" name = "week">
            <option value="first" selected>First Week</option>
            <option value="second">Second Week</option>
            <option value="third">Third Week</option>
            <option value="fourth">Fourth Week</option>
            </select>
          </br>

           <select class="form-control" name = "status" onchange = "filterFunction2();">
            <option value='All Reservation' SELECTED>All Reservation</option>
            <option value='Pending'>Pending</option>
            <option value='Reserved'>Reserved</option>
            <option value="Checked-in">Checked-in</option>
            <option value="Checked-out">Checked-out</option>
            <option value="No show">No show</option>

          </select>
    </table>
    </div>
    </div>
    </div>
        <div class='modal-footer'>
                    <a class='btn btn-default' data-dismiss='modal'>Cancel</a>
                    <input type='submit' class='btn btn-warning' name='Generate' value='Generate' />
                    </form>
                  </div>
                </div>
                 </div>
                  </div>


<!-- monthly -->
<div class="modal fade" id="monthlyreservation" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reservation Reports</h4>
        </div>
        <div class="modal-body">
        <div>
    <div class='table-responsive'>
    <table class="table">
       <form method="post" target="_blank" action="reservationmonthly.php">
           <input type="hidden" name="id"  value="<?php echo $name; ?>" >
          <h3>Select Month of this year:</h3>
          <br>

          <select class="form-control" name = "month">
        <option value='01'>January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
          </select>
          </br>


           <select class="form-control" name = "status" onchange = "filterFunction2();">
            <option value='All Reservation' SELECTED>All Reservation</option>
            <option value='Pending'>Pending</option>
            <option value='Reserved'>Reserved</option>
            <option value="Checked-in">Checked-in</option>
            <option value="Checked-out">Checked-out</option>
            <option value="No show">No show</option>

          </select>
    </table>
    </div>
    </div>
    </div>
        <div class='modal-footer'>
                    <a class='btn btn-default' data-dismiss='modal'>Cancel</a>
                    <input type='submit' class='btn btn-warning' name='Generate' value='Generate' />
                    </form>
                  </div>
                </div>
                 </div>
                  </div>



<!-- yearly -->
<div class="modal fade" id="yearlyreservation" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reservation Reports</h4>
        </div>
        <div class="modal-body">
        <div>
    <div class='table-responsive'>
    <table class="table">
       <form method="post" target="_blank" action="reservationyearly.php">
          <input type="hidden" name="id"  value="<?php echo $name; ?>" >

        <h3>Select year:</h3>
          <br>
          <select class="form-control" id="filter" name="year">
            <?php
              for ($year = date('Y') + 1; $year >= 2015; $year--) {
                echo "<option value='$year'>$year</option>";
              }
            ?>
          </select>
          <br>
           <select class="form-control" name = "status" onchange = "filterFunction2();">
            <option value='All Reservation' SELECTED>All Reservation</option>
            <option value='Pending'>Pending</option>
            <option value='Reserved'>Reserved</option>
            <option value="Checked-in">Checked-in</option>
            <option value="Checked-out">Checked-out</option>
            <option value="No show">No show</option>

          </select>
    </table>
    </div>
    </div>
    </div>
        <div class='modal-footer'>
                    <a class='btn btn-default' data-dismiss='modal'>Cancel</a>
                    <input type='submit' class='btn btn-warning' name='Generate' value='Generate' />
                    </form>
                  </div>
                </div>
                 </div>
                  </div>

<!-- monthly -->
<!-- <div class="modal fade" id="allreservation" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reservation Reports</h4>
        </div>
        <div class="modal-body">
        <div>
    <div class='table-responsive'>
    <table class="table">

       <form method="post" target="_blank" action="reservationyearly.php">

          <h3>Select day:</h3>
          <br>
          <select class="form-control" name = "day">
            <option value="Monday" selected>Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
            <option value="Sunday">Sunday</option>
            </select>
          </br>
           <h3>Select Month:</h3>
          <br>

          <select class="form-control" name = "month">
        <option value='01'>January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
          </select>
          </br>

        <h3>Select year:</h3>
          <br>
          <select class="form-control" id="filter" name="year">
            <?php
              // for ($year = date('Y'); $year >= 2015; $year--) {
              //   echo "<option value='$year'>$year</option>";
              //}
            ?>
          </select>
          <br>


           <select class="form-control" name = "status" onchange = "filterFunction2();">
            <option value='All Reservation' SELECTED>All Reservation</option>
            <option value='Pending'>Pending</option>
            <option value='Reserved'>Reserved</option>
            <option value="Checked-in">Checked-in</option>
            <option value="Checked-out">Checked-out</option>
            <option value="No show">No show</option>

          </select>
    </table>
    </div>
    </div>
    </div>
        <div class='modal-footer'>
                    <a class='btn btn-default' data-dismiss='modal'>Cancel</a>
                    <input type='submit' class='btn btn-warning' name='Generate' value='Generate' />
                    </form>
                  </div>
                </div>
                 </div>
                  </div>
 -->


 <div class="modal fade" id="reservation" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reservation Reports</h4>
        </div>
        <div class="modal-body">
        <div>
    <div class='table-responsive'>
    <table class="table">
       <form method="post" target="_blank" action="reservationpdf.php">

            <input class="form-control" type='text' name='type' value="All Transaction" required />

          </br>
           <select class="form-control" name = "status" onchange = "filterFunction2();">
            <option value='All Reservation' SELECTED>All Reservation</option>
            <option value='Pending'>Pending</option>
            <option value='Reserved'>Reserved</option>
            <option value="Checked-in">Checked-in</option>
            <option value="Checked-out">Checked-out</option>
            <option value="No show">No show</option>

          </select>
    </table>
    </div>
    </div>
    </div>
        <div class='modal-footer'>
                    <a class='btn btn-default' data-dismiss='modal'>Cancel</a>
                    <input type='submit' class='btn btn-warning' name='Generate' value='Generate' />
                    </form>
                  </div>
                </div>
                 </div>
                  </div>

<!-- daily billing -->
<div class="modal fade" id="dailybilling" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Billing Reports</h4>
        </div>
        <div class="modal-body">
        <div>
    <div class='table-responsive'>
    <table class="table">
       <form method="post" target="_blank" action="billingdailypdf.php">
           <input type="hidden" name="id"  value="<?php echo $name; ?>" >
          <h3>Select day of this week:</h3>
          <br>
          <select class="form-control" name = "day">
            <option value="Monday" selected>Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
            <option value="Sunday">Sunday</option>
            </select>
          </br>
           <select class="form-control" name="billingstatus" onchange = "filterFunction2();">
            <option value='All Billing Transactions' SELECTED>All Billing Transactions</option>
            <option value='Pending'>Pending</option>
            <option value='Fully Paid'>Fully Paid</option>
          </select>
    </table>
    </div>
    </div>
    </div>
        <div class='modal-footer'>
                    <a class='btn btn-default' data-dismiss='modal'>Cancel</a>
                    <input type='submit' class='btn btn-warning' name='Generate' value='Generate' />
                    </form>
                  </div>
                </div>
                 </div>
                  </div>

                  <!-- weekly billing -->
<div class="modal fade" id="weeklybilling" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reservation Reports</h4>
        </div>
        <div class="modal-body">
        <div>
    <div class='table-responsive'>
    <table class="table">
       <form method="post" target="_blank" action="billingweeklypdf.php">
             <input type="hidden" name="id"  value="<?php echo $name; ?>" >
          <h3>Select week of this month:</h3>
          <br>
          <select class="form-control" name = "week">
            <option value="first" selected>First Week</option>
            <option value="second">Second Week</option>
            <option value="third">Third Week</option>
            <option value="fourth">Fourth Week</option>
            </select>
          </br>
          <select class="form-control" name="billingstatus" onchange = "filterFunction2();">
            <option value='All Billing Transactions' SELECTED>All Billing Transactions</option>
            <option value='Pending'>Pending</option>
            <option value='Fully Paid'>Fully Paid</option>
          </select>
    </table>
    </div>
    </div>
    </div>
        <div class='modal-footer'>
                    <a class='btn btn-default' data-dismiss='modal'>Cancel</a>
                    <input type='submit' class='btn btn-warning' name='Generate' value='Generate' />
                    </form>
                  </div>
                </div>
                 </div>
                  </div>

<!-- monthly billing-->
<div class="modal fade" id="monthlybilling" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reservation Reports</h4>
        </div>
        <div class="modal-body">
        <div>
    <div class='table-responsive'>
    <table class="table">
       <form method="post" target="_blank" action="billingmonthly.php">
           <input type="hidden" name="id"  value="<?php echo $name; ?>" >
          <h3>Select Month of this year:</h3>
          <br>

          <select class="form-control" name = "month">
        <option value='01'>January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
          </select>
          </br>

             <select class="form-control" name = "billingstatus" onchange = "filterFunction2();">
            <option value='All Billing Transactions' SELECTED>All Billing Transactions</option>
            <option value='Pending'>Pending</option>
            <option value='Fully Paid'>Fully Paid</option>
          </select>
    </table>
    </div>
    </div>
    </div>
        <div class='modal-footer'>
                    <a class='btn btn-default' data-dismiss='modal'>Cancel</a>
                    <input type='submit' class='btn btn-warning' name='Generate' value='Generate' />
                    </form>
                  </div>
                </div>
                 </div>
                  </div>

<!-- yearly billing -->
<div class="modal fade" id="yearlybilling" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reservation Reports</h4>
        </div>
        <div class="modal-body">
        <div>
    <div class='table-responsive'>
    <table class="table">
       <form method="post" target="_blank" action="billingyearly.php">
          <input type="hidden" name="id"  value="<?php echo $name; ?>" >

        <h3>Select year:</h3>
          <br>
          <select class="form-control" id="filter" name="year">
            <?php


              for ($year = date('Y') + 1; $year >= 2015; $year--) {
                echo "<option value='$year'>$year</option>";
              }
            ?>
          </select>
          <br>
           <select class="form-control" name = "billingstatus" onchange = "filterFunction2();">
            <option value='All Billing Transactions' SELECTED>All Billing Transactions</option>
            <option value='Pending'>Pending</option>
            <option value='Fully Paid'>Fully Paid</option>
          </select>
    </table>
    </div>
    </div>
    </div>
        <div class='modal-footer'>
                    <a class='btn btn-default' data-dismiss='modal'>Cancel</a>
                    <input type='submit' class='btn btn-warning' name='Generate' value='Generate' />
                    </form>
                  </div>
                </div>
                 </div>
                  </div>



  <!--Reservations report-->
  <div class="modal fade" id="billing" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Billing Reports</h4>
        </div>
        <div class="modal-body">
        <div>
    <div class='table-responsive'>
    <table class="table">
       <form method="post" target="_blank" action="billingtransactionpdf.php">
          <select class="form-control" name = "type" onchange = "filterFunction2();">
            <option value='All' SELECTED>All Transactions</option>
            <option value='Daily'>Daily</option>
            <option value='Weekly'>Weekly</option>
            <option value='Monthly'>Monthly</option>
            <option value="Yearly">Yearly</option>
          </select>
          </br>
            <select class="form-control" name = "billingstatus" onchange = "filterFunction2();">
            <option value='All Billing Transactions' SELECTED>All Billing Transactions</option>
            <option value='Pending'>Pending</option>
            <option value='Fully Paid'>Fully Paid</option>
          </select>
    </table>
    </div>
    </div>
    </div>
        <div class='modal-footer'>
                    <a class='btn btn-default' data-dismiss='modal'>Cancel</a>
                    <input type='submit' class='btn btn-warning' name='Generate' value='Generate' />
                    </form>
                  </div>
                </div>
  </div>
                 </div>
                  </div>
      </body>

    </section>
  </div>
</div>
</body>
</html>
