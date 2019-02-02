<?php include "../pdf/fpdf.php";
	include "db.php";
	$pdf=new FPDF();
$type = $_POST['type'];

$billing = $_POST['billingstatus'];

	$datetoday = date("Y-m-d");
	if($type == 'Daily'){
	$date=date("Y-m-d");
	}elseif($type == 'Monthly'){
		$date=date("m");
	}elseif($type == 'Yearly'){
			$date=date("Y");
	}elseif($type == 'All'){
			$date="";
	}elseif($type == 'Weekly'){
	$monday = new DateTime('monday this week');
				$types = "This Week";
	}

	if($_POST['billingstatus'] == 'All Billing Transactions'){
			$billing = "";
	}else{
		$billing = $_POST['billingstatus'];
	}

$sumBalance =0;
$sumTAmount =0;
$sumPAmount =0;

	if($type == 'Weekly'){
for($i=0; $i<7; $i++) {
    $con = $monday->format('Y-m-d');
    $sumBalances = mysqli_query($conn, "SELECT SUM(Balance) as TotalBalance FROM billing b JOIN reservation r ON b.ReservationID = r.ReservationID join guest g on r.GuestID = g.GuestID where ReservationDate  LIKE '%{$con}%' and BillingStatus LIKE '%{$billing}%'");
	$rows = mysqli_fetch_array($sumBalances);
	$sumBalance += $rows['TotalBalance'];

	$sumTamounts = mysqli_query($conn, "SELECT SUM(TotalAmount) as TAmout FROM billing b JOIN reservation r ON b.ReservationID = r.ReservationID join guest g on r.GuestID = g.GuestID where ReservationDate  LIKE '%{$con}%' and BillingStatus LIKE '%{$billing}%'");
	$rows = mysqli_fetch_array($sumTamounts);
	$sumTAmount += $rows['TAmout'];

	$sumPamounts = mysqli_query($conn, "SELECT SUM(PaidAmount) as PAmout FROM billing b JOIN reservation r ON b.ReservationID = r.ReservationID join guest g on r.GuestID = g.GuestID where ReservationDate  LIKE '%{$con}%' and BillingStatus LIKE '%{$billing}%'");
	$rows = mysqli_fetch_array($sumPamounts);
	$sumPAmount += $rows['PAmout'];

$monday->modify('+1 day');

}

	}else{
	$sumBalances = mysqli_query($conn, "SELECT SUM(Balance) as TotalBalance FROM billing b JOIN reservation r ON b.ReservationID = r.ReservationID join guest g on r.GuestID = g.GuestID where ReservationDate  LIKE '%{$date}%' and BillingStatus LIKE '%{$billing}%'");
	$rows = mysqli_fetch_array($sumBalances);
	$sumBalance = $rows['TotalBalance'];

	$sumTamounts = mysqli_query($conn, "SELECT SUM(TotalAmount) as TAmout FROM billing b JOIN reservation r ON b.ReservationID = r.ReservationID join guest g on r.GuestID = g.GuestID where ReservationDate  LIKE '%{$date}%' and BillingStatus LIKE '%{$billing}%'");
	$rows = mysqli_fetch_array($sumTamounts);
	$sumTAmount = $rows['TAmout'];

	$sumPamounts = mysqli_query($conn, "SELECT SUM(PaidAmount) as PAmout FROM billing b JOIN reservation r ON b.ReservationID = r.ReservationID join guest g on r.GuestID = g.GuestID where ReservationDate  LIKE '%{$date}%' and BillingStatus LIKE '%{$billing}%'");
	$rows = mysqli_fetch_array($sumPamounts);
	$sumPAmount = $rows['PAmout'];
}
	$pdf->AddPage();
//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )
$pdf->Cell(130 ,5, 'Casa de Tobias',0,0);
$pdf->Cell(59 ,5,$type.' BillingReport',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130 ,5,'Alibungbungan, Nagcarlan, Laguna',0,0);
$pdf->Cell(59 ,5,'',0,1);//end of line

$pdf->Cell(130 ,5,'Casa de Tobias Nagcarlan Laguna',0,0);
$pdf->Cell(25 ,5,'Date',0,0);
$pdf->Cell(34 ,5,$datetoday,0,1);//end of line
$pdf->Cell(189 ,10,'',0,1);//en);//end of line
// $pdf->Cell(130 ,5d of line
$pdf->Cell(300 ,5,'Total amount receivable:' . $sumBalance,0,1);
$pdf->Cell(300 ,5,'Total Sales Amount:' . $sumTAmount,0,1);
$pdf->Cell(300 ,5,'Total Revenue Amount:' . $sumPAmount,0,1);
// $pdf->Cell(25 ,5,'Invoice #',0,0);
// $pdf->Cell(34 ,5,$billingID,0,1);//end of line

// $pdf->Cell(130 ,5,'(043) 740 4698',0,0);
// $pdf->Cell(25 ,5,'Customer ID',0,0);
// $pdf->Cell(34 ,5,$gid,0,1);//end of line

// $pdf->Cell(130 ,5,' ',0,0);
// $pdf->Cell(29 ,5,'ReservationID',0,0);
// $pdf->Cell(30 ,5,$reservationID,0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line
//$pdf->Cell(300 ,5,'Total number of '. $_POST['status'] ." for " . $type . " transaction: " . $count,0,1);//end of line
//billing address
// $pdf->Cell(100 ,5,'Bill to',0,1);//end of line

// //add dummy cell at beginning of each line for indentation
// $pdf->Cell(10 ,5,'',0,0);
// $pdf->Cell(90 ,5,$guestname,0,1);

// $pdf->Cell(10 ,5,'',0,0);
// $pdf->Cell(90 ,5,$address,0,1);

// $pdf->Cell(10 ,5,'',0,0);
// $pdf->Cell(90 ,5,$contact,0,1);
$pdf->SetFont('Arial','B',6);
	$pdf->Cell(25,5,'BillingID',1,0,'C');
	$pdf->Cell(25,5,'GuestID',1,0,'C');
	$pdf->Cell(30,5,'Total Amount',1,0,'C');
	$pdf->Cell(30,5,'Paid Amount',1,0,'C');
	$pdf->Cell(30,5,'Balance',1,0,'C');
	$pdf->Cell(22,5,'Billing Status',1,0,'C');
	$pdf->Cell(22,5,'Reservation Status',1,0,'C');
	$pdf->ln();
if($type == 'Weekly'){
$monday = new DateTime('monday this week');
	for($i=0; $i<7; $i++) {
    $con = $monday->format('Y-m-d');
   $query = mysqli_query($conn, "SELECT * FROM billing b JOIN reservation r ON b.ReservationID = r.ReservationID join guest g on r.GuestID = g.GuestID where ReservationDate  LIKE '%{$con}%' and BillingStatus LIKE '%{$billing}%'");

   while($row = mysqli_fetch_array($query)){
	$pdf->Cell(25,5,$row['BillingID'],1,0,'C');
	$pdf->Cell(25,5,$row['GuestID'],1,0,'C');
	$pdf->Cell(30,5,$row['TotalAmount'],1,0,'C');
	$pdf->Cell(30,5,$row['PaidAmount'],1,0,'C');
	$pdf->Cell(30,5,$row['Balance'],1,0,'C');
	$pdf->Cell(22,5,$row['BillingStatus'],1,0,'C');
	$pdf->Cell(22,5,$row['Status'],1,0,'C');
$pdf->ln();
}
    $monday->modify('+1 day');
}
}else{
	$query = mysqli_query($conn, "SELECT * FROM billing b JOIN reservation r ON b.ReservationID = r.ReservationID join guest g on r.GuestID = g.GuestID where ReservationDate  LIKE '%{$date}%' and BillingStatus LIKE '%{$billing}%'");
while($row = mysqli_fetch_array($query)){
	$pdf->Cell(25,5,$row['BillingID'],1,0,'C');
	$pdf->Cell(25,5,$row['GuestID'],1,0,'C');
	$pdf->Cell(30,5,$row['TotalAmount'],1,0,'C');
	$pdf->Cell(30,5,$row['PaidAmount'],1,0,'C');
	$pdf->Cell(30,5,$row['Balance'],1,0,'C');
	$pdf->Cell(22,5,$row['BillingStatus'],1,0,'C');
	$pdf->Cell(22,5,$row['Status'],1,0,'C');
$pdf->ln();
}
}
	$pdf->Output();?>
