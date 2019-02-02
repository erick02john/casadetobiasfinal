<?php  
include ('../include.php');
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
    <title>Administrator    </title>
    <!-- Bootstrap Styles-->
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
      <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url()?>dist/css/skins/_all-skins.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- Select2 -->
    <link rel="stylesheet" href="<?=base_url()?>bower_components/select2/dist/css/select2.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/iCheck/all.css">
</head>
<style type="text/css">
    .modal-body{
        overflow-x: auto;
    }
</style>
<body>
  

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
            $sql = "SELECT count(*) as cnt FROM roomreserve,room WHERE roomreserve.roomid = room.roomid";
            $query = mysql_query($sql, $connection) or die ("Database Connection Failed");
                $result = mysql_fetch_assoc($query);
            
                  
                  

            
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
                                <table class="table" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
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
                  $sql1 = "SELECT * FROM roomreserve,room WHERE roomreserve.roomid = room.roomid";
                       $result1 = $con->query($sql1);
                      while($row1=$result1->fetch_assoc()){
                                    $stat = $row1['Stat'];
                                    $addguestamnt = 800;
                                    echo '<tr>
                                    <td>'.$row1['ID'].'</td>
                                    <td>'.$row1['FName'].' '.$row1['LName'].'</td>
                                    <td>'.$row1['Email'].'</td>
                                    <td align="center"><b>'.$row1['roomtype'].'</b></td>
                                    <td align="center">'.$row1['NRoom'].'</td>
                                    <td align="center">'.($row1['NGuest'] + $row1['AGuest']).'</td>
                                    <td><b><center>'.(($row1['paymenttype'] == 'full') ? "Full Payment":"Down Payment").'</center></b></td>
                                    <td>'.formatdate1($row1['Cin']).'</td>
                                    <td>'.formatdate1($row1['Cout']).'</td>
                                    <td><b>'.(($row1['Stat'] == 0) ? 'Pending':'Active').'</b></td>
                                    <td><a data-toggle="modal" data-target="#modal'.$row1['ID'].'"><i class="fa fa-fw fa-folder-open"></i></a>
                                     <a data-toggle="modal" data-target="#modal1'.$row1['ID'].'"><i class="fa fa-fw fa-bell"></i></a></td>
                                    ';

                                    $roomamount = $row1['NRoom'] * $row1['roomprice'];
                                    $guestamount = $addguestamnt * $row1['AGuest'] * $row1['NRoom'];

                                    $totalpayment = $roomamount + $guestamount;
                                      

                                    $sql3 = "SELECT * FROM payment WHERE reserveid = '".$row1['ID']."'";
                                    $query3 = mysql_query($sql3, $connection) or die ("Database Connection Failed");
                                    $result3 = mysql_fetch_assoc($query3);

                                        if($result3['balance']){
                                            $balance = $result3['balance'] - $result3['amount'];
                                        } else {
                                            $balance = $totalpayment;
                                        }

                                    $strval = '<div class="modal fade" id="modal'.$row1['ID'].'">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">'.$row1['FName'].' '.$row1['LName'].' -  Room ID: '.$row1['ID'].'</h4>
                                            <br />
                                            
                                            Payment Type: '.(($row1['paymenttype'] == 'full') ? "Full Payment":"Down Payment").'
                                          </div>
                                          <form method="POST">
                                          <div class="modal-body">
                                            <div class="row">';
                                                $strval .= '<div class="col-md-12">
                                                   
                                                    <div class="form-group">
                                                      <label>Balance</label>
                                                      <input type="hidden" name="reserveid" value="'.$row1['ID'].'">
                                                      <input type="text" name="balance" class="form-control" value="'.$balance.'" id="balance" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                      <label>Amount</label>
                                                      <input type="text" class="form-control" name="amount" id="amount">
                                                    </div>
                                                    
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="status" class="form-control">
                                                    <option disabled></option>
                                                    <option value="0" '.(($stat == 0) ? "Selected":"").'>Pending</option>
                                                    <option value="1" '.(($stat == 1) ? "Selected":"").'>Check-In</option>
                                                    <option value="2" '.(($stat == 2) ? "Selected":"").'>Check-Out</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Send Mail</label>
                                                    <div class="form-group">
                                                        <label class="">
                                                          <div class="icheckbox_minimal-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" name="mailer" class="minimal" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                                        <i class="label label-sm" style="color:grey;">Check This to Send Via Email</i>
                                                        </label>
                                                  </div>
                                                </div>
                                                </div>
                                               
                                                </div>
                                          </div>
                                          <div class="modal-footer"><button type="submit" class="btn btn-info pull-left">Update</button><button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                      </div>
                                      </form>
                                    </div>';
                                    echo $strval;

                                    }
                                    ?>
                                    </tr>
                                    </tbody>
                                </table>



                
                            </div>
                        </div>
                    </div>

                    
                      <!-- End  Basic Table  --> 
                                        </div>
                                    </div>
                                </div>








<div class="panel panel-danger">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">
                      <button class="btn btn-primary" type="button">
                         Check-Out <span class="badge">0</span>
                      </button>
                      </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                      <th>Follow Start</th>
                                            <th>Permission status</th>
                                            
                      
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                
                            </div>
                        </div>
                    </div>
                  </div>
                </div>


   <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    <!-- Select2 -->
    <script src="<?=base_url()?>bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="<?=base_url()?>plugins/iCheck/icheck.min.js"></script>
    <script type="text/javascript">
        //Initialize Select2 Elements
        $('.select2').select2();

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass   : 'iradio_minimal-blue'
        });
    </script>
</body>
</html>
