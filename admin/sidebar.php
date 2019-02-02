 <?php
include ('../baseurl.php');
$type = $_SESSION["usertype"];
 ?>

<?php
$base = 'http://'.$_SERVER['SERVER_NAME'].''.$_SERVER['REQUEST_URI'];
?>

 <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">




					<li>
                        <a <?=(($base == ''.base_url().'admin/home.php') ? 'class="active-menu"':'')?>  href="roombook.php"><i class="fa fa-bar-chart-o"></i> Room Booking</a>
                    </li>

					<li>
                        <a  <?=(($base == ''.base_url().'admin/newreservation/step1.php') ? 'class="active-menu"':'')?> href="<?=base_url()?>newreservation/step1.php"><i class="fa fa-bar-chart-o"></i> Reservation</a>
                    </li>
					<?php
                    if($type == 1){
                        ?>
                        <li>
                            <a  <?=(($base == ''.base_url().'admin/report.php') ? 'class="active-menu"':'')?> href="report.php"><i class="fa fa-qrcode"></i> Report</a>
                        </li>
                        <?php
                    } else {

                    }
                    ?>

                    <li>
                        <a <?=(($base == ''.base_url().'admin/room.number.php') ? 'class="active-menu"':'')?> href="room.number.php"><i class="fa fa-qrcode"></i> Room</a>
                    </li>
                    <?php
                    if($type == 1){
                        ?>
                        <li>
                            <a <?=(($base == ''.base_url().'admin/usersetting.php') ? 'class="active-menu"':'')?> href="usersetting.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <?php
                    } else {

                    }
                    ?>

                    <li>
                        <a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>




					</ul>

            </div>

        </nav>
