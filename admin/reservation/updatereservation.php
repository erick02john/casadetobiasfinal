<?php
include('../../include.php');

if(isset($_GET['doupdatereserve']))
{
    $roomreserveid = $_GET['doupdatereserve'];

    $sql12 = "SELECT * FROM roomreserve WHERE ID = '".$roomreserveid."'";
    $query12 = mysqli_query($connection,$sql12) or die ("Database Connection Failed");
    $result12 = mysqli_fetch_assoc($query12);

    $id = $result12['roomid'];
    $sql = "SELECT * FROM room WHERE roomid = '".$id."'";
    $result = $con->query($sql);
        while($row=$result->fetch_assoc()){
            $sql1 = "SELECT roomid,sum(NRoom) as NRoomAvail FROM roomreserve WHERE roomid = '".$row['roomid']."'";
            $query = mysqli_query($connection,$sql1) or die ("Database Connection Failed");
            $result1 = mysqli_fetch_assoc($query);

            if($result1['roomid'] == $row['roomid']){
                $testing = $result12['NRoom'];
            } else {
                $testing = 0;
            }

            $roomtype = $row['roomtype'];
            $roomprice = $row['roomprice'];
            $roomcapacity = $row['roomcapacity'];
            $roomavailable = $row['roomavailable'] - $result1['NRoomAvail'] + $testing;
            $additional = $row['additional'];
            $roomimg = $row['roomimg'];

          }


    $sql5 = "SELECT * FROM roomreserve where roomid = '".$id."'";
    $query5 = mysqli_query($connection,$sql5) or die ("Database Connection Failed");
    $result5 = mysqli_fetch_assoc($query5);

    $start = $result5['Cin'];
    $end = $result5['Cout'];
    $output = "";
    foreach (datebetween($start,$end) as $val) {
        $output .= '"'.$val.'" ,';


    }
} else {

}
?>

<?php

?>
<!doctype html>
<html lang="en">


<!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/forms/wizard.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Mar 2017 21:33:57 GMT -->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Reservation</title>
    <!-- Bootstrap core CSS     -->
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="<?=base_url()?>assets/css/material-dashboard.css" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?=base_url()?>assets/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="<?=base_url()?>assets/css/font-awesome.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/css/google-roboto-300-700.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?=base_url()?>css/sweetalert.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui-1.12.1.css">
</head>

<body onpaste="return false">
    <div class="wrapper">
      
        <div class="main-panel">
            
                    <div class="col-sm-9 col-sm-offset-0">
                        <!--      Wizard container        -->
                        <div class="wizard-container">
                            <div class="card wizard-card" data-color="rose" id="wizardProfile">
                                <form action="<?=base_url()?>admin/reservation/updateinvoice.php" method="GET">
                                    <input type="hidden" name="reserveid" value="<?=$roomreserveid?>">
                                    <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                                    <div class="wizard-header">
                                        <h3 class="wizard-title">
                                            Reservation 
                                        </h3>
                                        <h5>This information will let us know more about you.</h5>
                                    </div>
                                    <div class="wizard-navigation">
                                        <ul>
                                            
                                            <li>
                                                <a href="#roominfo" style="pointer-events: none;" data-toggle="tab"  disabled="true">Room Information</a>
                                            </li>
                                            <li>
                                                <a href="#reserve" style="pointer-events: none;" data-toggle="tab">Reservation Information</a>
                                            </li>
                                            <li>
                                                <a href="#guest" style="pointer-events: none;" data-toggle="tab">Guest Information</a>
                                            </li>

                                          
                                        </ul>
                                    </div>
                                    <div class="tab-content">
                                    
                                                <div class="tab-pane" id="roominfo">
                                                <div class="row">
                                                    <h4 class="info-text">ROOM</h4>
                                                    
                                                        <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">home</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Room Type</label>
                                                                <select name="roomtype" id="roomtype" class="form-control" REQUIRED>
                                                                    <option value="" selected disabled></option>
                                                                    <?php
                                                                      $sql3 = "SELECT * FROM room";
                                                                        $result3 = $con->query($sql3);
                                                                            while($row55=$result3->fetch_assoc()){
                                                                                $sql4 = "SELECT sum(NRoom) as NRoomAvail FROM roomreserve WHERE roomid = '".$row55['roomid']."'";
                                                                                $query2 = mysqli_query($connection,$sql4) or die ("Database Connection Failed");
                                                                                $result4 = mysqli_fetch_assoc($query2);
                                                                                $roomtype1 = $row55['roomtype'];
                                                                                $roomprice1 = $row55['roomprice'];
                                                                                $roomcapacity1 = $row55['roomcapacity'];
                                                                                $roomavailable1 = $row55['roomavailable'] - $result4['NRoomAvail'];
                                                                                $additional1 = $row55['additional'];
                                                                                $roomimg1 = $row55['roomimg'];



                                                                                echo '<option value="'.$row55['roomid'].'" '.(($row55['roomid'] == $id) ?"selected":"").' '.(($roomavailable > 0) ? "":"disabled").'>'.$row55['roomtype'].' '.(($roomavailable > 0) ? "":" [Not Available]").'</option>'; //close your tags!!
                                                                              }

                                                                    ?>
                                                                </select>
                                                               
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <div class="col-sm-12"></div>

                                                        <div id="replace">
                                                        <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">label_important</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Room Price</label>
                                                                <label class="label" style="color: black;"><span>₱</span><?=formatnumber2($roomprice)?>
                                                                <input name="roomprice" type="hidden" class="form-control"  value="<?=$roomprice?>" readonly>
                                                                <input type="hidden" name="roomid" value="<?=$id;?>">
                                                            </div>
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">label_important</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Room Capacity</label>
                                                                <label class="label" style="color: black;"><?=$roomcapacity?></label>
                                                                <input name="roomcapacity" type="hidden" class="form-control"  value="<?=$roomcapacity?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">label_important</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Room Availability</label>
                                                                <label class="label" style="color: black;"><?=(($roomavailable > 0) ? 'Available':'Not Available')?></label>
                                                                <input name="roomavailable" type="hidden" class="form-control"  value="<?=(($roomavailable > 0) ? 'Available':'Not Available')?>" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="col-sm-5">
                                                        <div class="picture-container">
                                                            <div>
                                                                <img src="<?=base_url().''.$roomimg?>"  />
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="col-sm-5">
                                                            <div class="picture-container">
                                                                <div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>
                                                     </div><!-- END OF REPLACE DIV-->


                                                </div>
                                            </div>
                                     
                                        
                                        <div class="tab-pane" id="guest">
                                            <h4 class="info-text">GUEST</h4>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="col-sm-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">First Name</label>
                                                            <input class="form-control" type="text" name="firstname" placeholder="First Name" value="<?=$result12['FName']?>" onfocus="this.select()" onkeypress="return isAlphaKey(event)" style="width: 190px;" autocomplete="off" REQUIRED />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Last Name</label>
                                                            <input type="text" name="lastname" value="<?=$result12['LName']?>" class="form-control" onfocus="this.select()" onkeypress="return isAlphaKey(event)" style="width: 190px;" autocomplete="off" REQUIRED>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="col-sm-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label" >E-Mail</label>
                                                            <input type="email" name="email" value="<?=$result12['Email']?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Phone Number</label>
                                                            <input type="text"  name="phonenumber" value="<?=$result12['PhoneNumber']?>" class="form-control" onfocus="this.select()" onkeypress="return isNumberKey(event)" style="width: 190px;" maxlength="11" REQUIRED>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-sm-12">
                                                    <h4 class="info-text"> Address </h4>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Address</label>
                                                        <input  name="address" type="text" value="<?=$result12['Address']?>" class="form-control" REQUIRED>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        </div>
                                        <div class="tab-pane" id="reserve">
                                             <h4 class="info-text">RESERVATION</h4>
                                             <div id="replace2">
                                            <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Check In:</label>
                                                            <div class="input-group date">
                                                              <div class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                              </div>
                                                              <input type="text" name="checkin" class="form-control pull-right" id="datepicker" autocomplete="off" value="<?=formatdate2($result12['Cin'])?>"  required>
                                                            </div>
                                                        </div>
                                            </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Check Out:</label>
                                                            <div class="input-group date"  >
                                                              <div class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                              </div>
                                                              <input type="text" name="checkout" value="<?=formatdate2($result12['Cout'])?>" class="form-control pull-right" id="datepicker1" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="material-icons">label_important</i>
                                                        </span>
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Number of Days</label>
                                                            <input type="text" name="numdays" class="form-control" id="ndays" value="<?=$result12['NoOfDays']?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                 <div class="col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="material-icons">label_important</i>
                                                        </span>
                                                        <div class="form-group label-floating">
                                                        <label class="control-label">Number of Room(s):</label>


                                                        <select name="totalamount" class="form-control" id="totalamount" onchange="computetotal()">
                                                            <?php
                                                            for ($x = 1; $x <= $roomavailable; $x++) {
                                                                echo "<option value='$x' ".(($result12['NRoom'] == $x) ? "selected":"").">$x</option>";
                                                            } 
                                                            ?>
                                                        </select>
                                                    </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="material-icons">label_important</i>
                                                        </span>
                                                        <div class="form-group label-floating">
                                                        <label class="control-label">Guest(s):</label>


                                                        <select name="nguest" class="form-control" id="nguest">

                                                            <?php
                                                            for ($x = 1; $x <= $roomcapacity; $x++) {
                                                                echo "<option value='$x' ".(($result12['NGuest'] == $x) ? "Selected":"").">$x</option>";
                                                            } 
                                                            /*foreach($number as $key => $value):
                                                            if($roomcapacity >= $value){
                                                              echo '<option value="'.$value.'">'.$value.'</option>';   
                                                            }
                                                            endforeach;
                                                            */
                                                            ?>
                                                        </select>
                                                    </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="material-icons">label_important</i>
                                                        </span>
                                                        <div class="form-group label-floating">
                                                        <label class="control-label">Additional Guest(s):</label>


                                                        <select name="addguest" class="form-control" id="addguest">
                                                            <option value="0" selected>0</option>
                                                            <?php
                                                            for ($x = 1; $x <= $additional; $x++) {
                                                                echo "<option value='$x' ".(($result12['NGuest'] == $x) ? "Selected":"").">$x</option>";
                                                            } 
                                                            ?>
                                                        </select>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <span>₱</span>
                                                        </span>
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Total Amount</label>
                                                            <input type="text" name="dtotalamount" class="form-control" id="displaytotalamount" value="<?=($roomprice * $result12['NRoom'] * $result12['NoOfDays'])?>" readonly>
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                            </div>

                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <span></span>
                                                        </span>
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Payment</label>
                                                            <select name="payment" class="form-control" required>
                                                            <option selected ></option>
                                                            <option value="cash" <?=(($result12['payment'] == 'cash') ? "SELECTED":"")?>>Cash</option>
                                                            <option value="bankdep" <?=(($result12['payment'] == 'bankdep') ? "SELECTED":"")?>>Bank Deposit</option>
                                                        </select>
                                                        <span class="material-input"></span></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <span></span>
                                                        </span>
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Payment Type</label>
                                                            <select name="paymenttype" class="form-control" required>
                                                            <option selected disabled></option>
                                                            <option value="full" <?=(($result12['paymenttype'] == 'full') ? "selected":"")?>>Full Payment</option>
                                                            <option value="half" <?=(($result12['paymenttype'] == 'half') ? "selected":"")?>>Down Payment</option>
                                                        </select>
                                                        <span class="material-input"></span></div>
                                                    </div>
                                                </div>
                                            </div>


                                            </div>
                                    </div>
                                    <div class="wizard-footer">
                                        <div class="pull-right">
                                            <input type='button' class='btn btn-next btn-fill btn-rose btn-wd' name='next' value='Next' />
                                            <input type='submit' class='btn btn-finish btn-fill btn-rose btn-wd' name='finish' value='Update' />
                                        </div>
                                        <div class="pull-left">
                                            <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- wizard container -->
                  
            </div>

        </div>
    </div>
    
</body>

<!--   Core JS Files   -->

<script src="<?=base_url()?>assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/sweetalert.js"></script>
<script src="<?=base_url()?>assets/js/material.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/js/jquery.validate.min.js"></script>
<script src="<?=base_url()?>assets/js/jquery.bootstrap-wizard.js"></script>
<script src="<?=base_url()?>assets/js/jasny-bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/js/material-dashboard.js"></script>
<script src="<?=base_url()?>assets/js/demo.js"></script>


<script type="text/javascript">
    /** Days to be disabled as an array */
    var disableddates = [<?=$output?>];
     
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

     $( "#datepicker" ).datepicker({
        beforeShowDay: DisableSpecificDates,
        minDate: 0,
        maxDate: "+365D",
        onSelect: function(selected) {
        $("#datepicker1").datepicker("option","minDate", selected)
        var date1 = document.getElementById('datepicker').value
        var date2 = document.getElementById('datepicker1').value

            var date_diff_indays = function(date1, date2) {
            dt1 = new Date(date1);
            dt2 = new Date(date2);
            return Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate()) ) /(1000 * 60 * 60 * 24));
            }
            var dateval = document.getElementById("ndays").value = date_diff_indays(date1, date2);
            if(dateval > 0){
                document.getElementById("ndays").value = date_diff_indays(date1, date2);

                var e = document.getElementById("totalamount");
                var txttotal = e.options[e.selectedIndex].value;
                var ndays = document.getElementById("ndays").value

                var total = txttotal * <?=$roomprice?> * ndays;


                document.getElementById("displaytotalamount").value = total;
            } else {
                document.getElementById("datepicker1").value = "";
                document.getElementById("ndays").value = 0;
                document.getElementById("displaytotalamount").value = 0;
            }
        }
    });
    $("#datepicker1").datepicker({
        beforeShowDay: DisableSpecificDates,
        minDate: 0,
        maxDate:"+365D",
        onSelect: function(selected) {
           $("#datepicker").datepicker("option", selected)
           var date1 = document.getElementById('datepicker').value
           var date2 = document.getElementById('datepicker1').value

            var date_diff_indays = function(date1, date2) {
            dt1 = new Date(date1);
            dt2 = new Date(date2);
            return Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate()) ) /(1000 * 60 * 60 * 24));
            }
            var dateval = document.getElementById("ndays").value = date_diff_indays(date1, date2);
            if(dateval > 0){
                document.getElementById("ndays").value = date_diff_indays(date1, date2);

                var e = document.getElementById("totalamount");
                var txttotal = e.options[e.selectedIndex].value;
                var ndays = document.getElementById("ndays").value

                var total = txttotal * <?=$roomprice?> * ndays;


                document.getElementById("displaytotalamount").value = total;
            } else {
                alert('Invalid Date Input');
                document.getElementById("datepicker1").value = "";
                document.getElementById("ndays").value = 0;
                document.getElementById("displaytotalamount").value = 0;
            }
        }
    }); 

    

    $("#totalamount").change(function() {
        var e = document.getElementById("totalamount");
        var txttotal = e.options[e.selectedIndex].value;
        var ndays = document.getElementById("ndays").value

        var total = txttotal * <?=$roomprice?> * ndays;


        document.getElementById("displaytotalamount").value = total;
    });

    $("#nguest").change(function() {
        var e = document.getElementById("nguest");
        var guest = e.options[e.selectedIndex].value;

        //var guest = document.getElementById('nguest').value
        if(guest == <?=$roomcapacity?>){
             $('#addguest').prop('disabled', false);
        } else {
            $('#addguest').prop('disabled', true);
        }
    });

    

    
</script>


<script type="text/javascript">
    $(document).ready(function() {
        demo.initMaterialWizard();
    });
</script>



<script type="text/javascript">
    $(document).ready(function(){
    $('#roomtype').change(function(e) {  
            var srch1 = $.trim($(this).val());
            var reserveid = <?=$roomreserveid?>

            
            if (srch1.length > 0 || srch1.length == 0) {
                 $.ajax({
                        type:'POST',
                        url:'<?php echo base_url(); ?>admin/reservation/replace.php',
                        data: {srch1: srch1, reserveid: reserveid},
                        success:function(data){
                            $('#replace').html(data);
                        }
                    });

                 $.ajax({
                        type:'POST',
                        url:'<?php echo base_url(); ?>admin/reservation/updatereplace2.php',
                        data: {srch1: srch1, reserveid: reserveid},
                        success:function(data){
                            $('#replace2').html(data);
                        }
                    });
                  
            } 
        });
     });
</script>


</html>
