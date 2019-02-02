<?php include "../pdf/fpdf.php";
	include "db.php";
	$type = $_POST['type'];

	if($type == 'Daily'){
	$date=date("Y-m-d");
	$types = "Today";
	}elseif($type == 'Monthly'){
		$date=date("m");
		$types = "This Month";
		//$date=date('m/', strtotime($dates));
	}elseif($type == 'Yearly'){
			$date=date("Y");
			$types = "This Year";
	}elseif($type == 'All'){
			$date="";
			$types = "All";
	}elseif($type == 'Weekly'){
	$monday = new DateTime('monday this week');
				$types = "This Week";
	}

	if($_POST['status'] == 'All Reservation'){
			$status = "";
	}else{
		$status = $_POST['status'];
	}


	$count = 0;
	if($type == 'Weekly'){
		for($i=0; $i<7; $i++) {
    $con = $monday->format('Y-m-d');
    $querycount = mysqli_query($conn, "SELECT * FROM reservation where ReservationDate LIKE '%{$con}%' and Status LIKE '%{$status}%'") or die("error");
    $count += mysqli_num_rows($querycount);
    $monday->modify('+1 day');
	}


	}else{
	$querycount = mysqli_query($conn, "SELECT * FROM reservation where ReservationDate LIKE '%{$date}%' and Status LIKE '%{$status}%'") or die("error");
	$count = mysqli_num_rows($querycount);
	}


	$pdf=new FPDF();
$datetoday = date("Y-m-d");
	$pdf->AddPage();
//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )
$pdf->Cell(130 ,5, 'Casa de Tobias Mountain Resort',0,0);
$pdf->Cell(59 ,5,$type.' ReservationReport',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130 ,5,'Alibungbungan, Nagcarlan, Laguna',0,0);
$pdf->Cell(59 ,5,'',0,1);//end of line

$pdf->Cell(130 ,5,'Casa de Tobias Nagcarlan Laguna',0,0);
$pdf->Cell(25 ,5,'Date',0,0);
$pdf->Cell(34 ,5,$datetoday,0,1);//end of line

// $pdf->Cell(130 ,5,'(043) 740 4898',0,0);
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
$pdf->Cell(300 ,5,'Total number of '. $_POST['status'] ." for " . $types . " : " . $count,0,1);//end of line
//billing address
// $pdf->Cell(100 ,5,'Bill to',0,1);//end of line

// //add dummy cell at beginning of each line for indentation
// $pdf->Cell(10 ,5,'',0,0);
// $pdf->Cell(90 ,5,$guestname,0,1);

// $pdf->Cell(10 ,5,'',0,0);
// $pdf->Cell(90 ,5,$address,0,1);

// $pdf->Cell(10 ,5,'',0,0);
// $pdf->Cell(90 ,5,$contact,0,1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',6);
	$pdf->Cell(25,5,'ReservationID',1,0,'C');
	$pdf->Cell(25,5,'GuestID',1,0,'C');
	$pdf->Cell(25,5,'RoomsReserved',1,0,'C');
	$pdf->Cell(20,5,'NumberOfGuest',1,0,'C');
	$pdf->Cell(35,5,'CheckInDate',1,0,'C');
	$pdf->Cell(35,5,'CheckOutDate',1,0,'C');
	$pdf->Cell(20,5,'Status',1,0,'C');
	$pdf->ln();

	if($type == 'Weekly'){
		$monday = new DateTime('monday this week');
	for($i=0; $i<7; $i++) {
    $con = $monday->format('Y-m-d');
    $query = mysqli_query($conn, "SELECT * FROM reservation where ReservationDate LIKE '%{$con}%' and Status LIKE '%{$status}%'") or die("error");

    while($row = mysqli_fetch_array($query)){
	$pdf->Cell(25,5,$row['ReservationID'],1,0,'C');
	$pdf->Cell(25,5,$row['GuestID'],1,0,'C');
	$pdf->Cell(25,5,$row['RoomsReserved'],1,0,'C');
	$pdf->Cell(20,5,$row['NumberOfAdult'],1,0,'C');
	$pdf->Cell(35,5,$row['CheckInDate'],1,0,'C');
	$pdf->Cell(35,5,$row['CheckOutDate'],1,0,'C');
	$pdf->Cell(20,5,$row['Status'],1,0,'C');
	$pdf->ln();
	}

    $monday->modify('+1 day');
	}

	}else{

	$query = mysqli_query($conn, "SELECT * FROM reservation where ReservationDate LIKE '%{$date}%' and Status LIKE '%{$status}%'") or die("error");
	while($row = mysqli_fetch_array($query)){
	$pdf->Cell(25,5,$row['ReservationID'],1,0,'C');
	$pdf->Cell(25,5,$row['GuestID'],1,0,'C');
	$pdf->Cell(25,5,$row['RoomsReserved'],1,0,'C');
	$pdf->Cell(20,5,$row['NumberOfAdult'],1,0,'C');
	$pdf->Cell(35,5,$row['CheckInDate'],1,0,'C');
	$pdf->Cell(35,5,$row['CheckOutDate'],1,0,'C');
	$pdf->Cell(20,5,$row['Status'],1,0,'C');
	$pdf->ln();
	}
}

		$pdf->Output();

?>
