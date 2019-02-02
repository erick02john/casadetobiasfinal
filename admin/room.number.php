<?php  
include ('../include.php');
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:index.php");
}
?> 
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrator    </title>
     <?php
    include ('tmpheader.php');
    ?>
    <!-- Select2 -->
    <link rel="stylesheet" href="<?=base_url()?>bower_components/select2/dist/css/select2.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/iCheck/all.css">
  <link rel="stylesheet" href="<?=base_url()?>css/sweetalert.css">
</head>
<style type="text/css">
    .modal-body{
        overflow-x: auto;
    }
</style>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php"><?php echo $_SESSION["fname"].' '.$_SESSION["lname"]; ?></a>
            </div>
        </nav>
        <!--/. NAV TOP  -->
        <?php
       include ('sidebar.php');
       ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Status <small>Room Number </small>
                        </h1>
                    </div>
                </div>
                <!-- /. ROW  -->
                <?php
                        $sql = "SELECT count(*) as cnt FROM room";
                        $query = mysqli_query($connection,$sql) or die ("Database Connection Failed");
                        $result = mysqli_fetch_assoc($query);
                        
                                    
                                    

                        
                ?>


                    <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            
                        </div>
                        <div class="panel-body">
                            <div class="panel-group" id="accordion">
                            
                            <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                        
                                             <button class="btn btn-default" type="button">
                                                 Rooms  <span class="badge"><?=$result['cnt']?></span>
                                            </button>
                                            <button type="button" style="float: right;" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                Add
              </button>
                                       
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse in" style="height: auto;">
                                        <div class="panel-body">
                                           <div class="panel panel-default">
                        
                        <div class="panel-body">
                                           
                            <div class="table-responsive">
                                <table class="table" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Room Type</th>
                                            <th>Room Price</th>
                                            <th>Room Capacity</th>
                                            <th>Room Available</th>
                                            <th>Additional</th>
                                            <th>Description</th>
                                            <th>Room Image</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    <?php
                                    $sql1 = "SELECT * FROM room";
                                     $result1 = $con->query($sql1);
                                    while($row1=$result1->fetch_assoc()){
                                 
                                    
                                    echo '<tr>
                                    <td>'.$row1['roomid'].'</td>
                                    <td>'.$row1['roomtype'].'</td>
                                    <td>'.$row1['roomprice'].'</td>
                                    <td>'.$row1['roomcapacity'].'</td>
                                    <td>'.$row1['roomavailable'].'</td>
                                    <td>'.$row1['additional'].'</td>
                                    <td>'.$row1['description'].'</td>
                                    <td>'.$row1['roomimg'].'</td>';
                                    
                                    echo "<td>
                                    <a data-toggle='modal' data-target='#modal".$row1['roomid']."'><i class='fa fa-pencil-square-o'></i></a> &nbsp;
                                    <a href='".base_url()."admin/room.number.php?deleteroom=".$row1['roomid']."'><i class='fa fa-fw fa-trash-o'></i></a>
                                    </td></tr>";
                                    
                                    echo '
                                    <div class="modal fade" id="modal'.$row1['roomid'].'">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Update Room</h4>
                                          </div>
                                          <div class="modal-body">
                                            <form method="POST">
                                            <div class="form-group label-floating">
                                            <label class="control-label">Room Type</label>
                                            <input type="hidden" name="roomid" value="'.$row1['roomid'].'">
                                            <input type="text" name="roomtype" value="'.$row1['roomtype'].'" class="form-control" placeholder="Room Type">
                                            </div>

                                            <div class="form-group label-floating">
                                            <label class="control-label">Room Price</label>
                                            <input type="text" name="roomprice" value="'.$row1['roomprice'].'" class="form-control" placeholder="Room Price">
                                            </div>

                                            <div class="form-group label-floating">
                                            <label class="control-label">Room Capacity</label>
                                            <input type="text" name="roomcapacity" value="'.$row1['roomcapacity'].'" class="form-control" placeholder="Room Capacity">
                                            </div>

                                            <div class="form-group label-floating">
                                            <label class="control-label">Room Available</label>
                                            <input type="text" name="roomavailable" value="'.$row1['roomavailable'].'" class="form-control" placeholder="Room Available">
                                            </div>

                                            <div class="form-group label-floating">
                                            <label class="control-label">Additional</label>
                                            <input type="text" name="additional" value="'.$row1['additional'].'" class="form-control" placeholder="Additional">
                                            </div>

                                            <div class="form-group label-floating">
                                            <label class="control-label">Decription</label>
                                            <textarea name="description" class="form-control">'.$row1['description'].'</textarea>
                                            </div>

                                            <div class="form-group label-floating">
                                            <label class="control-label">Room Image</label>
                                            <input type="text" name="roomimg" value="'.$row1['roomimg'].'" class="form-control" placeholder="Room Image">
                                            </div>
                                            
                                          </div>
                                          <div class="modal-footer">
                                            <button type="submit" name="updateroom" class="btn btn-primary">Update</button>
                                          </div>
                                        </div>
                                        </form>
                                      </div>
                                    </div>';
                                    }
                                    ?>
                                    
                                    </tbody>
                                </table>



                                
                            </div>
                        </div>
                    </div>

                    
                                
                                

                               
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
<!-- ADD MODAL HERE -->

             
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Room</h4>
              </div>
              <div class="modal-body">
                <form method="POST">
                <div class="form-group label-floating">
                <label class="control-label">Room Type</label>
                <input type="text" name="roomtype" class="form-control" placeholder="Room Type">
                </div>

                <div class="form-group label-floating">
                <label class="control-label">Room Price</label>
                <input type="text" name="roomprice" class="form-control" placeholder="Room Price">
                </div>

                <div class="form-group label-floating">
                <label class="control-label">Room Capacity</label>
                <input type="text" name="roomcapacity" class="form-control" placeholder="Room Capacity">
                </div>

                <div class="form-group label-floating">
                <label class="control-label">Room Available</label>
                <input type="text" name="roomavailable" class="form-control" placeholder="Room Available">
                </div>

                <div class="form-group label-floating">
                <label class="control-label">Additional</label>
                <input type="text" name="additional" class="form-control" placeholder="Additional">
                </div>

                <div class="form-group label-floating">
                <label class="control-label">Decription</label>
                <textarea name="description" class="form-control"></textarea>
                </div>

                <div class="form-group label-floating">
                <label class="control-label">Room Image</label>
                <input type="text" name="roomimg" class="form-control" placeholder="Room Image">
                </div>
                
              </div>
              <div class="modal-footer">
                <button type="submit" name="roominsert" class="btn btn-primary">Add</button>
              </div>
            </div>
            </form>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

                
                                        
                    

                <!-- /. ROW  -->
                
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="<?=base_url()?>assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>js/sweetalert.min.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    <!-- Select2 -->
    <script src="<?=base_url()?>bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="<?=base_url()?>plugins/iCheck/icheck.min.js"></script>
    <script type="text/javascript">
        //Initialize Select2 Elements
        $('.select2').select2();

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass   : 'iradio_minimal-blue'
        });
    </script>
</body>

</html>


<?php
    if (isset($_POST['roominsert'])) {
            $roomtype = $_POST['roomtype'];
            $roomprice = $_POST['roomprice'];
            $roomcapacity = $_POST['roomcapacity'];
            $roomavailable = $_POST['roomavailable'];
            $additional = $_POST['additional'];
            $description = $_POST['description'];
            $roomimg = $_POST['roomimg'];



         $data = array(
        'roomtype' => $roomtype,
        'roomprice' => $roomprice,
        'roomcapacity' => $roomcapacity,
        'roomavailable' => $roomavailable,
        'additional' => $additional,
        'description' => $description,
        'roomimg' => $roomimg,

      );

      
       doinsertroom($data);
    }


    if(isset($_POST['updateroom'])){
        $roomid = $_POST['roomid'];
        $roomtype = $_POST['roomtype'];
        $roomprice = $_POST['roomprice'];
        $roomcapacity = $_POST['roomcapacity'];
        $roomavailable = $_POST['roomavailable'];
        $additional = $_POST['additional'];
        $description = $_POST['description'];
        $roomimg = $_POST['roomimg'];



        $data = array(
            'roomtype' => $roomtype,
            'roomprice' => $roomprice,
            'roomcapacity' => $roomcapacity,
            'roomavailable' => $roomavailable,
            'additional' => $additional,
            'description' => $description,
            'roomimg' => $roomimg,
        );
        
        //var_dump($data);
        doupdateroom($roomid,$data);
    }



?>




<?php
    if(isset($_GET['roomdeletecancel'])){
        docanceldeleteroom($_GET['roomdeletecancel']);
    }

    if(isset($_GET['yesdeteleroom'])){
        dodeleteroom($_GET['yesdeteleroom']);
    }

    

    if(isset($_GET['deleteroom'])){
        ?>
        <script type="text/javascript">
                swal({
                  title: "Are you sure you want to delete this room?",
                  text: "",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                    //post('<?=base_url()?>func.php', {dodeleteroom: '<?=$row1['roomid']?>'});  // <<< This is what I added
                    window.location.href = "<?=base_url()?>admin/room.number.php?yesdeteleroom=<?=$_GET['deleteroom']?>";
                  } else {
                    window.location.href = "<?=base_url()?>admin/room.number.php?roomdeletecancel=0";
                  }
                });
                 
          </script>
        <?php
    }




?>