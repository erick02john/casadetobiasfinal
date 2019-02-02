<?php
include('../include.php');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>jQuery UI Datepicker - Default functionality</title>
	<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui-1.12.1.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script src="<?=base_url()?>assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>assets/js/jquery-ui.min.js" type="text/javascript"></script>
	<script>
 
 /** Days to be disabled as an array */
var disableddates = ["8-29-2018", "8-31-2018", "9-5-2018", "9-15-2018"];

 
function DisableSpecificDates(date) {
 
 var m = date.getMonth();
 var d = date.getDate();
 var y = date.getFullYear();
 
 // First convert the date in to the mm-dd-yyyy format 
 // Take note that we will increment the month count by 1 
 var currentdate = (m + 1) + '-' + d + '-' + y ;
 

 
 // We will now check if the date belongs to disableddates array 
 for (var i = 0; i < disableddates.length; i++) {
 
 // Now check if the current date is in disabled dates array. 
 if ($.inArray(currentdate, disableddates) != -1 ) {
 return [false];
 } 
 }
 
 return [i]; 
 
}
 
 
 $(function() {
 $( "#datepicker" ).datepicker({
 beforeShowDay: DisableSpecificDates
 });
 });
 </script>
</head>
<body>

<p>Date: <input type="text" id="datepicker"></p> <br />


</body>
</html>
