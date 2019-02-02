                                    <?php
                                    include('../../dbnewcon.php');
                                    include('../../baseurl.php');
                                    include('../../func.php');

                                    $sql1 = "SELECT * FROM roomreserve,room WHERE CONCAT(Fname,' ',LName) like '%".$_POST['srch1']."%' AND roomreserve.roomid = room.roomid AND stat = 1 GROUP BY ID";
                                     $result1 = $con->query($sql1);
                                    while($row1=$result1->fetch_assoc()){
                                    $stat = $row1['Stat'];

                                    if($stat == 0){
                                        $lblstat = 'Pending';
                                    } elseif($stat == 1){
                                        $lblstat = 'Check-In';
                                    } elseif($stat == 2){
                                        $lblstat = 'Check-Out';
                                    } elseif($stat == 3){
                                        $lblstat = 'Reserved';
                                    }else {
                                        $lblstat = 'Unknown Error';
                                    }
                                    $addguestamnt = 800;
                                    echo "<tr>
                                    <td>".$row1['ID']."</td>
                                    <td>".$row1['FName']." ".$row1['LName']."</td>
                                    <td>".$row1['Email']."</td>
                                    <td align='center'><b>".$row1['roomtype']."</b></td>
                                    <td align='center'>".$row1['NRoom']."</td>
                                    <td align='center'>".($row1['NGuest'] + $row1['AGuest'])."</td>
                                    <td><b><center>".(($row1['paymenttype'] == 'full') ? "Full Payment":"Down Payment")."</center></b></td>
                                    <td>".formatdate1($row1['Cin'])."</td>
                                    <td>".formatdate1($row1['Cout'])."</td>
                                    <td><b>".$lblstat."</b></td>
                                    <td>
                                    <a data-toggle='modal' data-target='#payment".$row1['ID']."'><i class='fa fa-fw fa-money'></i></a>
                                    <a href='".base_url()."admin/print/printu.php?id=".$row1['ID']."' target='blank'><i class='fa fa-fw fa-print'></i></a>
                                    <a href='".base_url()."admin/reservation/updatereservation.php?doupdatereserve=".$row1['ID']."'><i class='fa fa-pencil-square-o'></i></a>
                                    <a href='".base_url()."admin/home.php?dodelete=".$row1['ID']."'><i class='fa fa-times'></i></a>
                                     </td>
                                    ";

                                    $sql333 = "SELECT * FROM roomreserve,discounts WHERE id = '".$row1['ID']."' AND roomreserve.did = discounts.did GROUP BY id";
                                    $query333 = mysql_query($sql333, $connection) or die ("Database Connection Failed");
                                    $result333 = mysql_fetch_assoc($query333);

                                    $discount = $result333['discountpercent'] * ($row1['NRoom'] * $row1['roomprice']);

                                    $roomamount = $row1['NRoom'] * $row1['roomprice'] * $row1['NoOfDays'];
                                    $guestamount = $addguestamnt * $row1['AGuest'] * $row1['NoOfDays'];

                                    $totalpayment = $roomamount + $guestamount - $discount;
                                    
                                    $totalpaymentvat = $totalpayment * 0.12 + $totalpayment;

                                    

                                    $sql3 = "SELECT sum(amount) as subtotal FROM payment WHERE reserveid = '".$row1['ID']."'";
                                    $query3 = mysql_query($sql3, $connection) or die ("Database Connection Failed");
                                    $result3 = mysql_fetch_assoc($query3);
                                    

                                        if(!empty($result3['subtotal'])){
                                            $balance = ($totalpaymentvat - $result3['subtotal']);
                                            $paidamount = $result3['subtotal'];
                                        } elseif(empty($result3['subtotal'])) {
                                            $balance = $totalpaymentvat;
                                            $paidamount = 0;
                                        } 

                                        ?>


                                    <td>
                                    <!-- PAYMENT HERE -->
                                    <div class="modal fade" id="payment<?=$row1['ID']?>" >
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title"><?=$row1['FName'].' '.$row1['LName']?></h4>
                                           
                                          </div>
                                          <form method="POST">
                                          <div class="modal-body">
                                            <div class="row">
                                                  <div class="col-md-12">
                                                    <h4>Billing</h4>
                                                    <table class="table table-bordered" style="font-size: 13px;">
                                                    <thead>
                                                    <tr>
                                                    <td>Billing ID</td>
                                                    <td><?=$row1['ID']?>
                                                    <input type="hidden" name="reserveid" value="<?=$row1['ID']?>">
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                    <td>Name</td>
                                                    <td><?=$row1['FName'].' '.$row1['LName']?></td>
                                                    </tr>
                                                    <tr>
                                                    <td>Total Amount</td>
                                                    <td><?=(($result333['did'] == 1) ? "(".formatnumber2($totalpaymentvat).") Discounted":"".formatnumber2($totalpaymentvat)."");?></td>
                                                    </tr>
                                                    <tr>
                                                    <td>Paid Amount</td>
                                                    <td><?=formatnumber2($paidamount);?></td>
                                                    </tr>
                                                    <tr>
                                                    <td>Balance</td>
                                                    <td><?=formatnumber2($balance);?></td>
                                                    </tr>
                                                    <tr>
                                                    <td>Payment Type</td>
                                                    <td><?=(($row1['paymenttype'] == 'full') ? "Full Payment":"Down Payment")?></td>
                                                    </tr>
                                                    <tr>
                                                    <td>Amount</td>
                                                    <td>
                                                    <?php
                                                    if($row1['paymenttype'] == 'full'){
                                                        echo '
                                                        <input type="hidden" name="amount" value="'.($balance).'">
                                                        <button type="submit" name="billing" class="btn btn-info pull-left">'.formatnumber2($balance).'</button>';
                                                    } else {
                                                        if(empty($result3['subtotal'])){
                                                        echo '
                                                            <input type="hidden" name="amount" value="'.($balance / 2).'">
                                                            <button type="submit" name="billing" class="btn btn-info pull-left">'.formatnumber2($balance / 2).'</button>';
                                                        } else {
                                                        echo '
                                                            <input type="hidden" name="amount" value="'.($balance).'">
                                                            <button type="submit" name="billing" class="btn btn-info pull-left">'.formatnumber2($balance).'</button>';
                                                        }
                                                    }
                                                    ?>    
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                    <td>Discount</td>
                                                    <td>

                                                        <table>
                                                        <tr>
                                                        <td><button type="submit" name="senior" class="btn btn-primary pull-left">0.20</button></td>
                                                        <td>&nbsp;</td>
                                                        </tr>   
                                                        </table>
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                    <td>Status</td>
                                                    <td>
                                                        <table>
                                                            <?php
                                                            if($stat == 0){
                                                                ?>
                                                                <tr>
                                                                <td><button type="submit" name="reserve" class="btn btn-primary pull-left">Reserved</button></td>
                                                                <td>&nbsp;</td>
                                                                <td><button type="submit" name="checkin" class="btn btn-success pull-left">Check In</button></td>
                                                                </tr>
                                                                <?php
                                                            } elseif($stat == 3){
                                                                ?>
                                                                <tr>
                                                                <td><button type="submit" name="checkin" class="btn btn-success pull-left">Check In</button></td>
                                                                </tr>
                                                                <?php
                                                            } elseif($stat == 1 ){
                                                                ?>
                                                                <td><button type="submit" name="checkout" class="btn btn-danger pull-left">Check Out</button></td>
                                                                <?php
                                                            }
                                                            ?>
                                                        </table>
                                                    </td>
                                                    </tr>
                                                    </thead>
                                                    </table>
                                                </div>

                                                </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                      </div>
                                      </form>
                                    </div>
                                    </td>
                                    </tr>
                                    <!-- END OF PAYMENT HERE -->

                                    <?php
                                    }
                                    ?>