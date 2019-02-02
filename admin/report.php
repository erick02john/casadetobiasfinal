<?php
session_start();
if(!isset($_SESSION["user"]))
{
 header("location:index.php");
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrator</title>
      <?php
    include ('tmpheader.php');
    ?>
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

</head>

<body>
    <div id="wrapper">

        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php"><?php echo $_SESSION["fname"].' '.$_SESSION["lname"]; ?></a>
            </div>
        </nav>
        <!--/. NAV TOP  -->
        <?php
       include ('sidebar.php');
       ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
             <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                         Generate Reports<small> </small>
                        </h1>
                    </div>
                </div>



    <!-- Generate Reports  -->  <!-- Generate Reports  -->


 <div class="tableposition">
        <div class="well" style="margin-top:10px">
    <!-- <h1>Generate Reports</h1>
    <hr class="style-four"> -->

    <div class="row">
    <div class="col-md-8 col-lg-offset-3 text-center" style="margin-left: 198px">

      <h2>Reservations</h2><br><br>


    <!-- <a href="#all" data-toggle="modal" class="btn btn-lg btn-primary" >&nbsp;&nbsp;&nbsp;&nbsp;All&nbsp;&nbsp;&nbsp;&nbsp;</a> -->
     <a href="#dailyreservation" data-toggle="modal" class="btn btn-lg btn-primary" >Daily</a>
     <a href="#weeklyreservation" data-toggle="modal" class="btn btn-lg btn-primary" >Weekly</a>
     <a href="#monthlyreservation" data-toggle="modal" class="btn btn-lg btn-primary" >Monthly</a>
     <a href="#yearlyreservation" data-toggle="modal" class="btn btn-lg btn-primary" >Yearly</a>
     <!--<a href="#reservation" data-toggle="modal" class="btn btn-lg btn-primary" >overall</a>-->
           <hr style="padding: 1px;">
     <!-- <a href="#allreservation" data-toggle="modal" class="btn btn-lg btn-primary" >all</a> -->

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
            <option value='0'>Pending</option>
            <option value='3'>Reserved</option>
            <option value="1">Checked-in</option>
            <option value="2">Checked-out</option>

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
            <option value='0'>Pending</option>
            <option value='3'>Reserved</option>
            <option value="1">Checked-in</option>
            <option value="2">Checked-out</option>

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




             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>


</body>
</html>
