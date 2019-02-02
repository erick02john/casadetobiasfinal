                                                        
<?php 
include('../../include.php');

$id = $_POST['srch1'];
 $sql = "SELECT * FROM room WHERE roomid = '".$id."'";
    $result = $con->query($sql);
        while($row=$result->fetch_assoc()){
            $sql1 = "SELECT sum(NRoom) as NRoomAvail FROM roomreserve WHERE roomid = '".$row['roomid']."'";
            $query = mysql_query($sql1, $connection) or die ("Database Connection Failed");
            $result1 = mysql_fetch_assoc($query);

            $roomtype = $row['roomtype'];
            $roomprice = $row['roomprice'];
            $roomcapacity = $row['roomcapacity'];
            $roomavailable = $row['roomavailable'] - $result1['NRoomAvail'];
            $additional = $row['additional'];
            $roomimg = $row['roomimg'];
          }

?>

                                            <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Check In:</label>
                                                            <div class="input-group date">
                                                              <div class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                              </div>
                                                              <input type="text" name="checkin" class="form-control pull-right" id="datepicker" autocomplete="off" required>
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
                                                              <input type="text" name="checkout" class="form-control pull-right" id="datepicker1" autocomplete="off" disabled required>
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
                                                            <input type="text" name="numdays" class="form-control" id="ndays" value="0" readonly>
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


                                                        <select name="totalamount" class="form-control" id="totalamount">
                                                            <?php
                                                            for ($x = 1; $x <= $roomavailable; $x++) {
                                                                echo "<option value='$x'>$x</option>";
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
                                                                echo "<option value='$x'>$x</option>";
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


                                                        <select name="addguest" class="form-control" id="addguest" disabled>
                                                            <option value="0" selected>0</option>
                                                            <?php
                                                            for ($x = 1; $x <= $additional; $x++) {
                                                                echo "<option value='$x'>$x</option>";
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
                                                            <input type="text" name="dtotalamount" class="form-control" id="displaytotalamount" value="0" readonly>
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
                                                            <option selected disabled></option>
                                                            <option value="Cash">Cash</option>
                                                            <option value="bankdep">Bank Deposit</option>
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
                                                            <option value="full">Full Payment</option>
                                                            <option value="half">Down Payment</option>
                                                        </select>
                                                        <span class="material-input"></span></div>
                                                    </div>
                                                </div>
                                            </div>

<?php
$id = $_POST['srch1'];
$sql5 = "SELECT * FROM roomreserve where roomid = '".$id."'";
$query5 = mysql_query($sql5, $connection) or die ("Database Connection Failed");
$result5 = mysql_fetch_assoc($query5);

$start = $result5['Cin'];
$end = $result5['Cout'];
$output = "";
foreach (datebetween($start,$end) as $val) {
    $output .= '"'.$val.'" ,';
}
?>
<script type="text/javascript">
$(document).ready(function(){

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

    $("#datepicker").datepicker({
        beforeShowDay: DisableSpecificDates,
        minDate: 0,
        maxDate: "+365D",
        onSelect: function(selected) {
        $("#datepicker1").datepicker("option","minDate", selected)
        $('#datepicker1').prop('disabled', false);
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

    

    
});
</script>
