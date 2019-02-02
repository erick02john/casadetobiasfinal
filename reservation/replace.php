                                                        
<?php 
include('../include.php');

$id = $_POST['srch1'];
   $sql = "SELECT * FROM room WHERE roomid = '".$id."' LIMIT 1";
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

                                            <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">label_important</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Room Price</label>
                                                                <label class="label" style="color: black;"><span>₱</span><?=formatnumber2($roomprice)?></label>
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