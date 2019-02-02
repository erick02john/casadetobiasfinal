<?php
include('../include.php');


  $roomid = $_GET['roomid'];
  $firstname = ucwords($_GET['fname']);
  $lastname = ucwords($_GET['lname']);
  $address = $_GET['address'];
  $phonenumber = $_GET['phonenumber'];
  $phonenumber = $_GET['phonenumber1'];
  $email = $_GET['email'];
  $roomtype = $_GET['roomtype'];
  $roomprice = $_GET['roomprice'];
  $roomcapacity = $_GET['roomcapacity'];
  $roomavailable = $_GET['roomavailable'];
  $numrooms = $_GET['nroom'];
  $ndays = $_GET['ndays'];

  $checkin = $_GET['dtefrom'];
  $checkout = $_GET['dteto'];

  $addguestamount = 800;
  $nguest = $_GET['guest'];
  if($nguest == $roomcapacity){
    $addguest = $_GET['additional'];
  } else {
    $addguest = 0;
  }



  $totalguest = $_GET['guest'] + $addguest;



  $downamount = ($roomprice * $numrooms * $ndays) / 2;



  $guesttotal = $addguest * $addguestamount * $ndays;
  $subtotal = $roomprice * $numrooms * $ndays;

  $paymentwithvat = ($subtotal + $guesttotal) * .12;

  $payment = $_GET['payment'];
  $paymenttype = $_GET['paymenttype'];



?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui-1.12.1.css">

  <link rel="stylesheet" href="<?=base_url()?>css/sweetalert.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
           CASA DE TOBIAS MOUNTAIN RESORT
          <small class="pull-right">Date: <?=currentdate()?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong>Casa de Tobias Mountain Resort</strong><br>
          Alibungbungan, Nagcarlan, Laguna<br>
          Phone: (02) 794 3471<br>
          Email: casadetobias@gmail.com
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong><?=$firstname.' '.$lastname?></strong><br>
          <?=$address?><br>
          Phone: <?=$phonenumber?><br>
          Email: <?=$email?>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">

        <b>Check In:</b> <?=$checkin;?><br>
        <b>Check Out:</b> <?=$checkout;?><br>
        <hr />
        <p class="lead">Payment Methods:</p>
        <?php
        if($payment == 'cash'){
          echo 'Cash';
        } else {
          echo '<img src="'.base_url().'dist/img/credit/banklogo2.png" alt="bank transfer"><br />
          <label>Metrobank / Lingayen Branch</label><br />
          Account Name : Casa de Tobias Mountain Resort<br />
          Account No. : 752-700-1940
          ';
        }
        ?>

      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->



    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-2">
      <p class="lead">Policy :</p>
      <p>Check-in time is at 2pm</p>
      <p>Check-out time is at 12nn</p>
      <p>NO Refund</p>
      <p>NO Smoking</p>
      <p>NO pets Allowed</p>

      </div>
      <!-- /.col -->
      <div class="col-xs-8 col-xs-offset-2">
        <p class="lead">Room Details</p>

        <div class="table-responsive">
          <table class="table">
             <tr>
              <th>Night(s)</th>
              <td><?=$ndays?></td>
            </tr>
            <tr>
              <th style="width:50%">Rooms to Reserve:</th>
              <td>x<?=$numrooms?> <b>(<?=$roomtype?>)</b> = ₱ <?=formatnumber2($roomprice)?> Per Night</td>
            </tr>
            <tr>
              <th></th>
              <td><b>₱ <?=formatnumber2($subtotal);?></b> For <?=$ndays?> Nights(s)</td>
            </tr>
            <?php

            if($nguest == $roomcapacity){
            ?>
            <tr>
              <th>Additional Guest:</th>
              <td>x <?=$addguest?> <b>₱ <?=formatnumber2($guesttotal);?></b> For <?=$ndays?> Nights(s)</td>
            </tr>
            <?php
            }

            ?>
            <?php
              if($paymenttype == 'full'){
                ?>
                <tr>
                  <th>Sub Total:</th>
                  <td><b>₱ <?=formatnumber2($subtotal + $guesttotal);?></b></td>
                </tr>
                </tr>
                  <tr>
                  <th>vat:</th>
                  <td><b>₱ <?=formatnumber2($paymentwithvat);?></b></td>
                </tr>
                <tr>
                  <th>Total Payment:</th>
                  <td><b>₱ <?=formatnumber2($subtotal + $guesttotal);?></b></td>
                </tr>
                <?php
              } else {
                ?>
                <tr>
                  <th>VAT:</th>
                  <td><b>₱ <?=formatnumber2($paymentwithvat);?></td>
                </tr>
                <tr>
                  <th>Total Payment:</th>
                  <td><b>₱ <?=formatnumber2($subtotal + $guesttotal + $paymentwithvat);?></b></td>
                </tr>
                <tr>
                  <th>Down Payment:</th>
                  <td><b>₱ <?=formatnumber2(($subtotal + $guesttotal + $paymentwithvat) / 2);?></td>
                </tr>
                <tr>
                <?php
              }

            ?>
              <form method="POST">
              <td colspan="2" align="right"><b><input type="submit" class="btn btn-success" name="confirm" value="CONFIRM"></td>
              </form>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
<script src="<?=base_url()?>assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/js/bootstrap.min.js" type="text/javascript"></script>

<script src="<?=base_url()?>js/sweetalert.js"></script>


<?php
    if ($_POST) {

      $data = array(
        'Fname' => $firstname,
        'Lname' => $lastname,
        'Email' => $email,
        'Address' => $address,
        'PhoneNumber' => $phonenumber,
        'roomid'=>$roomid,
        'NRoom' => $numrooms,
        'NGuest' => $nguest,
        'AGuest' => $addguest,
        'Cin' => formatdate($checkin),
        'Cout' => formatdate($checkout),
        'paymenttype' => $paymenttype,
        'Stat' => '0',
        'NoOfDays' => $ndays,
        'payment' => $payment,
        'datestamp' => currentdate3()


      );

      //var_dump($data);
      //echo '<pre>';
      //print_r($data);
      //echo '</pre>';
      if($payment == 'cash'){
        doinsertcashdata($data);
      } else {
        doinsertdata($data);
      }



    }
