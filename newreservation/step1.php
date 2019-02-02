<?php
include('../include.php');

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CASA DE TOBIAS MOUNTAIN RESORT</title>
  <!-- Tell the browser to be responsive to screen width -->
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
        <div class="col-md-2"></div>
        <div class="col-md-8 .offset-md-2">
          <div class="box box-primary">
            <div class="box-header with-border"><center>
              <h1 class="box-title">Reservation Date</h1></center>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

              <div class="box-body">
                <form action="step2.php">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="date">Date From</label>
                      <input type="text" name="dtefrom" class="form-control" id="datepicker" autocomplete="off" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="date">Date to</label>
                      <input type="text" name="dteto" class="form-control" id="datepicker1" autocomplete="off" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="date">Number of Days</label>
                      <input type="text" class="form-control" name="ndays" id="ndays" style="text-align: center; width: 30%;" readonly>
                    </div>
                </div>
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
<!-- jQuery 3 -->
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>dist/js/demo.js"></script>
</body>
</html>

<script type="text/javascript">
  $( "#datepicker" ).datepicker({
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
                var ndays = document.getElementById("ndays").value
            } else {
                document.getElementById("datepicker1").value = "";
                document.getElementById("ndays").value = 0;
            }
        }
    });
    $("#datepicker1").datepicker({
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

                var ndays = document.getElementById("ndays").value
            } else {
                alert('Invalid Date Input');
                document.getElementById("datepicker1").value = "";
                document.getElementById("ndays").value = 0;
            }
        }
    });
</script>
