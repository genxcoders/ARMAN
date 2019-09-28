<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Free Web tutorials">
		<meta name="keywords" content="HTML,CSS,XML,JavaScript">
		<meta name="author" content="John Doe">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>DMA: Page Title</title>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../../assets/css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="../../assets/css/gxcpl-dma.css">
		<!-- CSS -->
	</head>
	<body>

		<!-- Site Container -->
		<div class="gxcpl-site-container">
			
			<!-- Navbar -->
			<div id="gxcpl" class="navbar navbar-default navbar-fixed-top gxcpl-shadow-2" role="navigation">
			    <div class="container-fluid">
			        <div class="navbar-header">
			        	<a class="navbar-brand gxcpl-fw-700" href="#!">
				        	<!-- <img src="assets/images/Railway.png" style="display: inline-block; width: 45px;" />  -->
				        	CR-ODRMA
				        </a>
			            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder">
			            	<span class="sr-only">Toggle navigation</span>
			            	<span class="icon-bar"></span>
			            	<span class="icon-bar"></span>
			            	<span class="icon-bar"></span>
			            </button>
			        </div>
			        <div class="collapse navbar-collapse navbar-menubuilder">
			            <ul class="nav navbar-nav navbar-right gxcpl-fw-700">
			                <li>
			                	<a href="#!">Dashboard</a>
			                </li>
			                <li class="dropdown active">
			                	<a href="#!" class="dropdown-toggle" data-toggle="dropdown">
			                		SOS <b class="caret"></b>
			                	</a>
			                    <ul class="dropdown-menu" role="menu">
			                        <li>
			                        	<a href="#!">Generate SOS</a>
			                        </li>
			                        <li>
			                        	<a href="#!">List SOS</a>
			                        </li>
			                    </ul>
			                </li>
			                <li class="dropdown">
			                	<a href="#!" class="dropdown-toggle" data-toggle="dropdown">
			                		Dropdown <b class="caret"></b>
			                	</a>
			                    <ul class="dropdown-menu" role="menu">
			                        <li>
			                        	<a href="#!">Submenu 1</a>
			                        </li>
			                        <li>
			                        	<a href="#!">Submenu 2</a>
			                        </li>
			                    </ul>
			                </li>
			                <li class="dropdown">
			                	<a href="#!" class="dropdown-toggle" data-toggle="dropdown">
			                		Username <b class="caret"></b>
			                	</a>
			                    <ul class="dropdown-menu" role="menu">
			                        <li>
			                        	<a href="#!">Profile</a>
			                        </li>
			                        <li>
			                        	<a href="#!">Logout</a>
			                        </li>
			                    </ul>
			                </li>
			            </ul>
			        </div>
			    </div>
			</div>
			<!-- Navbar -->

			<!-- Site Title -->
			<div class="container">
				<div class="row hidden-sm hidden-xs">
					<div class="col-md-2 col-sm-12 col-xs-12" >
						<img src="../../assets/images/Railway.png" style="margin: auto; display: block; width: 100px;" />
					</div>
					<div class="col-md-10 col-sm-12 col-xs-12">
						<h1 class="text-center gxcpl-fw-500 gxcpl-no-margin">
							<small>Central Railways'</small>
							<div class="gxcpl-ptop-5"></div>
							Official Disaster Reporting and Management Application
						</h1>
					</div>
				</div>
			</div>
			<!-- Site Title -->

			<!-- Generate Sos -->
			<div class="container">
				<div class="row">
					<div class="gxcpl-ptop-30"></div>

					<!-- Section Title -->
					<div class="col-md-12">
						<h4 class="gxcpl-no-margin">
							SEND SOS
							<div class="gxcpl-ptop-10"></div>
							<div class="gxcpl-divider-dark"></div>
							<div class="gxcpl-ptop-20"></div>
						</h4>
					</div>
					<!-- Section Title -->

					<!-- Section Divider -->
					<div class="gxcpl-ptop-10"></div>
					<!-- <div class="gxcpl-divider-dark"></div> -->
					<div class="gxcpl-ptop-10"></div>
					<!-- Section Divider -->

					<form method="post">

						<div class="col-md-12">
							<div class="gxcpl-br-2 gxcpl-shadow-2 gxcpl-bg-white">
								<div class="gxcpl-padding-15">

									<div class="row">
										<!-- FIR Title -->
										<div class="col-md-12">
											<label>SOS Title</label>
											<div class="gxcpl-ptop-5"></div>
											<input class="gxcpl-input-text" name="sos_title" />
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- FIR Title -->

										<!-- Train No. -->
										<div class="col-md-6">
											<label>Train No.</label>
											<div class="gxcpl-ptop-5"></div>
											<input class="gxcpl-input-text" name="train_no" />
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- Train No. -->

										<!-- Loco No. -->
										<div class="col-md-6">
											<label>Loco No.</label>
											<div class="gxcpl-ptop-5"></div>
											<input class="gxcpl-input-text" name="loco_no" />
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- Loco No. -->

										<!-- Date -->
										<div class="col-md-6">
											<label>Date</label>
											<div class="gxcpl-ptop-5"></div>
											<input class="gxcpl-input-text" name="date" />
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- Date -->

										<!-- Time -->
										<div class="col-md-6">
											<label>Time</label>
											<div class="gxcpl-ptop-5"></div>
											<input class="gxcpl-input-text" name="time" />
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- Time -->

										<!-- Description of Accident -->
										<div class="col-md-12">
											<label>Description of Accident</label>
											<div class="gxcpl-ptop-5"></div>
											<textarea class="gxcpl-input-text" name="informer_mobile" ></textarea>
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- Description of Accident -->

										<!-- Registration Id -->
										<div class="col-md-12">
											<label>Registration Id</label>
											<div class="gxcpl-ptop-5"></div>
											<textarea class="gxcpl-input-text" name="informer_mobile" ></textarea>
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- Registration Id -->

										<!-- Location Name -->
										<div class="col-md-6">
											<label>Location</label>
											<div class="gxcpl-ptop-5"></div>
											<input class="gxcpl-input-text" name="time" />
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- Location Name -->

										<!-- Map -->
										<div class="col-md-6">
											<div class="row">
												<div class="gxcpl-ptop-10"></div>
												<div class="col-md-6">
													Latitude: <input class="gxcpl-input-text" type='text' name='lat' id='lat'>
													<div class="gxcpl-ptop-10"></div>
												</div>
												<div class="col-md-6">
													Longitude: <input class="gxcpl-input-text" type='text' name='lng' id='lng'> 
													<div class="gxcpl-ptop-10"></div>
												</div>
												<!-- <div id="googleMap" class="gxcpl-br-2 gxcpl-shadow-2" style="width: 90%; height: 210px; margin: auto; display: block; "></div> -->
											</div>
										</div>
										<!-- Map -->

										
									</div>
								</div>

								<div class="gxcpl-ptop-10"></div>
								<div class="gxcpl-divider-dark"></div>
								<div class="gxcpl-ptop-10"></div>

								<div class="row">
									<div class="col-md-12">
										<center>
											<div class="btn btn-danger btn-sm gxcpl-fw-700">
												<i class="fa fa-send"></i> SEND
											</div>
										</center>
										<div class="gxcpl-ptop-10"></div>
									</div>
								</div>

							</div>

						</div>

					</form>

				</div>
				<div class="gxcpl-ptop-20"></div>
			</div>
			<!-- Generate Sos -->

			<!-- Notification -->
			<div class="gxcpl-notify-container">
				<a href="#" class="gxcpl-fc-white">
					<div class="gxcpl-notify gxcpl-shadow-2">
						<i class="fa fa-bell fa-lg"></i>
						<span class="badge gxcpl-badge">0</span> 
					</div>
				</a>
			</div>
			<!-- Notification -->

		</div>
		<!-- Site Container -->

		<footer class="gxcpl-width-100 gxcpl-fc-white text-center">
			<small>&copy; Central Railway | <a class="gxcpl-fc-white" href="https://www.gxcpl.com/">Powered by GXCPL</a></small>
		</footer>

		<!-- Scripts -->
		<script type="text/javascript" src="../../assets/js/jquery-1.11.1.js"></script>
		<script type="text/javascript" src="../../assets/js/bootstrap.js"></script>
		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false"></script>
		<!-- Scripts -->
	</body>
</html>