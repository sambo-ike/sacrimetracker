 <?php
 
 session_start();
   $_SESSION['x']="";
   $_SESSION['y']="";
 
 
 ?>


<!--===============================================THIS IS HTML=========================================================-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
    SA CRIME TRACKING
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  <link type="text/css" rel="stylesheet" href="loader/dist/jquery.loading-indicator.css" />
  <style>
     .chart-area input{
	    width:100%;
		height:100px;
	 }
  
  </style>
  <!--========================================SKELENTON LODER STYLES============================================-->
 	<style>

		/* Card styles */
		.card_shad{
			background-color: #fff;
			height: auto;
			width: auto;
			overflow: hidden;
			margin: 12px;
			border-radius: 5px;
			box-shadow: 9px 17px 45px -29px
						rgba(0, 0, 0, 0.44);

		}
	
		/* Card image loading */
		.card__image img {
			width: 100%;
			height: 100%;
		}
		
		.card__image.loading {
			height: 300px;
			width: 400px;
		}
	
		/* Card title */
		.card__title {
			padding: 8px;
			font-size: 22px;
			font-weight: 700;
		}
		
		.card__title.loading {
			height: 1rem;
			width: 50%;
			margin: 1rem;
			border-radius: 3px;
		}
	
		/* Card description */
		.card__description {
			padding: 8px;
			font-size: 16px;
		}
		
		.card__description.loading {
			height: 3rem;
			margin: 1rem;
			border-radius: 3px;
		}
	
		/* The loading Class */
		.loading {
			position: relative;
			background-color: #e2e2e2;
		}
	
		/* The moving element */
		.loading::after {
			display: block;
			content: "";
			position: absolute;
			width: 100%;
			height: 100%;
			transform: translateX(-100%);
			background: -webkit-gradient(linear, left top,
						right top, from(transparent),
						color-stop(rgba(255, 255, 255, 0.2)),
						to(transparent));
						
			background: linear-gradient(90deg, transparent,
					rgba(255, 255, 255, 0.2), transparent);
	
			/* Adding animation */
			animation: loading 0.8s infinite;
		}
	
		/* Loading Animation */
		@keyframes loading {
			100% {
				transform: translateX(100%);
			}
		}
	</style>
</head>
<!--============================================GETTING THE USER CURRENT LOCATION IN REAL TIME----------------------------->
<input type="text" id="latitude" style="display:none">
<input type="text" id="longitude" style="display:none">

<script>
var x = document.getElementById("latitude");
var y = document.getElementById("longitude");
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  x.value =position.coords.latitude ; 
  y.value =position.coords.longitude ; 
  
}

getLocation();
</script>


<body class="" onload="loader()">
  <div class="wrapper">
    <div class="sidebar">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
    -->
      <div class="sidebar-wrapper">
        <div class="logo">
            <img src="assets/img/logo.png">
        </div>
        <ul class="nav">
         <li class="">
            <a href="index.php">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Home</p>
            </a>
          </li>

          <li>
            <a href="panic_button.php">
              <i class="tim-icons icon-bell-55"></i>
              <p>Panic Button</p>
            </a>
          </li>
         <li class="active">
            <a href="nearby_stations.php">
              <i class="tim-icons icon-square-pin"></i>
              <p>Nearby Stations</p>
            </a>
          </li>
 
          <li>
            <a href="login.php">
              <i class="tim-icons icon-single-02"></i>
              <p>Login</p>
            </a>
          </li>
          <li>
            <a href="register.php">
              <i class="tim-icons icon-single-02"></i>
              <p>Register</p>
            </a>
          </li>


        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-body" hidden>
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:void(0)"></a>
          </div>
  
         
        </div>
      </nav>
      <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Navbar -->
      <div class="content" id="content_near">
         <div class="card__title loading"></div>
		<br>
		<div class="card__title loading"></div>
        <div class="card_shad" id="" style="display:flex">
          <div class="card__image loading"></div>
		  <div class="card__image loading"></div>
		   <div class="card__image loading"></div>
        </div>   
        <div class="card_shad" id="" style="display:flex">
          <div class="card__image loading"></div>
		  <div class="card__image loading"></div>
		   <div class="card__image loading"></div>
        </div>    		

      </div>
	   <div class="content" id="my_data" style="display:none">
        <h2>Nearby Police Station</h2>
		<br>
		<h4>List of nearby police stations<h4>
        <div class="row" id="data">
         
        </div>       

      </div>
      <footer class="footer">
        <div class="container-fluid">
          <ul class="nav">
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                T&Cs
              </a>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                About Us
              </a>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                Disclaimer
              </a>
            </li>
          </ul>
          <div class="copyright">
            ©
            <script>
              document.write(new Date().getFullYear())
            </script> SA CRIME TRACKING . All Rights Reserved.
            <a href="javascript:void(0)" target="_blank">
          </div>
        </div>
      </footer>
    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <!-- Place this tag in your head or just before your close body tag. -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/black-dashboard.min.js?v=1.0.0"></script><!-- Black Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <!--=========================================JQUERY FOR RESPONSIVE SIDE BAR===================================================-->
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');
        $navbar = $('.navbar');
        $main_panel = $('.main-panel');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');
        sidebar_mini_active = true;
        white_color = false;

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();



        $('.fixed-plugin a').click(function(event) {
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .background-color span').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data', new_color);
          }

          if ($main_panel.length != 0) {
            $main_panel.attr('data', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data', new_color);
          }
        });

        $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            sidebar_mini_active = false;
            blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
          } else {
            $('body').addClass('sidebar-mini');
            sidebar_mini_active = true;
            blackDashboard.showSidebarMessage('Sidebar mini activated...');
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);
        });

        $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (white_color == true) {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').removeClass('white-content');
            }, 900);
            white_color = false;
          } else {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').addClass('white-content');
            }, 900);

            white_color = true;
          }


        });

        $('.light-badge').click(function() {
          $('body').addClass('white-content');
        });

        $('.dark-badge').click(function() {
          $('body').removeClass('white-content');
        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "black-dashboard-free"
      });
  </script>
  <!--=================================FETCHING NEARBY STATIONS USING JAVASCRIPT AND AJAX=======================================-->
  <script>
 function load(){    
   var lat=document.getElementById('latitude').value;
   var log=document.getElementById('longitude').value;
    $.ajax({
        url: "classess/test.php",
        cache: false,
		data:{lat:lat,log:log},
        success: function(html){       
            $("#data").html(html); 
		
        },
    });
} 


setInterval (load, 2500);   //Refreshing the page every 2 seconds
  
  </script>
</body>

</html>
<script src="loader/jquery.min.js"></script>
<script src="loader/dist/jquery.loading-indicator.js"></script>

<script>

function loader(){
$('body').loadingIndicator();
var loader = $('body').data("loadingIndicator");



    setTimeout(function() {
	   document.getElementById('main-body').removeAttribute('hidden');
       loader.hide()
     }, 5000);	
	 
    setTimeout(function() {
        //document.getElementById('body-content').removeAttribute('hidden');
		document.getElementById('content_near').style.display="none";		
        document.getElementById('my_data').style.display="block";	
     }, 16000);	
	
}

</script>

