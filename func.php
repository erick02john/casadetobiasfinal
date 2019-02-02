<?php
include('dbnewcon.php');

//insert reserve data
function doinsertdata($data){
$connection = mysqli_connect('localhost','root','');
mysqli_select_db($connection,'newdbhotel') or die( "Unable to select database");


$fields = array_keys($data);
  $sql = "INSERT INTO roomreserve (`".implode("`,`",$fields)."`)VALUES('".implode("','",$data)."')";

  // EMAIL SENDING HERE
  $sql1 = "SELECT (auto_increment) AS ids FROM information_schema.tables WHERE table_name = 'roomreserve' AND table_schema = 'newdbhotel'";
  $query = mysqli_query($connection,$sql1) or die ("Database Connection Failed");
  $result = mysqli_fetch_assoc($query);

    $res = mysqli_query($connection,$sql) or die (mysqli_error());
    if ($res){
      ?>
      <script type="text/javascript">
                swal({
                  title: "Success!",
                  text: "Redirecting in 2 seconds.",
                  type: "success",
                  timer: 2000,
                  showConfirmButton: false
                }, function(){
                       window.location.href = "<?=base_url()?>sendmail.php?mailids=<?=$result['ids']?>";
                });
        </script>
      <?php
    } else {
      ?>
      <script type="text/javascript">
                swal({
                  title: "Database Error!",
                  text: "",
                  type: "error",
                  showConfirmButton: true
                }, function(){
                       //window.location.href = "//stackoverflow.com";
                });
        </script>
      <?php
    }
  	//redirect(''.base_url().'');

 }

 function doinsertcashdata($data){
$connection = mysqli_connect('localhost','root','');
mysqli_select_db($connection,'newdbhotel') or die( "Unable to select database");


$fields = array_keys($data);
  $sql = "INSERT INTO roomreserve (`".implode("`,`",$fields)."`)VALUES('".implode("','",$data)."')";

  // EMAIL SENDING HERE
  $sql1 = "SELECT (auto_increment) AS ids FROM information_schema.tables WHERE table_name = 'roomreserve' AND table_schema = 'newdbhotel'";
  $query = mysqli_query($connection,$sql1) or die ("Database Connection Failed");
  $result = mysqli_fetch_assoc($query);

    $res = mysqli_query($connection,$sql) or die (mysqli_error());
    if ($res){
      ?>
      <script type="text/javascript">
                swal({
                  title: "Success!",
                  text: "Redirecting in 2 seconds.",
                  type: "success",
                  timer: 2000,
                  showConfirmButton: false
                }, function(){
                       window.location.href = "<?=base_url()?>sendmailcash.php?mailids=<?=$result['ids']?>";
                });
        </script>
      <?php
    } else {
      ?>
      <script type="text/javascript">
                swal({
                  title: "Database Error!",
                  text: "",
                  type: "error",
                  showConfirmButton: true
                }, function(){
                       //window.location.href = "//stackoverflow.com";
                });
        </script>
      <?php
    }
    //redirect(''.base_url().'');

 }


function douploadfiles($id,$data){
  $sql = "UPDATE roomreserve SET";

    // Loop and build the Column
    $sets = array();
    foreach ($data as $col => $value) {
      $sets[] = "`".$col."` = '".$value."'";
    }

    $sql .= implode(',', $sets);

    //append the where statment
    $sql .= "WHERE id = '".$id."'";

    $connection = mysqlI_connect('localhost','root','');
    mysqlI_select_db($connection,'newdbhotel') or die( "Unable to select database");

    $res = mysqli_query($connection,$sql) or die (mysql_error());
      if ($res){
        ?>
        <script type="text/javascript">
                  swal({
                    title: "Successfully Upload Your Bank Deposit ",
                    text: "",
                    type: "success",
                    showConfirmButton: true
                  }, function(){
                         document.location.href = "<?=base_url()?>";
                  });
          </script>
        <?php
      } else {
        ?>
        <script type="text/javascript">
                  swal({
                    title: "Database Error!",
                    text: "",
                    type: "error",
                    showConfirmButton: true
                  }, function(){
                         document.location.href = "<?=base_url()?>";
                  });
          </script>
        <?php
      }
      //redirect(''.base_url().'admin/home.php');

}
 // update reserve data
function doupdatebridge($reserveid,$data){
  $sql = "UPDATE roomreserve SET";

    // Loop and build the Column
    $sets = array();
    foreach ($data as $col => $value) {
      $sets[] = "`".$col."` = '".$value."'";
    }

    $sql .= implode(',', $sets);

    //append the where statment
    $sql .= "WHERE id = '".$reserveid."'";

    $connection = mysqli_connect('localhost','root','');
    mysqli_select_db($connection,'newdbhotel') or die( "Unable to select database");

    $res = mysqli_query($connection,$sql) or die (mysql_error());
      if ($res){
        ?>
        <script type="text/javascript">
                  swal({
                    title: "Successfully Discount Updated",
                    text: "",
                    type: "success",
                    showConfirmButton: true
                  }, function(){
                         document.location.href = "<?=base_url()?>admin/home.php";
                  });
          </script>
        <?php
      } else {
        ?>
        <script type="text/javascript">
                  swal({
                    title: "Database Error!",
                    text: "",
                    type: "error",
                    showConfirmButton: true
                  }, function(){
                         document.location.href = "<?=base_url()?>admin/home.php";
                  });
          </script>
        <?php
      }
      //redirect(''.base_url().'admin/home.php');

   }



//insert walking data
function dowalkinreservation($data){
$fields = array_keys($data);
$sql = "INSERT INTO roomreserve (`".implode("`,`",$fields)."`)VALUES('".implode("','",$data)."')";

$connection = mysqli_connect('localhost','root','');
mysqli_select_db($connection,'newdbhotel') or die( "Unable to select database");

    $res = mysqli_query($connection,$sql) or die (mysql_error());
    if ($res){
       ?>
      <script type="text/javascript">
                swal({
                  title: "Success!",
                  text: "Redirecting in 2 seconds.",
                  type: "success",
                  timer: 2000,
                  showConfirmButton: false
                }, function(){
                       window.location.href = "<?=base_url()?>admin/home.php";
                });
        </script>
      <?php
    } else {
       ?>
        <script type="text/javascript">
                  swal({
                    title: "Database Error!",
                    text: "",
                    type: "error",
                    showConfirmButton: true
                  }, function(){
                         document.location.href = "<?=base_url()?>admin/home.php";
                  });
          </script>
        <?php
    }
    //redirect(''.base_url().'admin/home.php');

 }


function doinsertroomdata($data){
$fields = array_keys($data);
$sql = "INSERT INTO bridge (`".implode("`,`",$fields)."`)VALUES('".implode("','",$data)."')";

$connection = mysqli_connect('localhost','root','');
mysqli_select_db($connection,'newdbhotel') or die( "Unable to select database");

    $res = mysqli_query($connection,$sql) or die (mysql_error());
    if ($res){
      //echo "<script type='text/javascript'> alert('Your Booking application has been sent')</script>";
    } else {
      //echo "<script type='text/javascript'> alert('Database Error')</script>";
    }
    redirect(''.base_url().'admin/home.php');

 }



// insert payment data
function doinsertpayment($data){
$fields = array_keys($data);
$sql = "INSERT INTO payment (`".implode("`,`",$fields)."`)VALUES('".implode("','",$data)."')";

$connection = mysqli_connect('localhost','root','');
mysqli_select_db($connection,'newdbhotel') or die( "Unable to select database");

    $res = mysqli_query($connection,$sql) or die (mysql_error());
    if ($res){
      //echo "<script type='text/javascript'> alert('Successfully Updated')</script>";
    } else {
      //echo "<script type='text/javascript'> alert('Database Error')</script>";
    }
  	//redirect(''.base_url().'admin/home.php');

 }


// insert rooms data
 function doinsertroom($data){
$fields = array_keys($data);
$sql = "INSERT INTO room (`".implode("`,`",$fields)."`)VALUES('".implode("','",$data)."')";

$connection = mysqli_connect('localhost','root','');
mysqli_select_db($connection,'newdbhotel') or die( "Unable to select database");

    $res = mysqli_query($connection,$sql) or die (mysql_error());
    if ($res){
      //echo "<script type='text/javascript'> alert('Successfully Updated')</script>";
    } else {
      //echo "<script type='text/javascript'> alert('Database Error')</script>";
    }
    //redirect(''.base_url().'admin/room.number.php');

 }


// update reserve data
function doupdatereserve($reserveid,$data){
  $sql = "UPDATE roomreserve SET";

    // Loop and build the Column
    $sets = array();
    foreach ($data as $col => $value) {
      $sets[] = "`".$col."` = '".$value."'";
    }

    $sql .= implode(',', $sets);

    //append the where statment
    $sql .= "WHERE ID = '".$reserveid."'";

    $connection = mysqlI_connect('localhost','root','');
    mysqlI_select_db($connection,'newdbhotel') or die( "Unable to select database");

    $res = mysqli_query($connection,$sql) or die (mysql_error());
      if ($res){
        ?>
        <script type="text/javascript">
                  swal({
                    title: "Successfully Reserve Updated",
                    text: "",
                    type: "success",
                    showConfirmButton: true
                  }, function(){
                         document.location.href = "<?=base_url()?>admin/home.php";
                  });
          </script>
        <?php
      } else {
        ?>
        <script type="text/javascript">
                  swal({
                    title: "Database Error!",
                    text: "",
                    type: "error",
                    showConfirmButton: true
                  }, function(){
                         document.location.href = "<?=base_url()?>admin/home.php";
                  });
          </script>
        <?php
      }
      //redirect(''.base_url().'admin/home.php');

   }


  function doupdateroom($roomid,$data){
  $sql = "UPDATE room SET";

    // Loop and build the Column
    $sets = array();
    foreach ($data as $col => $value) {
      $sets[] = "`".$col."` = '".$value."'";
    }

    $sql .= implode(',', $sets);

    //append the where statment
    $sql .= "WHERE roomid = '".$roomid."'";

    $connection = mysqlI_connect('localhost','root','');
    mysqlI_select_db($connection,'newdbhotel') or die( "Unable to select database");

    $res = mysqli_query($connection,$sql) or die (mysql_error());
      if ($res){
        echo "<script type='text/javascript'> alert('Successfully Updated')</script>";
      } else {
        echo "<script type='text/javascript'> alert('Database Error')</script>";
      }
      redirect(''.base_url().'admin/room.number.php');

   }


  function dodeleteexpired($id){
    $con = mysqli_connect("localhost","root","","newdbhotel") or die(mysql_error());
    mysqli_query($con, "DELETE FROM `roomreserve` WHERE ID = '".$id."'") or die ("no connection updateroom");
    mysqli_close($con);

    redirect(''.base_url().'admin/home.php');
  }
//delete function
  function dodeletereserve($id){
    $con = mysqli_connect("localhost","root","","newdbhotel") or die(mysql_error());
    mysqli_query($con, "DELETE FROM `roomreserve` WHERE ID = '".$id."'") or die ("no connection updateroom");
    mysqli_close($con);

    redirect(''.base_url().'admin/home.php');
   }

  function dodeleteroom($id){
    $con = mysqli_connect("localhost","root","","newdbhotel") or die(mysql_error());
        mysqli_query($con, "DELETE FROM `room` WHERE roomid = '".$id."'") or die ("no connection updateroom");
        mysqli_close($con);

        ?>
        <script type="text/javascript">
                  swal({
                    title: "Successfully Deleted!",
                    text: "Redirecting in 2 seconds.",
                    type: "success",
                    timer: 2000,
                  }).then(function() {
                      window.location = "<?=base_url()?>admin/room.number.php";
                  });
          </script>
        <?php
  }

  function docanceldeleteroom($id){
      ?>
        <script type="text/javascript">
             swal({
                title: "Canceled!",
                text: "Redirecting in 2 seconds.",
                type: "success",
                timer: 2000,
            }).then(function() {
                window.location = "<?=base_url()?>admin/room.number.php";
            });
                  //swal("Canceled", "", "success");
        </script>
    <?php
  }


/*
 function insertpayment($paymentid,$data){

 	$sql = "UPDATE payment SET";

 	// Loop and build the Column
	$sets = array();
	foreach ($data as $col => $value) {
		$sets[] = "`".$column."` = '".$value."'";
	}

	$sql .= implode(',', $sets);

	//append the where statment
	$sql .= "WHERE paymentid = '".$paymentid."'";

	$res = mysql_query($sql) or die (mysql_error());
    if ($res){
      echo "<script type='text/javascript'> alert('Successfully Updated')</script>";
    } else {
      echo "<script type='text/javascript'> alert('Database Error')</script>";
    }
  	redirect(''.base_url().'admin/home.php');

 }
 */
