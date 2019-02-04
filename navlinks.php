 <?php
include ('baseurl.php');
 ?>

<?php
$base = 'http://'.$_SERVER['SERVER_NAME'].''.$_SERVER['REQUEST_URI'];
?>

<!-- header -->

			<div class="clearfix"></div>
		</div>
	<div class="w3_navigation">
		<div class="container">
			<nav class="navbar navbar-default">
				<div class="navbar-header navbar-left">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<h1><a class="navbar-brand" href="index.php">Casa de <span>Tobias</span><p class="logo_w3l_agile_caption">Mountain Resort</p></a></h1>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
					<nav class="menu menu--iris">
						<ul class="nav navbar-nav menu__list">
							<li <?=(($base == ''.base_url().'index.php' || $base == base_url()) ? 'class="menu__item menu__item--current"':"class='menu__item'")?>><a href="index.php" class="menu__link">Home</a></li>
							<li <?=(($base == ''.base_url().'about.php') ? 'class="menu__item menu__item--current"':"class='menu__item'")?>><a href="about.php" class="menu__link">About</a></li>
							<!--<li class="menu__item"><a href="#team" class="menu__link scroll">Team</a></li> -->
							<li <?=(($base == ''.base_url().'gallery.php') ? 'class="menu__item menu__item--current"':"class='menu__item'")?>><a href="gallery.php" class="menu__link">Gallery</a></li>
							<li <?=(($base == ''.base_url().'rooms.php') ? 'class="menu__item menu__item--current"':"class='menu__item'")?>><a href="rooms.php" class="menu__link">Rooms</a></li>
							<li <?=(($base == ''.base_url().'contactus.php') ? 'class="menu__item menu__item--current"':"class='menu__item'")?>><a href="contactus.php" class="menu__link">Contact Us</a></li>
              <li <?=(($base == ''.base_url().'contactus.php') ? 'class="menu__item menu__item--current"':"class='menu__item'")?>><a href="newreservation/step1.php" class="menu__link">Book Now</a></li>
						</ul>
					</nav>
				</div>
			</nav>

		</div>
	</div>
<!-- //header -->
