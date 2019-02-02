<?php
$con = mysqli_connect("localhost","root","","newdbhotel") or die(mysql_error());

$connection = mysqli_connect('localhost','root','');
mysqli_select_db($connection,'newdbhotel') or die( "Unable to select database");
