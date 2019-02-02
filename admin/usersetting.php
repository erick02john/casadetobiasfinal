<?php
session_start();
if(!isset($_SESSION["user"]))
{
 header("location:index.php");
}

ob_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title>
	  <?php
    include ('tmpheader.php');
    ?>
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>
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

        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                           ADMINISTRATOR<small> accounts </small>
                        </h1>
                    </div>
                </div>


            <?php
						include ('db.php');
						$sql = "SELECT * FROM `login` WHERE archive = 0";
						$re = mysqli_query($con,$sql)
				?>

            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>First name</th>
                                            <th>Last name</th>
											<th>User name</th>
											<th>User Type</th>
											<th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

									<?php
										while($row = mysqli_fetch_array($re))
										{

											$id = $row['id'];
                                            $fname = $row['FName'];
                                            $lname = $row['LName'];
											$us = $row['usname'];
											$ps = $row['pass'];
                                            $utn = $row['usertype'];
                                            $ut = (($row['usertype'] == 1) ? "Admininstrator":"Employee");

												echo"<tr class='gradeC'>
													<td>".$id."</td>
                                                    <td>".$fname."</td>
                                                    <td>".$lname."</td>
													<td>".$us."</td>
                                                    <td>".$ut."</td>

													<td>
                                                    <button class='btn btn-primary btn' data-toggle='modal' data-target='#myModal".$id."'>Update
													</button>
                                                    <a href=usersettingdel.php?eid=".$id ." <button class='btn btn-danger'> <i class='fa fa-fw fa-archive'></i> Archive</button></td>
												</tr>";

										?>
                            <div class="panel-body">

                            <div class="modal fade" id="myModal<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Change the User name and Password</h4>
                                        </div>
                                        <form method="post">
                                        <div class="modal-body">

                                            <div class="form-group">
                                            <label>Change First name</label>
                                            <input name="fname" value="<?php echo $fname; ?>" class="form-control" placeholder="Enter First name">
                                            <input type="hidden" name="id" value="<?php echo $id; ?>" class="form-control" placeholder="Enter First name">
                                            </div>

                                            <div class="form-group">
                                            <label>Change Last name</label>
                                            <input name="lname" value="<?php echo $lname; ?>" class="form-control" placeholder="Enter Last name">
                                            </div>

                                            <div class="form-group">
                                            <label>Change User name</label>
                                            <input name="usname" value="<?php echo $us; ?>" class="form-control" placeholder="Enter User name">
                                            </div>

                                            <div class="form-group">
                                            <label>Change Password</label>
                                            <input type="password" name="pasd" value="<?php echo $ps; ?>" class="form-control" placeholder="Enter Password">
                                            </div>

                                            <div class="form-group">
                                            <label>User Type</label>
                                            <select name="usrtp" class="form-control">
                                                <option disabled></option>
                                                <option value="1" <?php if($utn == 1) { echo 'selected'; } ?>>Administrator</option>
                                                <option value="2" <?php if($utn == 2) { echo 'selected'; } ?>>Employee</option>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                           <input type="submit" name="up" value="Update" class="btn btn-primary">
                                          </form>

                                        </div>
                                    </div>
                                </div>
                            </div>



                                        <?php

										}

									?>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <!--End Advanced Tables -->
					<div class="panel-body">
                            <button class="btn btn-primary btn" data-toggle="modal" data-target="#myModal">
															Add Account
													</button>
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Add the User name and Password</h4>
                                        </div>
										<form method="post">
                                        <div class="modal-body">
                                            <div class="form-group">
                                            <label>First Name</label>
                                            <input name="newfname"  class="form-control" placeholder="Enter First Name">
                                            </div>
                                            <div class="form-group">
                                            <label>Last Name</label>
                                            <input name="newlname"  class="form-control" placeholder="Enter Last Name">
                                            </div>
                                            <div class="form-group">
                                            <label>Add new User name</label>
                                            <input name="newus"  class="form-control" placeholder="Enter User name">
											</div>
                                            <div class="form-group">
                                            <label>New Password</label>
                                            <input type="password" name="newps"  class="form-control" placeholder="Enter Password">
											</div>
                                            <div class="form-group">
                                            <label>User Type</label>
                                            <select name="newut" class="form-control">
                                                <option disabled></option>
                                                <option value="1">Administrator</option>
                                                <option value="2">Employee</option>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                           <input type="submit" name="in" value="Add" class="btn btn-primary">
										  </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<?php
						if(isset($_POST['in']))
						{
							$newus = $_POST['newus'];
							$newps = $_POST['newps'];
                            $newut = $_POST['newut'];
                            $newfname = $_POST['newfname'];
                            $newlname = $_POST['newlname'];

							$newsql ="Insert into login (usname,pass,usertype,FName,LName) values ('$newus','$newps','$newut','$newfname','$newlname')";
							if(mysqli_query($con,$newsql))
							{
							echo' <script language="javascript" type="text/javascript"> alert("User name and password Added") </script>';


							}
						header("Location: usersetting.php");
						}
						?>


                        </div>
                </div>
            </div>


                     <!-- /. ROW  -->
                <?php
                if(isset($_POST['up']))
                {
                    $id = $_POST['id'];
                    $fname = $_POST['fname'];
                    $lname = $_POST['lname'];
                    $usname = $_POST['usname'];
                    $passwr = $_POST['pasd'];
                    $usertype = $_POST['usrtp'];

                    $upsql = "UPDATE `login` SET `FName`='$fname',`LName`='$lname',`usname`='$usname',`pass`='$passwr',`UserType`='$usertype' WHERE id = '$id'";
                    if(mysqli_query($con,$upsql))
                    {
                    echo' <script language="javascript" type="text/javascript"> alert("User name and password update") </script>';


                    }

                header("Location: usersetting.php");

                }
                ob_end_flush();




                ?>

			 <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>


</body>
</html>
