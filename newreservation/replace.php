<?php
include('../include.php');
$id = $_POST['srch1'];
$dte1 = $_POST['dte1'];
$dte2 = $_POST['dte2'];
$sql = "SELECT * FROM room WHERE roomid = '".$id."'";
    $result = $con->query($sql);
        while($row=$result->fetch_assoc()){
            $sql1 = "
                            SELECT room.roomid,
                                  room.roomtype,
                                  room.roomprice,
                                  room.roomcapacity,
                                  room.roomavailable,
                                  COUNT(roomreserve.roomid) AS cntres
                            FROM
                                room
                            LEFT JOIN roomreserve
                                ON (room.roomid = roomreserve.roomid)
                                    AND (Cin <= '".formatdate3($dte1)."' AND Cout >= '".formatdate3($dte2)."')
                            GROUP BY 
                                room.roomid";
                            $query = mysqli_query($connection,$sql1) or die ("Database Connection Failed");
                            $result1 = mysqli_fetch_assoc($query);
             
            $roomtype = $row['roomtype'];
            $roomprice = $row['roomprice'];
            $roomcapacity = $row['roomcapacity'];
            $roomavailable = $row['roomavailable'] - $result1['cntres'];
            $additional = $row['additional'];
            $roomimg = $row['roomimg'];
          }
?>                  
                  <div style="font-size: 18px;">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="image">Room Image</label><br />
                      <a href="<?=base_url().''.$roomimg?>" data-lightbox='example-1'><img src="<?=base_url().''.$roomimg?>" width='250px'></a>
                      <input type="hidden" name="roomtype" class="form-control" id="roomtype" value="<?=$roomtype;?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="roomprice">Room Price :</label>
                      <label for="roomprice">₱ <?=formatnumber2($roomprice);?></label>
                      <input type="hidden" name="roomprice" class="form-control" id="roomprice" value="<?=$roomprice;?>">
                    </div>

                    <div class="form-group">
                      <label for="roomcapacity">Room Capacity :</label>
                      <label for="roomcap"><?=$roomcapacity;?></label>
                      <input type="hidden" name="roomcapacity" class="form-control" id="roomcapacity" value="<?=$roomcapacity;?>">
                    </div>

                    <div class="form-group">
                      <label for="roomadditional">Additional Guest :</label>
                      <label for="roomcap"><?=$additional;?></label>
                      <input type="hidden" name="additional" class="form-control" id="additional" value="<?=$additional;?>">
                    </div>

                    <div class="form-group">
                      <label for="roomadditional">Room Available :</label>
                      <label for="roomcap"><?=$roomavailable;?></label>
                      <input type="hidden" name="roomavailable" class="form-control" id="roomavailable" value="<?=$roomavailable;?>">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group" style="text-align: right;">
                        <button class="btn btn-info">Next</button>
                    </div>
                  </div>
                  
                </div>