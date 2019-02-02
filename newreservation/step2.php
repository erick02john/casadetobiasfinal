<?php
include('../include.php');

if(!$_GET){
  redirect(base_url().'newreservation/step1.php');
} else {

}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CASA DE TOBIAS MOUNTAIN RESORT</title>
  <!-- Tell the browser to be responsive to screen width -->
    <!-- Select2 -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/select2/dist/css/select2.min.css">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url()?>dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui-1.12.1.css">
  <!-- Lightbox style -->
  <link rel="stylesheet" href="<?=base_url()?>Library/lightbox/css/lightbox.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <div class="row"><br /><br />
        <div class="col-md-3"></div>
        <div class="col-md-6 .offset-md-3">
          <div class="box box-primary">
            <div class="box-header with-border"><center>
              <h1 class="box-title">Room Information</h1></center>
            </div>
              <div class="box-body">
                <form action="step3.php">
                <!-- hidden keylangan ang mga value -->
                <input type="hidden" name="dtefrom" value="<?=$_GET['dtefrom']?>">
                <input type="hidden" name="dteto" value="<?=$_GET['dteto']?>">
                <input type="hidden" name="ndays" value="<?=$_GET['ndays']?>">
                <div class="form-group">
                  <select name="roomid" id="roomtype" class="form-control select2">
                    <option value=""></option>
                    <?php
                    $sql = "SELECT * FROM room";
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
                                    AND (Cin <= '".formatdate3($_GET['dtefrom'])."' AND Cout >= '".formatdate3($_GET['dteto'])."')
                            GROUP BY
                                room.roomid";
                            $query = mysqli_query($connection,$sql1) or die ("Database Connection Failed");
                            $result1 = mysqli_fetch_assoc($query);

                            $roomid = $row['roomid'];
                            $roomtype = $row['roomtype'];
                            $roomprice = $row['roomprice'];
                            $roomcapacity = $row['roomcapacity'];
                            $roomavailable = $row['roomavailable'] - $result1['cntres'];
                            $additional = $row['additional'];
                            $roomimg = $row['roomimg'];
                            ?>
                            <option value="<?=$roomid;?>" <?=(($roomavailable > 0) ? "":"disabled")?>><?=$roomtype;?></option>
                        <?php
                        }
                    ?>
                  </select>
                  <p class="help-block">Please Select a Room First. </p>
                </div>
                <hr />
                <div id="replace">
                  <div style="font-size: 18px;">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="image">Room Image</label><br />
                        <a href="<?=base_url()?>/images/noimg.png" data-lightbox='example-1'><img src="<?=base_url()?>/images/noimg.png" width='250px'></a>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="roomprice">Room Price</label>
                      </div>

                      <div class="form-group">
                        <label for="roomcapacity">Room Capacity</label>
                      </div>

                      <div class="form-group">
                        <label for="roomadditional">Additional Guest</label>
                      </div>

                      <div class="form-group">
                        <label for="roomadditional">Room Available</label>
                      </div>
                    </div>
                  </div>
                </div>
                </form>
              </div>
          </div>
        </div>

      </div>
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->
<script src="<?=base_url()?>assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/js/jquery-ui.min.js" type="text/javascript"></script>
<!-- Select2 -->
<script src="<?=base_url()?>bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- jQuery 3 -->
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Lightbox style -->
<script src="<?=base_url()?>Library/lightbox/js/lightbox-2.6.min.js"></script>
<!-- Lightbox style -->
<script src="<?=base_url()?>Library/lightbox/js/modernizr.custom.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>dist/js/demo.js"></script>
</body>
</html>
<script type="text/javascript">
  $('.select2').select2({
    placeholder: "Select a Room",
    allowClear: true
  })
</script>
<?php
?>


<script type="text/javascript">
    $(document).ready(function(){
    $('#roomtype').change(function(e) {
            var srch1 = $.trim($(this).val());
            var dte1 = <?=$_GET['dtefrom']?>;
            var dte2 = <?=$_GET['dteto']?>;

            if (srch1.length > 0 || srch1.length == 0) {
                 $.ajax({
                        type:'POST',
                        url:'<?php echo base_url(); ?>newreservation/replace.php',
                        data: {srch1: srch1, dte1 : dte1 , dte2 : dte2},
                        success:function(data){
                            $('#replace').html(data);
                        }
                    });

            }
        });
     });
</script>
