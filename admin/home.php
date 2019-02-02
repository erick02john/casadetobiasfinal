<?php
include ('../include.php');
session_start();
if(!isset($_SESSION["user"]))
{
 header("location:index.php");
}


$sql123 = "SELECT id,DATE_ADD(datestamp, INTERVAL 7 DAY) as expire FROM roomreserve WHERE CURDATE() >= DATE_ADD(datestamp, INTERVAL 7 DAY)";
$result123 = $con->query($sql123);
$ctr = 1;
while($row123=$result123->fetch_assoc()){
    $expired = $row123['expire'];
    $id = $row123['id'];

        dodeleteexpired($id);

}



if(empty($_GET['dodelete'])){

} else {
    dodeletereserve($_GET['dodelete']);
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
        <!-- Lightbox style -->
      <link rel="stylesheet" href="<?=base_url()?>Library/lightbox/css/lightbox.css">

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
        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Status <small>Room Booking </small>
                        </h1>
                    </div>
                </div>
                <!-- /. ROW  -->
                <?php
                        $sql = "SELECT count(*) as cnt FROM roomreserve,room WHERE roomreserve.roomid = room.roomid AND stat = 0 OR stat = 3 GROUP BY ID";
                        $query = mysqli_query($connection,$sql) or die ("Database Connection Failed");
                        $result = mysqli_fetch_assoc($query);
                ?>


                    <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">

                        </div>
                        <div class="panel-body">
                            <div class="panel-group" id="accordion">

                            <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                            <button class="btn btn-default" type="button">
                                                 New Room Bookings  <span class="badge"><?=$result['cnt']?></span>
                                            </button>
                                            </a>
                                        </h4>

                                    </div>

                                    <div id="collapseTwo" class="panel-collapse in" style="height: auto;">
                                        <div class="panel-body">
                                           <div class="panel panel-default">

                        <div class="panel-body">
                            <div class="table-responsive">
                                <div class="input-group input-group-sm pull-right" style="width: 30%;">
                                <input type="text" class="form-control" id="srchname1">
                                    <span class="input-group-btn">
                                      <button type="button" class="btn btn-info btn-flat" id="srchname"><i class="fa fa-fw fa-search"></i></button>
                                    </span>
                                    <span class="input-group-btn">
                                      <a href="<?=base_url()?>admin/home.php" class="btn btn-info btn-flat"><i class="fa fa-fw fa-refresh"></i></a>
                                    </span>
                              </div><br /><br /><br />
                                <table class="table" id="tblreserve" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>img</th>
                                            <th>Room Type</th>
                                            <th>Rooms</th>
                                            <th>Guest</th>
                                            <th>Payment Type</th>
                                            <th>Check In</th>
                                            <th>Check Out</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $sql1 = "SELECT * FROM roomreserve,room WHERE roomreserve.roomid = room.roomid AND stat = 0 OR stat = 3 GROUP BY ID";
                                     $result1 = $con->query($sql1);
                                    while($row1=$result1->fetch_assoc()){
                                    $stat = $row1['Stat'];

                                    if($stat == 0){
                                        $lblstat = 'Pending';
                                    } elseif($stat == 1){
                                        $lblstat = 'Check-In';
                                    } elseif($stat == 2){
                                        $lblstat = 'Check-Out';
                                    } elseif($stat == 3){
                                        $lblstat = 'Reserved';
                                    }else {
                                        $lblstat = 'Unknown Error';
                                    }
                                    $addguestamnt = 800;
                                    echo "<tr>
                                    <td>".$row1['ID']."</td>
                                    <td>".$row1['FName']." ".$row1['LName']."</td>
                                    <td>".$row1['Email']."</td>
                                    <td>".((!empty($row1['depositimg'])) ? "<a href='".base_url()."depositupload/uploads/".$row1['depositimg']."' data-lightbox='example-1'><img src='".base_url()."depositupload/uploads/".$row1['depositimg']."' width='30px'></a>":"")."</td>
                                    <td align='center'><b>".$row1['roomtype']."</b></td>
                                    <td align='center'>".$row1['NRoom']."</td>
                                    <td align='center'>".($row1['NGuest'] + $row1['AGuest'])."</td>
                                    <td><b><center>".(($row1['paymenttype'] == 'full') ? "Full Payment":"Down Payment")."</center></b></td>
                                    <td>".formatdate1($row1['Cin'])."</td>
                                    <td>".formatdate1($row1['Cout'])."</td>
                                    <td><b>".$lblstat."</b></td>
                                    <td>
                                    <a data-toggle='modal' data-target='#payment".$row1['ID']."'><i class='fa fa-fw fa-money'></i></a>
                                    <a href='".base_url()."admin/print/printu.php?id=".$row1['ID']."' target='blank'><i class='fa fa-fw fa-print'></i></a>
                                    <a href='".base_url()."admin/reservation/updatereservation.php?doupdatereserve=".$row1['ID']."'><i class='fa fa-pencil-square-o'></i></a>
                                    <a href='".base_url()."admin/home.php?dodelete=".$row1['ID']."'><i class='fa fa-times'></i></a>
                                     </td>
                                    ";

                                    $sql333 = "SELECT * FROM roomreserve,discounts WHERE id = '".$row1['ID']."' AND roomreserve.did = discounts.did GROUP BY id";
                                    $query333 = mysqli_query($connection,$sql333) or die ("Database Connection Failed");
                                    $result333 = mysqli_fetch_assoc($query333);

                                    $discount = $result333['discountpercent'] * ($row1['NRoom'] * $row1['roomprice']);

                                    $roomamount = $row1['NRoom'] * $row1['roomprice'] * $row1['NoOfDays'];
                                    $guestamount = $addguestamnt * $row1['AGuest'] * $row1['NoOfDays'];

                                    $totalpayment = $roomamount + $guestamount - $discount;

                                    $totalpaymentvat = $totalpayment * 0.12 + $totalpayment;



                                    $sql3 = "SELECT sum(amount) as subtotal FROM payment WHERE reserveid = '".$row1['ID']."'";
                                    $query3 = mysqli_query($connection,$sql3) or die ("Database Connection Failed");
                                    $result3 = mysqli_fetch_assoc($query3);


                                        if(!empty($result3['subtotal'])){
                                            $balance = ($totalpaymentvat - $result3['subtotal']);
                                            $paidamount = $result3['subtotal'];
                                        } elseif(empty($result3['subtotal'])) {
                                            $balance = $totalpaymentvat;
                                            $paidamount = 0;
                                        }

                                        ?>


                                    <td>
                                    <!-- PAYMENT HERE -->
                                    <div class="modal fade" id="payment<?=$row1['ID']?>" >
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title"><?=$row1['FName'].' '.$row1['LName']?></h4>

                                          </div>
                                          <form method="POST">
                                          <div class="modal-body">
                                            <div class="row">
                                                  <div class="col-md-12">
                                                    <h4>Billing</h4>
                                                    <table class="table table-bordered" style="font-size: 13px;">
                                                    <thead>
                                                    <tr>
                                                    <td>Billing ID</td>
                                                    <td><?=$row1['ID']?>
                                                    <input type="hidden" name="reserveid" value="<?=$row1['ID']?>">
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                    <td>Name</td>
                                                    <td><?=$row1['FName'].' '.$row1['LName']?></td>
                                                    </tr>
                                                    <tr>
                                                    <td>Total Amount</td>
                                                    <td><?=(($result333['did'] == 1) ? "(".formatnumber2($totalpaymentvat).") Discounted":"".formatnumber2($totalpaymentvat)."");?></td>
                                                    </tr>
                                                    <tr>
                                                    <td>Paid Amount</td>
                                                    <td><?=formatnumber2($paidamount);?></td>
                                                    </tr>
                                                    <tr>
                                                    <td>Balance</td>
                                                    <td><?=formatnumber2($balance);?></td>
                                                    </tr>
                                                    <tr>
                                                    <td>Payment Type</td>
                                                    <td><?=(($row1['paymenttype'] == 'full') ? "Full Payment":"Down Payment")?></td>
                                                    </tr>
                                                    <tr>
                                                    <td>Amount</td>
                                                    <td>
                                                    <?php
                                                    if($row1['paymenttype'] == 'full'){
                                                        echo '
                                                        <input type="hidden" name="amount" value="'.($balance).'">
                                                        <button type="submit" name="billing" class="btn btn-info pull-left">'.formatnumber2($balance).'</button>';
                                                    } else {
                                                        if(empty($result3['subtotal'])){
                                                        echo '
                                                            <input type="hidden" name="amount" value="'.($balance / 2).'">
                                                            <button type="submit" name="billing" class="btn btn-info pull-left">'.formatnumber2($balance / 2).'</button>';
                                                        } else {
                                                        echo '
                                                            <input type="hidden" name="amount" value="'.($balance).'">
                                                            <button type="submit" name="billing" class="btn btn-info pull-left">'.formatnumber2($balance).'</button>';
                                                        }
                                                    }
                                                    ?>
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                    <td>Discount</td>
                                                    <td>

                                                        <table>
                                                        <tr>
                                                        <td><button type="submit" name="senior" class="btn btn-primary pull-left">0.20</button></td>
                                                        <td>&nbsp;</td>
                                                        </tr>
                                                        </table>
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                    <td>Status</td>
                                                    <td>
                                                        <table>
                                                            <?php
                                                            if($stat == 0){
                                                                ?>
                                                                <tr>
                                                                <td><button type="submit" name="reserve" class="btn btn-primary pull-left">Reserved</button></td>
                                                                <td>&nbsp;</td>
                                                                <td><button type="submit" name="checkin" class="btn btn-success pull-left">Check In</button></td>
                                                                </tr>
                                                                <?php
                                                            } elseif($stat == 3){
                                                                ?>
                                                                <tr>
                                                                <td><button type="submit" name="checkin" class="btn btn-success pull-left">Check In</button></td>
                                                                </tr>
                                                                <?php
                                                            } elseif($stat == 1 ){
                                                                ?>
                                                                <td><button type="submit" name="checkout" class="btn btn-danger pull-left">Check Out</button></td>
                                                                <?php
                                                            }
                                                            ?>
                                                        </table>
                                                    </td>
                                                    </tr>
                                                    </thead>
                                                    </table>
                                                </div>

                                                </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                      </div>
                                      </form>
                                    </div>
                                    </td>
                                    </tr>
                                    <!-- END OF PAYMENT HERE -->

                                    <?php
                                    }
                                    ?>

                                    </tbody>
                                </table>




                            </div>
                        </div>
                    </div>

                    <!-- newpanel -->


                        <!-- end of new panel -->


                      <!-- End  Basic Table  -->
                                        </div>
                                    </div>
                                </div>
                                <?php

                                    $sqlcheckin = "SELECT count(*) as cnt FROM roomreserve,room WHERE roomreserve.roomid = room.roomid AND stat = 1";
                                    $querycheckin = mysqli_query($connection,$sqlcheckin) or die ("Database Connection Failed");
                                    $resultcheckin = mysqli_fetch_assoc($querycheckin);

                                ?>
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed">
                                            <button class="btn btn-primary" type="button">
                                                 Check-In  <span class="badge"><?=$resultcheckin['cnt']?></span>
                                            </button>

                                            </a>
                                        </h4>


                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse" style="height: 0px;">
                                        <div class="panel-body">

                                        <div class="panel-body">
                            <div class="table-responsive">
                                <div class="input-group input-group-sm pull-right" style="width: 30%;">
                                <input type="text" class="form-control" id="srchchkin1">
                                    <span class="input-group-btn">
                                      <button type="button" class="btn btn-info btn-flat" id="srchchkin"><i class="fa fa-fw fa-search"></i></button>
                                    </span>
                                    <span class="input-group-btn">
                                      <a href="<?=base_url()?>admin/home.php" class="btn btn-info btn-flat"><i class="fa fa-fw fa-refresh"></i></a>
                                    </span>
                              </div><br /><br /><br />
                                <table class="table" id="tblcheckin" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>img</th>
                                            <th>Room Type</th>
                                            <th>Rooms</th>
                                            <th>Guest</th>
                                            <th>Payment Type</th>
                                            <th>Check In</th>
                                            <th>Check Out</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $sql1 = "SELECT * FROM roomreserve,room WHERE roomreserve.roomid = room.roomid AND stat = 1";
                                     $result1 = $con->query($sql1);
                                    while($row1=$result1->fetch_assoc()){
                                    $stat = $row1['Stat'];

                                    if($stat == 0){
                                        $lblstat = 'Pending';
                                    } elseif($stat == 1){
                                        $lblstat = 'Check-In';
                                    } elseif($stat == 2){
                                        $lblstat = 'Check-Out';
                                    } elseif($stat == 3){
                                        $lblstat = 'Reserved';
                                    }else {
                                        $lblstat = 'Unknown Error';
                                    }
                                    $addguestamnt = 800;
                                    echo "<tr>
                                    <td>".$row1['ID']."</td>
                                    <td>".$row1['FName']." ".$row1['LName']."</td>
                                    <td>".$row1['Email']."</td>
                                    <td>".((!empty($row1['depositimg'])) ? "<a href='".base_url()."depositupload/uploads/".$row1['depositimg']."' data-lightbox='example-1'><img src='".base_url()."depositupload/uploads/".$row1['depositimg']."' width='30px'></a>":"")."</td>
                                    <td align='center'><b>".$row1['roomtype']."</b></td>
                                    <td align='center'>".$row1['NRoom']."</td>
                                    <td align='center'>".($row1['NGuest'] + $row1['AGuest'])."</td>
                                    <td><b><center>".(($row1['paymenttype'] == 'full') ? "Full Payment":"Down Payment")."</center></b></td>
                                    <td>".formatdate1($row1['Cin'])."</td>
                                    <td>".formatdate1($row1['Cout'])."</td>
                                    <td><b>".$lblstat."</b></td>
                                    <td>
                                    <a data-toggle='modal' data-target='#payment".$row1['ID']."'><i class='fa fa-fw fa-money'></i></a>
                                    <a href='".base_url()."admin/print/printu.php?id=".$row1['ID']."' target='blank'><i class='fa fa-fw fa-print'></i></a>
                                    <a href='".base_url()."admin/reservation/updatereservation.php?doupdatereserve=".$row1['ID']."'><i class='fa fa-pencil-square-o'></i></a>
                                    <a href='".base_url()."admin/home.php?dodelete=".$row1['ID']."'><i class='fa fa-times'></i></a>
                                     </td>
                                    ";

                                    $roomamount = $row1['NRoom'] * $row1['roomprice'] * $row1['NoOfDays'];
                                    $guestamount = $addguestamnt * $row1['AGuest'] * $row1['NoOfDays'];

                                    $totalpayment = $roomamount + $guestamount;

                                    $totalpaymentvat = $totalpayment * 0.12 + $totalpayment;


                                    $sql3 = "SELECT sum(amount) as subtotal FROM payment WHERE reserveid = '".$row1['ID']."'";
                                    $query3 = mysqli_query($connection,$sql3) or die ("Database Connection Failed");
                                    $result3 = mysqli_fetch_assoc($query3);



                                        if(!empty($result3['subtotal'])){
                                            $balance = ($totalpaymentvat - $result3['subtotal']);
                                            $paidamount = $result3['subtotal'];
                                        } elseif(empty($result3['subtotal'])) {
                                            $balance = $totalpaymentvat;
                                            $paidamount = 0;
                                        }

                                        ?>


                                    <td>
                                    <!-- PAYMENT HERE -->
                                    <div class="modal fade" id="payment<?=$row1['ID']?>" >
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title"><?=$row1['FName'].' '.$row1['LName']?></h4>

                                          </div>
                                          <form method="POST">
                                          <div class="modal-body">
                                            <div class="row">
                                                  <div class="col-md-12">
                                                    <h4>Billing</h4>
                                                    <table class="table table-bordered" style="font-size: 13px;">
                                                    <thead>
                                                    <tr>
                                                    <td>Billing ID</td>
                                                    <td><?=$row1['ID']?></td>
                                                    </tr>
                                                    <tr>
                                                    <td>Name</td>
                                                    <td><?=$row1['FName'].' '.$row1['LName']?></td>
                                                    </tr>
                                                    <tr>
                                                    <td>Total Amount</td>
                                                    <td><?=formatnumber2($totalpaymentvat);?></td>
                                                    </tr>
                                                    <tr>
                                                    <td>Paid Amount</td>
                                                    <td><?=formatnumber2($paidamount);?></td>
                                                    </tr>
                                                    <tr>
                                                    <td>Balance</td>
                                                    <td><?=formatnumber2($balance);?></td>
                                                    </tr>
                                                    <tr>
                                                    <td>Payment Type</td>
                                                    <td><?=(($row1['paymenttype'] == 'full') ? "Full Payment":"Down Payment")?></td>
                                                    </tr>
                                                    <tr>
                                                    <td>Amount</td>
                                                    <td>
                                                    <?php
                                                    if($row1['paymenttype'] == 'full'){
                                                        echo '
                                                        <input type="hidden" name="reserveid" value="'.$row1['ID'].'">
                                                        <input type="hidden" name="amount" value="'.($balance).'">
                                                        <button type="submit" name="billing" class="btn btn-info pull-left">'.formatnumber2($balance).'</button>';
                                                    } else {
                                                        if(empty($result3['subtotal'])){
                                                        echo '<input type="hidden" name="reserveid" value="'.$row1['ID'].'">
                                                            <input type="hidden" name="amount" value="'.($balance / 2).'">
                                                            <button type="submit" name="billing" class="btn btn-info pull-left">'.formatnumber2($balance / 2).'</button>';
                                                        } else {
                                                        echo '
                                                            <input type="hidden" name="reserveid" value="'.$row1['ID'].'">
                                                            <input type="hidden" name="amount" value="'.($balance).'">
                                                            <button type="submit" name="billing" class="btn btn-info pull-left">'.formatnumber2($balance).'</button>';
                                                        }


                                                    }
                                                    ?>
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                    <td>Status</td>
                                                    <td>
                                                        <table>
                                                            <?php
                                                            if($stat == 0){
                                                                ?>
                                                                <tr>
                                                                <td><button type="submit" name="reserve" class="btn btn-primary pull-left">Reserved</button></td>
                                                                <td>&nbsp;</td>
                                                                <td><button type="submit" name="checkin" class="btn btn-success pull-left">Check In</button></td>
                                                                </tr>
                                                                <?php
                                                            } elseif($stat == 3){
                                                                ?>
                                                                <tr>
                                                                <td><button type="submit" name="checkin" class="btn btn-success pull-left">Check In</button></td>
                                                                </tr>
                                                                <?php
                                                            } elseif($stat == 1 ){
                                                                ?>
                                                                <td><button type="submit" name="checkout" class="btn btn-danger pull-left">Check Out</button></td>
                                                                <?php
                                                            }
                                                            ?>
                                                        </table>
                                                    </td>
                                                    </tr>
                                                    </thead>
                                                    </table>
                                                </div>

                                                </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                      </div>
                                      </form>
                                    </div>
                                    </td>
                                    </tr>
                                    <!-- END OF PAYMENT HERE -->

                                    <?php
                                    }
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>




                                        </div>



                                    </div>

                                </div>
                                <?php

                                    $sqlcheckout = "SELECT count(*) as cnt FROM roomreserve,room WHERE roomreserve.roomid = room.roomid AND stat = 2";
                                    $querycheckout = mysqli_query($connection,$sqlcheckout) or die ("Database Connection Failed");
                                    $resultcheckout = mysqli_fetch_assoc($querycheckout);

                                ?>


                                <div class="panel panel-danger">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">
                                            <button class="btn btn-primary" type="button">
                                                 Check-Out <span class="badge"><?=$resultcheckout['cnt']?></span>
                                            </button>
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="panel-body">
                            <div class="table-responsive">
                                <div class="input-group input-group-sm pull-right" style="width: 30%;">
                                <input type="text" class="form-control" id="srchcheckout">
                                    <span class="input-group-btn">
                                      <button type="button" class="btn btn-info btn-flat" id="srchcheckout1"><i class="fa fa-fw fa-search"></i></button>
                                    </span>
                                    <span class="input-group-btn">
                                      <a href="<?=base_url()?>admin/home.php" class="btn btn-info btn-flat"><i class="fa fa-fw fa-refresh"></i></a>
                                    </span>
                              </div><br /><br /><br />
                                <table class="table" id="tblcheckout" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>img</th>
                                            <th>Room Type</th>
                                            <th>Rooms</th>
                                            <th>Guest</th>
                                            <th>Payment Type</th>
                                            <th>Check In</th>
                                            <th>Check Out</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $sql1 = "SELECT * FROM roomreserve,room WHERE roomreserve.roomid = room.roomid AND stat = 2";
                                     $result1 = $con->query($sql1);
                                    while($row1=$result1->fetch_assoc()){
                                    $stat = $row1['Stat'];

                                    if($stat == 0){
                                        $lblstat = 'Pending';
                                    } elseif($stat == 1){
                                        $lblstat = 'Check-In';
                                    } elseif($stat == 2){
                                        $lblstat = 'Check-Out';
                                    } elseif($stat == 3){
                                        $lblstat = 'Reserved';
                                    }else {
                                        $lblstat = 'Unknown Error';
                                    }
                                    $addguestamnt = 800;
                                    echo "<tr>
                                    <td>".$row1['ID']."</td>
                                    <td>".$row1['FName']." ".$row1['LName']."</td>
                                    <td>".$row1['Email']."</td>
                                    <td>".((!empty($row1['depositimg'])) ? "<a href='".base_url()."depositupload/uploads/".$row1['depositimg']."' data-lightbox='example-1'><img src='".base_url()."depositupload/uploads/".$row1['depositimg']."' width='30px'></a>":"")."</td>
                                    <td align='center'><b>".$row1['roomtype']."</b></td>
                                    <td align='center'>".$row1['NRoom']."</td>
                                    <td align='center'>".($row1['NGuest'] + $row1['AGuest'])."</td>
                                    <td><b><center>".(($row1['paymenttype'] == 'full') ? "Full Payment":"Down Payment")."</center></b></td>
                                    <td>".formatdate1($row1['Cin'])."</td>
                                    <td>".formatdate1($row1['Cout'])."</td>
                                    <td><b>".$lblstat."</b></td>
                                    <td>
                                    <a data-toggle='modal' data-target='#payment".$row1['ID']."'><i class='fa fa-fw fa-money'></i></a>
                                    <a href='".base_url()."admin/print/printu.php?id=".$row1['ID']."' target='blank'><i class='fa fa-fw fa-print'></i></a>
                                    <a href='".base_url()."admin/reservation/updatereservation.php?doupdatereserve=".$row1['ID']."'><i class='fa fa-pencil-square-o'></i></a>
                                    <a href='".base_url()."admin/home.php?dodelete=".$row1['ID']."'><i class='fa fa-times'></i></a>
                                     </td>
                                    ";

                                    $roomamount = $row1['NRoom'] * $row1['roomprice'] * $row1['NoOfDays'];
                                    $guestamount = $addguestamnt * $row1['AGuest'] * $row1['NoOfDays'];

                                    $totalpayment = $roomamount + $guestamount;

                                    $totalpaymentvat = $totalpayment * 0.12 + $totalpayment;


                                    $sql3 = "SELECT sum(amount) as subtotal FROM payment WHERE reserveid = '".$row1['ID']."'";
                                    $query3 = mysqli_query($connection,$sql3) or die ("Database Connection Failed");
                                    $result3 = mysqli_fetch_assoc($query3);



                                        if(!empty($result3['subtotal'])){
                                            $balance = ($totalpaymentvat - $result3['subtotal']);
                                            $paidamount = $result3['subtotal'];
                                        } elseif(empty($result3['subtotal'])) {
                                            $balance = $totalpaymentvat;
                                            $paidamount = 0;
                                        }

                                        ?>


                                    <td>
                                    <!-- PAYMENT HERE -->
                                    <div class="modal fade" id="payment<?=$row1['ID']?>" >
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title"><?=$row1['FName'].' '.$row1['LName']?></h4>

                                          </div>
                                          <form method="POST">
                                          <div class="modal-body">
                                            <div class="row">
                                                  <div class="col-md-12">
                                                    <h4>Billing</h4>
                                                    <table class="table table-bordered" style="font-size: 13px;">
                                                    <thead>
                                                    <tr>
                                                    <td>Billing ID</td>
                                                    <td><?=$row1['ID']?></td>
                                                    </tr>
                                                    <tr>
                                                    <td>Name</td>
                                                    <td><?=$row1['FName'].' '.$row1['LName']?></td>
                                                    </tr>
                                                    <tr>
                                                    <td>Total Amount</td>
                                                    <td><?=formatnumber2($totalpaymentvat);?></td>
                                                    </tr>
                                                    <tr>
                                                    <td>Paid Amount</td>
                                                    <td><?=formatnumber2($paidamount);?></td>
                                                    </tr>
                                                    <tr>
                                                    <td>Balance</td>
                                                    <td><?=formatnumber2($balance);?></td>
                                                    </tr>
                                                    <tr>
                                                    <td>Payment Type</td>
                                                    <td><?=(($row1['paymenttype'] == 'full') ? "Full Payment":"Down Payment")?></td>
                                                    </tr>
                                                    <tr>
                                                    <td>Amount</td>
                                                    <td>
                                                    <?php
                                                    if($row1['paymenttype'] == 'full'){
                                                        echo '
                                                        <input type="hidden" name="reserveid" value="'.$row1['ID'].'">
                                                        <input type="hidden" name="amount" value="'.($balance).'">
                                                        <button type="submit" name="billing" class="btn btn-info pull-left">'.formatnumber2($balance).'</button>';
                                                    } else {
                                                        if(empty($result3['subtotal'])){
                                                        echo '<input type="hidden" name="reserveid" value="'.$row1['ID'].'">
                                                            <input type="hidden" name="amount" value="'.($balance / 2).'">
                                                            <button type="submit" name="billing" class="btn btn-info pull-left">'.formatnumber2($balance / 2).'</button>';
                                                        } else {
                                                        echo '
                                                            <input type="hidden" name="reserveid" value="'.$row1['ID'].'">
                                                            <input type="hidden" name="amount" value="'.($balance).'">
                                                            <button type="submit" name="billing" class="btn btn-info pull-left">'.formatnumber2($balance).'</button>';
                                                        }


                                                    }
                                                    ?>
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                    <td>Status</td>
                                                    <td>
                                                        <table>
                                                            <?php
                                                            if($stat == 0){
                                                                ?>
                                                                <tr>
                                                                <td><button type="submit" name="reserve" class="btn btn-primary pull-left">Reserved</button></td>
                                                                <td>&nbsp;</td>
                                                                <td><button type="submit" name="checkin" class="btn btn-success pull-left">Check In</button></td>
                                                                </tr>
                                                                <?php
                                                            } elseif($stat == 3){
                                                                ?>
                                                                <tr>
                                                                <td><button type="submit" name="checkin" class="btn btn-success pull-left">Check In</button></td>
                                                                </tr>
                                                                <?php
                                                            } elseif($stat == 1 ){
                                                                ?>
                                                                <td><button type="submit" name="checkout" class="btn btn-danger pull-left">Check Out</button></td>
                                                                <?php
                                                            }
                                                            ?>
                                                        </table>
                                                    </td>
                                                    </tr>
                                                    </thead>
                                                    </table>
                                                </div>

                                                </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                      </div>
                                      </form>
                                    </div>
                                    </td>
                                    </tr>
                                    <!-- END OF PAYMENT HERE -->

                                    <?php
                                    }
                                    ?>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>





                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>






                <!-- /. ROW  -->

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <?php
    include ('tmpfooter.php');
    ?>
         <!-- Lightbox style -->
      <script src="<?=base_url()?>Library/lightbox/js/lightbox-2.6.min.js"></script>
      <!-- Lightbox style -->
      <script src="<?=base_url()?>Library/lightbox/js/modernizr.custom.js"></script>

    <script type="text/javascript">
        //Initialize Select2 Elements
        $(".select2").select2({

        });
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass   : 'iradio_minimal-blue'
        });
    </script>

</body>

</html>
<script type="text/javascript">
    $('#srchname').click(function(e) {
            var srch1 = document.getElementById("srchname1").value

            if (srch1.length > 0 || srch1.length == 0) {
                 $.ajax({
                        type:'POST',
                        url:'<?php echo base_url(); ?>admin/search/searchreservepending.php',
                        data: {srch1: srch1},
                        success:function(data){
                            $('#tblreserve tbody').html(data);
                        }
                    });

            }
        });
</script>

<script type="text/javascript">
    $('#srchchkin').click(function(e) {
            var srch1 = document.getElementById("srchchkin1").value

            if (srch1.length > 0 || srch1.length == 0) {
                 $.ajax({
                        type:'POST',
                        url:'<?php echo base_url(); ?>admin/search/searchcheckin.php',
                        data: {srch1: srch1},
                        success:function(data){
                            $('#tblcheckin tbody').html(data);
                        }
                    });

            }
        });
</script>

<script type="text/javascript">
    $('#srchchkout').click(function(e) {
            var srch1 = document.getElementById("srchchkout1").value

            if (srch1.length > 0 || srch1.length == 0) {
                 $.ajax({
                        type:'POST',
                        url:'<?php echo base_url(); ?>admin/search/searchcheckout.php',
                        data: {srch1: srch1},
                        success:function(data){
                            $('#tblcheckout tbody').html(data);
                        }
                    });

            }
        });
</script>



<?php
    if($_POST) {
        $reserveid = $_POST['reserveid'];



            $sqlbridge = "SELECT * FROM roomreserve WHERE id = '".$reserveid."'";
            $querybridge = mysqli_query($connection,$sqlbridge) or die ("Database Connection Failed");
            $resultbridge = mysqli_fetch_assoc($querybridge);


                if($resultbridge['did'] > 0){
                   if(isset($_POST['senior'])){
                        $data = array(
                                'did' => 0
                            );
                        doupdatebridge($reserveid,$data);
                    }
                } else {
                    if(isset($_POST['senior'])){
                        $data = array(
                                'did' => 1
                            );
                        doupdatebridge($reserveid,$data);
                    }
                }



            if(isset($_POST['billing'])){
                if($_POST['amount'] > 0){

                    $data = array(
                        'reserveid' => $_POST['reserveid'],
                        'amount' => $_POST['amount'],
                        'datetime' => currentdatetime()
                    );

                    $data1 = array(
                        'stat' => 3
                    );
                    doupdatereserve($reserveid,$data1);
                    doinsertpayment($data);
                } else {

                    ?>
                      <script type="text/javascript">
                                swal({
                                  title: "Invalid Input",
                                  text: "",
                                  type: "error",
                                  showConfirmButton: true
                                }, function(){
                                       //window.location.href = "//stackoverflow.com";
                                });
                        </script>
                    <?php
                }
            }


            if(isset($_POST['pending'])){
                $data1 = array(
                    'stat' => 0
                );
                doupdatereserve($reserveid,$data1);
            } elseif(isset($_POST['reserve'])){
                $sqlval = "SELECT sum(amount) as subtotal FROM payment WHERE reserveid = '".$reserveid."'";
                $queryval = mysqli_query($connection,$sqlval) or die ("Database Connection Failed");
                $resultval = mysqli_fetch_assoc($queryval);

                if(!empty($resultval['subtotal'])){
                    $data1 = array(
                    'stat' => 3
                    );
                    doupdatereserve($reserveid,$data1);
                } else {
                    ?>
                      <script type="text/javascript">
                                swal({
                                  title: "There's no Payment Transactions",
                                  text: "",
                                  type: "error",
                                  showConfirmButton: true
                                }, function(){
                                       //window.location.href = "//stackoverflow.com";
                                });
                        </script>
                    <?php
                }

            } elseif(isset($_POST['checkin'])){
                $sqlval = "SELECT sum(amount) as subtotal FROM payment WHERE reserveid = '".$reserveid."'";
                $queryval = mysqli_query($connection,$sqlval) or die ("Database Connection Failed");
                $resultval = mysqli_fetch_assoc($queryval);

                if(!empty($resultval['subtotal'])){
                    $data1 = array(
                    'stat' => 1
                    );
                    doupdatereserve($reserveid,$data1);
                } else {
                    ?>
                      <script type="text/javascript">
                                swal({
                                  title: "There's no Payment Transactions",
                                  text: "",
                                  type: "error",
                                  showConfirmButton: true
                                }, function(){
                                       //window.location.href = "//stackoverflow.com";
                                });
                        </script>
                    <?php
                }


            } elseif(isset($_POST['checkout'])){
                $sqlval = "SELECT sum(amount) as subtotal FROM payment WHERE reserveid = '".$reserveid."'";
                $queryval = mysqli_query($connection,$sqlval) or die ("Database Connection Failed");
                $resultval = mysqli_fetch_assoc($queryval);

                if(!empty($resultval['subtotal'])){
                    $data1 = array(
                    'stat' => 2
                    );
                    doupdatereserve($reserveid,$data1);
                } else {
                    ?>
                      <script type="text/javascript">
                                swal({
                                  title: "There's no Payment Transactions",
                                  text: "",
                                  type: "error",
                                  showConfirmButton: true
                                }, function(){
                                       //window.location.href = "//stackoverflow.com";
                                });
                        </script>
                    <?php
                }
            }



        /*$data1 = array(
            'stat' => $_POST['status']
        );*/
         //var_dump($data);
        //doupdatereserve($reserveid,$data1);

    }
?>


<script type="text/javascript">
    $(document).ready(function() {

          var last_valid_selection = null;

          $('#roomsselect').change(function(event) {

            if ($(this).val().length > 3) {

              $(this).val(last_valid_selection);
            } else {
              last_valid_selection = $(this).val();
            }
          });
        });
</script>
