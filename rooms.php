
<?php
include('include.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>CASA DE TOBIAS MOUNTAIN RESORT</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Resort Inn Responsive , Smartphone Compatible web template , Samsung, LG, Sony Ericsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen">
<link href="css/easy-responsive-tabs.css" rel='stylesheet' type='text/css'/>
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
<link rel="stylesheet" href="css/jquery-ui.css" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/modernizr-2.6.2.min.js"></script>
<!--fonts-->
<link href="//fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Federo" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<!--//fonts-->
</head>
<body>
<!-- header -->
<?php
include('navlinks.php');
?>
<!-- //header -->
		<!-- banner -->
	<div id="home" class="w3ls-banner">
		<!-- banner-text -->
		<div class="slider">
			<div class="callbacks_container">
				<ul class="rslides callbacks callbacks1" id="slider4">
					<li>
						<div class="w3layouts-banner-top">

							<div class="container">
								<div class="agileits-banner-info">
									<h4>CASA DE TOBIAS MOUNTAIN RESORT</h4>
										<h3>Come join us to experience a relaxing place in Nagcarlan, Laguna</h3>
											<p>Welcome to our Hotel and Resort in Laguna</p>
									<div class="agileits_w3layouts_more menu__item">
				<a href="#" class="menu__link" data-toggle="modal" data-target="#myModal">Learn More</a>
			</div>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="w3layouts-banner-top w3layouts-banner-top1">
							<div class="container">
								<div class="agileits-banner-info">
									<h4>CASA DE TOBIAS MOUNTAIN RESORT</h4>
										<h3>Experience a wonderful scenery in our resort</h3>
											<p></p>
									<div class="agileits_w3layouts_more menu__item">
				<a href="#" class="menu__link" data-toggle="modal" data-target="#myModal">Learn More</a>
			</div>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="w3layouts-banner-top w3layouts-banner-top2">
							<div class="container">
								<div class="agileits-banner-info">
									<h4>CASA DE TOBIAS MOUNTAIN RESORT</h4>
										<h3></h3>
											<p>Get a Reservation Today!</p>
									<div class="agileits_w3layouts_more menu__item">
											<a href="#" class="menu__link" data-toggle="modal" data-target="#myModal">Learn More</a>
										</div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="clearfix"> </div>
			<!--banner Slider starts Here-->
		</div>
	</div>
	<!-- //banner -->
<!--//Header-->
<!-- //Modal1 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
						<!-- Modal1 -->
							<div class="modal-dialog">
							<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4>CASA DE TOBIAS  <span>RESORT</span></h4>
										<img src="images/1.jpg" alt=" " class="img-responsive">
										<h5>We know what you love</h5>
										<p>Providing guests unique and enchanting views from their rooms with its exceptional amenities, makes Buddha Hotel one of bests in its kind. Try our food menu, awesome services and friendly staff while you are here.</p>
									</div>
								</div>
							</div>
						</div>
<!-- //Modal1 -->
<div id="availability-agileits">


			<div class="clearfix"> </div>
</div>
<br />
	 <!-- rooms & rates -->
      <div class="plans-section" id="rooms">
				 <div class="container">
				 <h3 class="title-w3-agileits title-black-wthree">Rooms And Rates</h3>
						<div class="priceing-table-main">

				<?php



					$sql = "SELECT * FROM room";
					$result = $con->query($sql);

					while($row=$result->fetch_assoc()){

					$sql1 = "SELECT sum(NRoom) as NRoomAvail FROM roomreserve WHERE roomid = '".$row['roomid']."'";
					$query = mysqli_query($connection,$sql1) or die ("Database Connection Failed");
      				$result1 = mysqli_fetch_assoc($query);

					$roomleft = $row['roomavailable'] - $result1['NRoomAvail'];

					?>
						 <div class="col-md-3 price-grid">
							<div class="price-block agile">
								<div class="price-gd-top">
								<img src="<?=base_url().''.$row['roomimg']?>" alt=" " class="img-responsive" />
									<h4><?=$row['roomtype']?></h4>
								</div>
								<div class="price-gd-bottom">
									  <div class="price-list">
									<ul>
									<li>
										<?=$row['description']?>
										<br />
										Good For <?=$row['roomcapacity']?> Person <br />
										Room Capacity : Up to <?=($row['roomcapacity'] + $row['additional'])?><br />
										<?=(($row['roomavailable'] > $result1['NRoomAvail']) ? '
										<label style="color:green;">
										'.$roomleft.' Rooms left</label>':
										'<label style="color:red;">
										'.$roomleft.' Rooms left</label>')?></li>
								     </ul>
							</div>
									<div class="price-selet">
										<h3><span>₱</span><?=$row['roomprice']?></h3>
										<?=(($row['roomavailable'] > $result1['NRoomAvail']) ? '<a href="newreservation/step1.php?id='.$row['roomid'].'"><span style="color:green;">Book Now</span></a>':'<a style="cursor: no-drop;"><span style="color:red;">Not Available</span></a>')?>
									</div>
								</div>
							</div>
						</div>
					<?php
					}
				?>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	 <!--// rooms & rates -->
			<div class="copy">
		      <!--  <p>© 2018 . All Rights Reserved | Design by <a href="index.php">SUNRISE</a> </p>-->
		    </div>
<!--/footer -->
<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<!-- contact form -->
<script src="js/jqBootstrapValidation.js"></script>

<!-- /contact form -->
<!-- Calendar -->
		<script src="js/jquery-ui.js"></script>
		<script>
				$(function() {
				$( "#datepicker,#datepicker1,#datepicker2,#datepicker3" ).datepicker();
				});
		</script>
<!-- //Calendar -->
<!-- gallery popup -->
<link rel="stylesheet" href="css/swipebox.css">
				<script src="js/jquery.swipebox.min.js"></script>
					<script type="text/javascript">
						jQuery(function($) {
							$(".swipebox").swipebox();
						});
					</script>
<!-- //gallery popup -->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
<!-- flexSlider -->
				<script defer src="js/jquery.flexslider.js"></script>
				<script type="text/javascript">
				$(window).load(function(){
				  $('.flexslider').flexslider({
					animation: "slide",
					start: function(slider){
					  $('body').removeClass('loading');
					}
				  });
				});
			  </script>
			<!-- //flexSlider -->
<script src="js/responsiveslides.min.js"></script>
			<script>
						// You can also use "$(window).load(function() {"
						$(function () {
						  // Slideshow 4
						  $("#slider4").responsiveSlides({
							auto: true,
							pager:true,
							nav:false,
							speed: 500,
							namespace: "callbacks",
							before: function () {
							  $('.events').append("<li>before event fired.</li>");
							},
							after: function () {
							  $('.events').append("<li>after event fired.</li>");
							}
						  });

						});
			</script>
		<!--search-bar-->
		<script src="js/main.js"></script>
<!--//search-bar-->
<!--tabs-->
<script src="js/easy-responsive-tabs.js"></script>
<script>
$(document).ready(function () {
$('#horizontalTab').easyResponsiveTabs({
type: 'default', //Types: default, vertical, accordion
width: 'auto', //auto or any width like 600px
fit: true,   // 100% fit in a container
closed: 'accordion', // Start closed if in accordion view
activate: function(event) { // Callback function if tab is switched
var $tab = $(this);
var $info = $('#tabInfo');
var $name = $('span', $info);
$name.text($tab.text());
$info.show();
}
});
$('#verticalTab').easyResponsiveTabs({
type: 'vertical',
width: 'auto',
fit: true
});
});
</script>
<!--//tabs-->
<!-- smooth scrolling -->
	<!-- <script type="text/javascript">
		$(document).ready(function() {
		/*
			var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear'
			};
		*/
		$().UItoTop({ easingType: 'easeOutQuart' });
		});
	</script> -->

	<div class="arr-w3ls">
	<a href="#home" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	</div>
<!-- //smooth scrolling -->
<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<div class="gradient">
		<div class="homepage globalpage_new page"></div>
		<div class="row">
			<div class="col-lg-6 col-md-3 m-5">
				<div class="footer-block">
					<h3 class="footer-block-title"><p>Site</p></h3>
					<div class="row">
						<div class="col-md-12 col-lg-6 m-5">
							<ul class="list-unstyled">
								<li>
									<a href="/" target="_self">Home</a>
								</li>
								<li>
									<a href="/about" target="_self">The Resort</a>
								</li>
								<li>
									<a href="/gallery" target="_self">Gallery</a>
								</li>
								<li>
									<a href="/contact" target="_self">Contact Us</a>
								</li>
								<li>
									<a href="/Rooms" target="_self">Rooms</a>
								</li>
								<li class="list-inline-item">
									<a href="/privacy-policy.html">Privacy Policy</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-4">
				<div class="footer-block">
					<h3 class="footer-block-title"><p>RESERVATION</p></h3>
					<ul class="list-unstyled">
						<li><a class="icon-link icon-link-mobile" href="tel:+6566888888">(02) 794 3471
						</a></li>
						<li><a class="icon-link icon-link-mobile" href="tel:+6566888826">+63 917 9789 141</a></li>
					</ul>

				</div>
			</div>
		</div>
	<div class="row">
		<div class="col"><br>
				<p class="copyright">© 2019 Casa de Tobias Mountain Resort. All Rights Reserved.</p>
				</div>
			</div>
		</div>
	</div>


</body>
</html>
