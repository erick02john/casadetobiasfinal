
<?php 
 include('../include.php');
	$conn = mysqli_connect("localhost","root","","newdbhotel") or die(mysql_error());


	$day = $_POST['day'];

	$monday = new DateTime($day . 'this week');
				$types = "This " . $day;
	

	if($_POST['status'] == 'All Reservation'){
			$status = "";
	}else{
		$status = $_POST['status'];
	}


	$count = "";
	for($i=0; $i<1; $i++) {
    $con = $monday->format('Y-m-d');

    $querycount = mysqli_query($conn, "SELECT * FROM roomreserve where datestamp LIKE '%{$con}%' and stat LIKE '%{$status}%'") or die("error2");
    $count += mysqli_num_rows($querycount);


    $monday->modify('+1 day');
	}

?>





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

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Daily Report</title>
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
           DAILY REPORT
          <small class="pull-right">Date: <?=currentdate()?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <address>
          <strong>Casa de Tobias Mountain Resort</strong><br>
          Alibungbungan, Nagcarlan, Laguna<br>
          Phone: (02) 794 3471<br>
          Email: casadetobias@gmail.com
        </address>
      </div>
     

    </div>
    <!-- /.row -->

 

    <div class="row">
      <!-- accepted payments column -->
   
      <!-- /.col -->
      <div class="col-xs-12">
        <p class="lead">Report Details</p>

        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
            <tr>
            <th width="3%">#</th>
            <th width="20%">Client Name</th>
            <th width="10%">Availed</th>
            <th width="5%">Rooms</th>
            <th width="5%">Days</th>
            <th width="8%">In</th>
            <th width="8%">Out</th>
            <th width="5%">Price</th>
            <th width="5%">Total</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $ctr = 1;
            $totalprice = 0;
            $query = mysqli_query($conn, "SELECT *,roomreserve.did as discountid FROM roomreserve,room,discounts WHERE roomreserve.roomid = room.roomid AND datestamp LIKE '%{$con}%' AND stat LIKE '%{$status}%'") or die("error");
			while($row = mysqli_fetch_array($query)){
			if($row['discountid'] > 0){
				$discounts = ($row['roomprice'] * $row['NRoom']) * $row['discountpercent'];
			} else {
				$discounts = 0;
			}
			
			$roomamount = $row['NRoom'] * $row['roomprice'] * $row['NoOfDays'];

			$price = ($roomamount * 0.12) + $roomamount - $discounts; 

			?>
			<tr>
				<td><?=$ctr;?></td>
				<td><?=$row['FName']?> <?=$row['LName']?></td>
				<td><?=$row['roomtype']?></td>
				<td><?=$row['NRoom']?></td>
				<td><?=$row['NoOfDays']?></td>
				<td><?=formatdate1($row['Cin'])?></td>
				<td><?=formatdate1($row['Cout'])?></td>
				<td><?=formatnumber2($row['roomprice'])?></td>
				<td><?=formatnumber2($price)?></td>
			<?php	
			$totalprice = $price + $totalprice;
			$ctr++;
			}
            ?>
            <tr>
            <td colspan="8" align="right">Subtotal : </td>
            <td><?=formatnumber2($totalprice);?></td>
            </tr>
            </tbody>
          </table>
        </div>
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

