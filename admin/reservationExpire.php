<?php
include 'db.php';

$date = date("Y-m-d");
$query = mysqli_query($conn, "SELECT * from reservation r join billing b on r.ReservationID = b.ReservationID where ExpirationDate <= '$date' and Status = 'Pending'") or die("query");


while ($row = mysqli_fetch_assoc($query)) {

	mysqli_query($conn, "DELETE From billing where ReservationID = '{$row['ReservationID']}'") or die ("billing");
	mysqli_query($conn, "DELETE From roominventory where ReservationID = '{$row['ReservationID']}' and Status = 'Pending'") or die ("roominventory");
	mysqli_query($conn, "DELETE FROM reservation where ReservationID = '{$row['ReservationID']}' and Status = 'Pending'") or die ("reservation");
}


?>