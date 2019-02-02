<?php  
include ('../include.php');
?>


<?php include ('tmpheader.php'); ?>


                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Room Type</th>
                                            <th>Rooms</th>
                                            <th>Guest</th>
                                            <th>Payment Type</th>
                                            <th>Check In</th>
                                            <th>Check Out</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    <?php
                                    $strval = "";
                                    $sql1 = "SELECT * FROM roomreserve,room WHERE roomreserve.roomid = room.roomid AND stat = 0 OR stat = 3 GROUP BY ID";
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
                                    $strval = "<tr>
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
                                    
                                    $strval .= "<td><table></table></td>";



                                    echo $strval;
                                    }
                                    
                                    ?>
                                    <!-- END OF PAYMENT HERE -->

                                    </tbody>
                                </table>


<?php include ('tmpfooter.php'); ?>
 <script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : false
    })
  })
</script>