<?php
session_start();

include ('dbconn.php');
	//guest table
	$GID = date('Y') . "-" . rand(999,99999);
	$fname = $_SESSION['firstName'];
	$mname = $_SESSION['middleName'];
	$lname = $_SESSION['lastName'];
	$address = $_SESSION['address'];
	$gender = $_SESSION['gender'];
	$mnum = $_SESSION['contactNum'];
	$email = $_SESSION['email'];


	

	//reservation table
	$ResID = rand(9,9999);
	$adult = $_SESSION['adult'];
	$addadult = $_SESSION['adultadd'];
	$CheckInDate = $_SESSION['from'];
	$CheckOutDate = $_SESSION['to'];
	$RevDate = date('Y-m-d');
	  
	$numdays = abs(strtotime($CheckInDate) - strtotime($RevDate))/86400;
	if ($numdays > 7) {
	$ExpirationDate = date('Y-m-d', strtotime($RevDate. ' + 7 days'));		
	}else{
		$ExpirationDate = $CheckOutDate;
	}

	$ttlgst = $addadult + 	$adult;


$roomSinglePre = mysqli_query($conn, "SELECT * FROM roomtype WHERE RoomType = 'Presidential(Queen Sized-Bed)'");
$roomDoublePre = mysqli_query($conn, "SELECT * FROM roomtype WHERE RoomType = 'Presidential(Twin Sized-Bed)'");
$roomSingleSup = mysqli_query($conn, "SELECT * FROM roomtype WHERE RoomType = 'Superior(Queen Sized-Bed)'");
$roomDoubleSup = mysqli_query($conn, "SELECT * FROM roomtype WHERE RoomType = 'Superior(Twin Sized-Bed)'");


$countpsreserved = mysqli_query($conn, "SELECT * from roominventory ri join roomtype rt on ri.RoomID = rt.RoomID where (Status = 'Reserved' or Status = 'Pending' or Status = 'Checked-in') AND RoomType = 'Presidential(Queen Sized-Bed)'  AND 
              ((CheckInDate >= '$CheckInDate' and CheckInDate < '$CheckOutDate' )
            or (CheckOutDate > '$CheckInDate'and CheckOutDate < '$CheckOutDate' ) or (CheckOutDate >= '$CheckOutDate')and(CheckInDate < '$CheckInDate'))");
$countpdreserved = mysqli_query($conn, "SELECT * from roominventory ri join roomtype rt on ri.RoomID = rt.RoomID where (Status = 'Reserved' or Status = 'Pending' or Status = 'Checked-in') AND RoomType = 'Presidential(Twin Sized-Bed)'  AND 
              ((CheckInDate >= '$CheckInDate' and CheckInDate < '$CheckOutDate' )
            or (CheckOutDate > '$CheckInDate'and CheckOutDate < '$CheckOutDate' ) or (CheckOutDate >= '$CheckOutDate')and(CheckInDate < '$CheckInDate'))");
$countssreserved = mysqli_query($conn, "SELECT * from roominventory ri join roomtype rt on ri.RoomID = rt.RoomID where (Status = 'Reserved' or Status = 'Pending' or Status = 'Checked-in') AND RoomType = 'Superior(Queen Sized-Bed)'  AND 
              ((CheckInDate >= '$CheckInDate' and CheckInDate < '$CheckOutDate' )
            or (CheckOutDate > '$CheckInDate'and CheckOutDate < '$CheckOutDate' ) or (CheckOutDate >= '$CheckOutDate')and(CheckInDate < '$CheckInDate'))");
$countsdreserved = mysqli_query($conn, "SELECT * from roominventory ri join roomtype rt on ri.RoomID = rt.RoomID where (Status = 'Reserved' or Status = 'Pending' or Status = 'Checked-in') AND RoomType = 'Superior(Twin Sized-Bed)'  AND 
              ((CheckInDate >= '$CheckInDate' and CheckInDate < '$CheckOutDate' )
            or (CheckOutDate > '$CheckInDate'and CheckOutDate < '$CheckOutDate' ) or (CheckOutDate >= '$CheckOutDate')and(CheckInDate < '$CheckInDate'))");


			
			$presDrow = mysqli_num_rows($countpdreserved);
			$totalpdrow = mysqli_num_rows($roomDoublePre);
			$presDcount = $totalpdrow - $presDrow;

            $presSrow = mysqli_num_rows($countpsreserved);
            $totalpsrow = mysqli_num_rows($roomSinglePre);
            $presScount = $totalpsrow - $presSrow;
            
            $supSrow = mysqli_num_rows($countssreserved);
			$totalssrow = mysqli_num_rows($roomSingleSup);
			$supScount = $totalssrow - $supSrow;

			$supDrow = mysqli_num_rows($countsdreserved);
			$totalsdrow = mysqli_num_rows($roomDoubleSup);
			$supDcount = $totalsdrow - $supDrow;

    if(($_SESSION['presSNum'] > $presScount) or ($_SESSION['presDNum'] > $presDcount) or ($_SESSION['supSNum'] > $supDcount) or ($_SESSION['supDNum'] > $supScount)){
    	 echo ("<script language='JavaScript'>
        window.alert('The rooms are already taken')
        window.location.href='selectroom.php';
        </SCRIPT>");
    }else{
	$guest = mysqli_query($conn, "INSERT INTO guest (GuestId, GuestFName, GuestMName, GuestLName, Address, Gender, ContactNumber, Email) VALUES ('$GID', '$fname', '$mname', '$lname', '$address', '$gender', '$mnum', '$email')");

	$strrms = "";
	$counterps = 0;
	

	$roomSinglePre = mysqli_query($conn, "SELECT RoomID FROM roomtype WHERE RoomType = 'Presidential(Queen Sized-Bed)'");
	while($counterps < $_SESSION['presSNum']){
	while ($rmsp = mysqli_fetch_assoc($roomSinglePre)){
	if ($counterps < $_SESSION['presSNum']){
		$pSemp = mysqli_query($conn, "SELECT * from roominventory where RoomID = '{$rmsp['RoomID']}' AND (Status = 'Reserved' or Status = 'Pending' or Status = 'Checked-in') AND 
							((CheckInDate >= '$CheckInDate' and CheckInDate < '$CheckOutDate' )
						or (CheckOutDate > '$CheckInDate'and CheckOutDate < '$CheckOutDate' ) or (CheckOutDate >= '$CheckOutDate')and(CheckInDate < '$CheckInDate'))");
		$countps = mysqli_num_rows($pSemp);

	if($countps == 0){
		$availps = $rmsp['RoomID'];
		$strrms = $strrms." ".$availps;
	 	mysqli_query($conn, "INSERT INTO roominventory (ReservationID, RoomID, CheckInDate, CheckOutDate, Status) VALUES ('$ResID', '$availps', '$CheckInDate', '$CheckOutDate', 'Pending')");
 	$counterps++;
	 } else {
	 	echo "skip";
	 }
	}else{
		break;
	}
	}
}

	$counterpd = 0;

	$roomDoublePre = mysqli_query($conn, "SELECT RoomID FROM roomtype WHERE RoomType = 'Presidential(Twin Sized-Bed)'");
	while($counterpd < $_SESSION['presDNum']){
	while ($rmdp = mysqli_fetch_assoc($roomDoublePre)){
	if ($counterpd < $_SESSION['presDNum']){
		$pDemp = mysqli_query($conn, "SELECT * from roominventory where RoomID = '{$rmdp['RoomID']}' AND (Status = 'Reserved' or Status = 'Pending' or Status = 'Checked-in') AND 
							((CheckInDate >= '$CheckInDate' and CheckInDate < '$CheckOutDate' )
						or (CheckOutDate > '$CheckInDate'and CheckOutDate < '$CheckOutDate' ) or (CheckOutDate >= '$CheckOutDate')and(CheckInDate < '$CheckInDate'))");
		$countpd = mysqli_num_rows($pDemp);

	if($countpd == 0){
		$availpd = $rmdp['RoomID'];
		$strrms = $strrms." ".$availpd;
	 	mysqli_query($conn, "INSERT INTO roominventory (ReservationID, RoomID, CheckInDate, CheckOutDate, Status) VALUES ('$ResID', '$availpd', '$CheckInDate', '$CheckOutDate', 'Pending')");
 	$counterpd++;
	 } else {
	 	echo "skip";
	 }
	}else{
		break;
	}
	}	
}


	$counterss = 0;

	$roomSingleSup = mysqli_query($conn, "SELECT RoomID FROM roomtype WHERE RoomType = 'Superior(Queen Sized-Bed)'");
	while($counterss < $_SESSION['supSNum']){
	while ($rmss = mysqli_fetch_assoc($roomSingleSup)){
	if ($counterss < $_SESSION['supSNum']){
		$pSemp = mysqli_query($conn, "SELECT * from roominventory where RoomID = '{$rmss['RoomID']}' AND (Status = 'Reserved' or Status = 'Pending' or Status = 'Checked-in') AND 
							((CheckInDate >= '$CheckInDate' and CheckInDate < '$CheckOutDate' )
						or (CheckOutDate > '$CheckInDate'and CheckOutDate < '$CheckOutDate' ) or (CheckOutDate >= '$CheckOutDate')and(CheckInDate < '$CheckInDate'))");
		$countss = mysqli_num_rows($pSemp);

	if($countss == 0){
		$availss = $rmss['RoomID'];
		$strrms = $strrms." ".$availss;
	 	mysqli_query($conn, "INSERT INTO roominventory (ReservationID, RoomID, CheckInDate, CheckOutDate, Status) VALUES ('$ResID', '$availss', '$CheckInDate', '$CheckOutDate', 'Pending')");
 	$counterss++;
	 } else {
	 	echo "skip";
	 }
	}else{
		break;
	}
	}	
}


$countersd = 0;

	$roomDoubleSup = mysqli_query($conn, "SELECT RoomID FROM roomtype WHERE RoomType = 'Superior(Twin Sized-Bed)'");
	while($countersd < $_SESSION['supDNum']){
	while ($rmds = mysqli_fetch_assoc($roomDoubleSup)){
	if ($countersd < $_SESSION['supDNum']){
		$pSemp = mysqli_query($conn, "SELECT * from roominventory where RoomID = '{$rmds['RoomID']}' AND (Status = 'Reserved' or Status = 'Pending' or Status = 'Checked-in') AND 
							((CheckInDate >= '$CheckInDate' and CheckInDate < '$CheckOutDate' )
						or (CheckOutDate > '$CheckInDate'and CheckOutDate < '$CheckOutDate' ) or (CheckOutDate >= '$CheckOutDate')and(CheckInDate < '$CheckInDate'))");
		$countsd = mysqli_num_rows($pSemp);

	if($countsd == 0){
		$availsd = $rmds['RoomID'];
		$strrms = $strrms." ".$availsd;
	 	mysqli_query($conn, "INSERT INTO roominventory (ReservationID, RoomID, CheckInDate, CheckOutDate, Status) VALUES ('$ResID', '$availsd', '$CheckInDate', '$CheckOutDate', 'Checked-in')");
 	$countersd++;
	 } else {
	 	echo "skip";
	 }
	}else{
		break;
	}
	}	
}


	$date = date('Y-m-d');
	if ($CheckInDate == $date){
		$resStatus = 'Checked-in';
	}else{
		$resStatus = 'Reserved';
	}
	$reservation = mysqli_query($conn, "INSERT INTO reservation (ReservationID, GuestID, RoomsReserved, NumberOfAdult, ReservationDate, CheckInDate, CheckOutDate, Status) 
		VALUES('$ResID', '$GID', '$strrms', '$ttlgst', '$date', '$CheckInDate', '$CheckOutDate', '$resStatus')") or die("error reservation");

	//billing table
	$TotalAmount = $_SESSION['totalroom'];
	$ModeOfPayment = $_SESSION['modeofpayment'];

	$billing = mysqli_query($conn, "INSERT INTO billing (ReservationID, TotalAmount, PaidAmount, Balance, BillingStatus, ModeOfPayment) 
		VALUES('$ResID','$TotalAmount', '0.00', '$TotalAmount', 'Pending', '$ModeOfPayment')");

	mysqli_close($conn);

	print ("<script language='JavaScript'>
        window.location.href='Check-in.php';
        </SCRIPT>");
}


?>