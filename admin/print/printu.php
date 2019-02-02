<script type="text/javascript">
<script type="text/javascript">

function PrintWindow() {
   window.print();
   CheckWindowState();
}

function CheckWindowState() {
  if(document.readyState=="complete") {
    window.close();
  }
  else {
    setTimeout("CheckWindowState()", 1000)
  }
}

PrintWindow();

</script>
<?php

include('../../include.php');


  if(isset($_GET['id'])){
            $sql = "SELECT * FROM roomreserve,room WHERE id = '".$_GET['id']."' AND roomreserve.roomid = room.roomid";
            $query = mysqli_query($connection,$sql) or die ("Database Connection Failed");
            $result = mysqli_fetch_assoc($query);
  }
  $roomid = $result['roomid'];
  $firstname = ucwords($result['FName']);
  $lastname = ucwords($result['LName']);
  $address = $result['Address'];
  $phonenumber = $result['PhoneNumber'];
  $email = $result['Email'];
  $roomtype = $result['roomtype'];
  $roomprice = $result['roomprice'];
  $roomcapacity = $result['roomcapacity'];
  $roomavailable = $result['roomavailable'];


  $checkin = $result['Cin'];
  $checkout = $result['Cout'];

  $addguestamount = 800;

  $nguest = $result['NGuest'];
  if($nguest == $roomcapacity){
    $addguest = $result['AGuest'];
  } else {
    $addguest = 0;
  }

  $sql333 = "SELECT * FROM bridge,roomreserve,discounts WHERE bridge.reserveid = '".$_GET['id']."' AND bridge.did = discounts.did GROUP BY bridge.reserveid";
  $query333 = mysqli_query($connection,$sql333) or die ("Database Connection Failed");
  $result333 = mysqli_fetch_assoc($query333);

  $roomamount = $result['NRoom'] * $result['roomprice'] * $result['NoOfDays'];
  $guestamount = $addguestamount * $result['AGuest'] * $result['NRoom'];


  $totalguest = $result['NGuest'] + $addguest;
  $numrooms = $result['NRoom'];
  $dtotalamount = $roomamount;
  $numdays = $result['NoOfDays'];

  $discount = $result333['discountpercent'] * ($result['NRoom'] * $result['roomprice']);

  $guesttotal = $addguest * $addguestamount * $numdays;
  $subtotal = $result['NRoom'] * $result['roomprice'] * $result['NoOfDays'];
  $price = $subtotal + $guesttotal;

  $paymentwithvat = ($subtotal + $guesttotal) * .12;

  $totalprice = $paymentwithvat + $price;

  $payment = $result['payment'];
  $paymenttype = $result['paymenttype'];
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
        if($payment == 'Cash'){
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

      </div>
      <!-- /.col -->
      <div class="col-xs-8 col-xs-offset-2">
        <p class="lead">Room Details</p>

        <div class="table-responsive">
          <table class="table">
             <tr>
              <th>Night(s)</th>
              <td><?=$numdays?></td>
            </tr>
            <tr>
              <th style="width:50%">Rooms to Reserve:</th>
              <td><b>(<?=$roomtype?>)</b> = ₱ <?=formatnumber2($roomprice)?> Per Night</td>
            </tr>
            <tr>
              <th></th>
              <td><b>₱ <?=formatnumber2($subtotal);?></b> For <?=$numdays?> Nights(s)</td>
            </tr>
            <?php

            if($nguest == $roomcapacity){
            ?>
            <tr>
              <th>Additional Guest:</th>
              <td><b>₱ <?=formatnumber2($guesttotal);?></b> For <?=$numdays?> Nights(s)</td>
            </tr>
            <?php
            }

            ?>
            <?php
              if($paymenttype == 'full'){
                ?>
                </tr>
                <tr>
                  <th>Payment:</th>
                  <td><b>₱ <?=formatnumber2($subtotal + $guesttotal);?></b> For <?=$numdays?> Nights(s)</td>
                </tr>
                <?=(($result333['did'] == 1) ? "
                 <tr>
                  <th>Discount:</th>
                  <td><b>₱".formatnumber2($discount)."</b></td>
                </tr>":"")?>

                <tr>
                  <th>Sub Total:</th>
                  <td><b>₱ <?=formatnumber2($subtotal + $guesttotal - $discount);?></b></td>
                </tr>
                </tr>
                  <tr>
                  <th>vat:</th>
                  <td><b>₱ <?=formatnumber2($paymentwithvat);?></b></td>
                </tr>
                </tr>
                  <tr>
                  <th>Total Payment:</th>
                  <td><b>₱ <?=formatnumber2($totalprice - $discount);?></b></td>
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
        'NoOfDays' => $numdays,
        'datestamp' => currentdate3()


      );

      //var_dump($data);
      //echo '<pre>';
      //print_r($data);
      //echo '</pre>';
      doinsertdata($data);


    }
