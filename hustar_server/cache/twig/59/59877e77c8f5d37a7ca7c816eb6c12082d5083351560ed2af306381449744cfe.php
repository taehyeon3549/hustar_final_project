<?php

/* maps.html */
class __TwigTemplate_80cc28957432f4bfc6024a1ca586e5e23b87564e407d534db5c9995a1100cd2c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">

<head>

  <meta charset=\"utf-8\">
  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
  <meta name=\"description\" content=\"\">
  <meta name=\"author\" content=\"\">

  <title>TeamC_Main Page</title>

  <!-- Custom fonts for this template-->
  <link href=\"vendor/fontawesome-free/css/all.min.css\" rel=\"stylesheet\" type=\"text/css\">

  <!-- Page level plugin CSS-->
  <link href=\"vendor/datatables/dataTables.bootstrap4.css\" rel=\"stylesheet\">

  <!-- Custom styles for this template-->
  <link href=\"css/sb-admin.css\" rel=\"stylesheet\">

  <!-- Google Map -->
  <script>
    var map, infoWindow;

    //Make Circle
    var citymap = {
      chicago: {
        center: { lat: 41.878, lng: -87.629 },
        population: 2714856
      },
      newyork: {
        center: { lat: 40.714, lng: -74.005 },
        population: 8405837
      },
      losangeles: {
        center: { lat: 34.052, lng: -118.243 },
        population: 3857799
      },
      vancouver: {
        center: { lat: 49.25, lng: -123.1 },
        population: 603502
      }
    };


    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: -34.397, lng: 150.644 },
        zoom: 6
      });
      infoWindow = new google.maps.InfoWindow;


      //make circle
      for (var city in citymap) {
        // Add the circle for this city to the map.
        var cityCircle = new google.maps.Circle({
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FF0000',
          fillOpacity: 0.35,
          map: map,
          center: citymap[city].center,
          radius: Math.sqrt(citymap[city].population) * 100
        });
      }

      // Try HTML5 geolocation.
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
          var pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };

          infoWindow.setPosition(pos);
          infoWindow.setContent('Location found.');
          infoWindow.open(map);
          map.setCenter(pos);
        }, function () {
          handleLocationError(true, infoWindow, map.getCenter());
        });
      } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
      }
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
      infoWindow.setPosition(pos);
      infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\\'t support geolocation.');
      infoWindow.open(map);
    }
  </script>
  <script async defer
    src=\"https://maps.googleapis.com/maps/api/js?key=AIzaSyCZ_5s3S4uTqhtcBNUndDLKvmvcD23QKvY&callback=initMap\">
    </script>
</head>

<body id=\"page-top\">
  <nav class=\"navbar navbar-expand navbar-dark bg-dark static-top\">
      <img src=\"http://teamc-iot.calit2.net/mail_iconn.png\" style=\"height: 48px; width:100px;background-color: #01dea5;\">
    <a class=\"navbar-brand mr-1\" href=\"/main\">Farm-ing</a>
    <button class=\"btn btn-link btn-sm text-white order-1 order-sm-0\" id=\"sidebarToggle\" href=\"#\">
      <i class=\"fas fa-bars\"></i>
    </button>

    <!-- Navbar -->
    <ul class=\"navbar-nav ml-auto ml-md-0\">
      <li class=\"nav-item dropdown no-arrow\">
        <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"userDropdown\" role=\"button\" data-toggle=\"dropdown\"
          aria-haspopup=\"true\" aria-expanded=\"false\">
          <i class=\"fas fa-user-circle fa-fw\"></i>
        </a>
        <!-- user icon-->
        <div class=\"dropdown-menu dropdown-menu-right\" aria-labelledby=\"userDropdown\">
          <a>Hi,  
            <script>
              var name = sessionStorage.getItem('name');
              document.write(name);
            </script>
          </a>!!
          <div class=\"dropdown-divider\"></div>
          <a class=\"dropdown-item\" data-toggle=\"modal\" data-target=\"#logoutModal\">Logout</a>
        </div>
      </li>
    </ul>
  </nav>

  <div id=\"wrapper\">
    <!-- Sidebar -->
    <ul class=\"sidebar navbar-nav\">
      <li class=\"nav-item active\">
        <a class=\"nav-link\" href=\"/main\">
          <i class=\"fas fa-fw fa-tachometer-alt\"></i>
          <span>Main</span>
        </a>
      </li>
      <li class=\"nav-item dropdown\">
        <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"pagesDropdown\" role=\"button\" data-toggle=\"dropdown\"
          aria-haspopup=\"true\" aria-expanded=\"false\">
          <i class=\"fas fa-fw fa-folder\"></i>
          <span>Information</span>
        </a>
        <div class=\"dropdown-menu\" aria-labelledby=\"pagesDropdown\">
          <a class=\"dropdown-item\" id=\"myaccountb\" href=\"/myaccount\">My Account</a>
          <a class=\"dropdown-item\" id=\"signoutb\" href=\"#\" data-toggle=\"modal\" data-target=\"#logoutModal\">Log Out</a>
          <a class=\"dropdown-item\" href=\"/change_idcancellation\">ID Cancellation</a>
        </div>
      </li>
      <li class=\"nav-item\">
        <a class=\"nav-link\" href=\"/charts\">
          <i class=\"fas fa-fw fa-chart-area\"></i>
          <span>Charts</span></a>
      </li>
      <li class=\"nav-item\">
        <a class=\"nav-link\" href=\"/maps\">
          <i class=\"fas fa-fw fa-chart-area\"></i>
          <span>Map</span></a>
      </li>
    </ul>

    <div id=\"content-wrapper\">
      <div class=\"container-fluid\">
        <!-- Breadcrumbs-->
        <ol class=\"breadcrumb\">
          <li class=\"breadcrumb-item\">
            <a href=\"#\">Farm-ing</a>
          </li>
          <li class=\"breadcrumb-item active\">Overview</li>
        </ol>

        <!-- Google map-->
        <div id=\"map\" style=\"width:100%;height:600px\"></div>

      </div>

    </div>

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class=\"scroll-to-top rounded\" href=\"#page-top\">
    <i class=\"fas fa-angle-up\"></i>
  </a>

  <!-- Logout Modal-->
  <div class=\"modal fade\" id=\"logoutModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\"
    aria-hidden=\"true\">
    <div class=\"modal-dialog\" role=\"document\">
      <div class=\"modal-content\">
        <div class=\"modal-header\">
          <h5 class=\"modal-title\" id=\"exampleModalLabel\">Ready to Leave?</h5>
          <button class=\"close\" type=\"button\" data-dismiss=\"modal\" aria-label=\"Close\">
            <span aria-hidden=\"true\">??</span>
          </button>
        </div>
        <div class=\"modal-body\">Select \"Logout\" below if you are ready to end your current session.</div>
        <div class=\"modal-footer\">
          <button class=\"btn btn-secondary\" type=\"button\" data-dismiss=\"modal\">Cancel</button>
          <a class=\"btn btn-primary\" href=\"/\">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src=\"vendor/jquery/jquery.min.js\"></script>
  <script src=\"vendor/bootstrap/js/bootstrap.bundle.min.js\"></script>

  <!-- Core plugin JavaScript-->
  <script src=\"vendor/jquery-easing/jquery.easing.min.js\"></script>

  <!-- Page level plugin JavaScript-->
  <script src=\"vendor/chart.js/Chart.min.js\"></script>
  <script src=\"vendor/datatables/jquery.dataTables.js\"></script>
  <script src=\"vendor/datatables/dataTables.bootstrap4.js\"></script>

  <!-- Custom scripts for all pages-->
  <script src=\"js/sb-admin.min.js\"></script>

  <!-- Demo scripts for this page-->
  <script src=\"js/demo/datatables-demo.js\"></script>
  <script src=\"js/demo/chart-area-demo.js\"></script>

</body>

</html>";
    }

    public function getTemplateName()
    {
        return "maps.html";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html lang="en">*/
/* */
/* <head>*/
/* */
/*   <meta charset="utf-8">*/
/*   <meta http-equiv="X-UA-Compatible" content="IE=edge">*/
/*   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">*/
/*   <meta name="description" content="">*/
/*   <meta name="author" content="">*/
/* */
/*   <title>TeamC_Main Page</title>*/
/* */
/*   <!-- Custom fonts for this template-->*/
/*   <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">*/
/* */
/*   <!-- Page level plugin CSS-->*/
/*   <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">*/
/* */
/*   <!-- Custom styles for this template-->*/
/*   <link href="css/sb-admin.css" rel="stylesheet">*/
/* */
/*   <!-- Google Map -->*/
/*   <script>*/
/*     var map, infoWindow;*/
/* */
/*     //Make Circle*/
/*     var citymap = {*/
/*       chicago: {*/
/*         center: { lat: 41.878, lng: -87.629 },*/
/*         population: 2714856*/
/*       },*/
/*       newyork: {*/
/*         center: { lat: 40.714, lng: -74.005 },*/
/*         population: 8405837*/
/*       },*/
/*       losangeles: {*/
/*         center: { lat: 34.052, lng: -118.243 },*/
/*         population: 3857799*/
/*       },*/
/*       vancouver: {*/
/*         center: { lat: 49.25, lng: -123.1 },*/
/*         population: 603502*/
/*       }*/
/*     };*/
/* */
/* */
/*     function initMap() {*/
/*       map = new google.maps.Map(document.getElementById('map'), {*/
/*         center: { lat: -34.397, lng: 150.644 },*/
/*         zoom: 6*/
/*       });*/
/*       infoWindow = new google.maps.InfoWindow;*/
/* */
/* */
/*       //make circle*/
/*       for (var city in citymap) {*/
/*         // Add the circle for this city to the map.*/
/*         var cityCircle = new google.maps.Circle({*/
/*           strokeColor: '#FF0000',*/
/*           strokeOpacity: 0.8,*/
/*           strokeWeight: 2,*/
/*           fillColor: '#FF0000',*/
/*           fillOpacity: 0.35,*/
/*           map: map,*/
/*           center: citymap[city].center,*/
/*           radius: Math.sqrt(citymap[city].population) * 100*/
/*         });*/
/*       }*/
/* */
/*       // Try HTML5 geolocation.*/
/*       if (navigator.geolocation) {*/
/*         navigator.geolocation.getCurrentPosition(function (position) {*/
/*           var pos = {*/
/*             lat: position.coords.latitude,*/
/*             lng: position.coords.longitude*/
/*           };*/
/* */
/*           infoWindow.setPosition(pos);*/
/*           infoWindow.setContent('Location found.');*/
/*           infoWindow.open(map);*/
/*           map.setCenter(pos);*/
/*         }, function () {*/
/*           handleLocationError(true, infoWindow, map.getCenter());*/
/*         });*/
/*       } else {*/
/*         // Browser doesn't support Geolocation*/
/*         handleLocationError(false, infoWindow, map.getCenter());*/
/*       }*/
/*     }*/
/* */
/*     function handleLocationError(browserHasGeolocation, infoWindow, pos) {*/
/*       infoWindow.setPosition(pos);*/
/*       infoWindow.setContent(browserHasGeolocation ?*/
/*         'Error: The Geolocation service failed.' :*/
/*         'Error: Your browser doesn\'t support geolocation.');*/
/*       infoWindow.open(map);*/
/*     }*/
/*   </script>*/
/*   <script async defer*/
/*     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZ_5s3S4uTqhtcBNUndDLKvmvcD23QKvY&callback=initMap">*/
/*     </script>*/
/* </head>*/
/* */
/* <body id="page-top">*/
/*   <nav class="navbar navbar-expand navbar-dark bg-dark static-top">*/
/*       <img src="http://teamc-iot.calit2.net/mail_iconn.png" style="height: 48px; width:100px;background-color: #01dea5;">*/
/*     <a class="navbar-brand mr-1" href="/main">Farm-ing</a>*/
/*     <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">*/
/*       <i class="fas fa-bars"></i>*/
/*     </button>*/
/* */
/*     <!-- Navbar -->*/
/*     <ul class="navbar-nav ml-auto ml-md-0">*/
/*       <li class="nav-item dropdown no-arrow">*/
/*         <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"*/
/*           aria-haspopup="true" aria-expanded="false">*/
/*           <i class="fas fa-user-circle fa-fw"></i>*/
/*         </a>*/
/*         <!-- user icon-->*/
/*         <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">*/
/*           <a>Hi,  */
/*             <script>*/
/*               var name = sessionStorage.getItem('name');*/
/*               document.write(name);*/
/*             </script>*/
/*           </a>!!*/
/*           <div class="dropdown-divider"></div>*/
/*           <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">Logout</a>*/
/*         </div>*/
/*       </li>*/
/*     </ul>*/
/*   </nav>*/
/* */
/*   <div id="wrapper">*/
/*     <!-- Sidebar -->*/
/*     <ul class="sidebar navbar-nav">*/
/*       <li class="nav-item active">*/
/*         <a class="nav-link" href="/main">*/
/*           <i class="fas fa-fw fa-tachometer-alt"></i>*/
/*           <span>Main</span>*/
/*         </a>*/
/*       </li>*/
/*       <li class="nav-item dropdown">*/
/*         <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"*/
/*           aria-haspopup="true" aria-expanded="false">*/
/*           <i class="fas fa-fw fa-folder"></i>*/
/*           <span>Information</span>*/
/*         </a>*/
/*         <div class="dropdown-menu" aria-labelledby="pagesDropdown">*/
/*           <a class="dropdown-item" id="myaccountb" href="/myaccount">My Account</a>*/
/*           <a class="dropdown-item" id="signoutb" href="#" data-toggle="modal" data-target="#logoutModal">Log Out</a>*/
/*           <a class="dropdown-item" href="/change_idcancellation">ID Cancellation</a>*/
/*         </div>*/
/*       </li>*/
/*       <li class="nav-item">*/
/*         <a class="nav-link" href="/charts">*/
/*           <i class="fas fa-fw fa-chart-area"></i>*/
/*           <span>Charts</span></a>*/
/*       </li>*/
/*       <li class="nav-item">*/
/*         <a class="nav-link" href="/maps">*/
/*           <i class="fas fa-fw fa-chart-area"></i>*/
/*           <span>Map</span></a>*/
/*       </li>*/
/*     </ul>*/
/* */
/*     <div id="content-wrapper">*/
/*       <div class="container-fluid">*/
/*         <!-- Breadcrumbs-->*/
/*         <ol class="breadcrumb">*/
/*           <li class="breadcrumb-item">*/
/*             <a href="#">Farm-ing</a>*/
/*           </li>*/
/*           <li class="breadcrumb-item active">Overview</li>*/
/*         </ol>*/
/* */
/*         <!-- Google map-->*/
/*         <div id="map" style="width:100%;height:600px"></div>*/
/* */
/*       </div>*/
/* */
/*     </div>*/
/* */
/*   </div>*/
/*   <!-- /#wrapper -->*/
/* */
/*   <!-- Scroll to Top Button-->*/
/*   <a class="scroll-to-top rounded" href="#page-top">*/
/*     <i class="fas fa-angle-up"></i>*/
/*   </a>*/
/* */
/*   <!-- Logout Modal-->*/
/*   <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"*/
/*     aria-hidden="true">*/
/*     <div class="modal-dialog" role="document">*/
/*       <div class="modal-content">*/
/*         <div class="modal-header">*/
/*           <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>*/
/*           <button class="close" type="button" data-dismiss="modal" aria-label="Close">*/
/*             <span aria-hidden="true">??</span>*/
/*           </button>*/
/*         </div>*/
/*         <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>*/
/*         <div class="modal-footer">*/
/*           <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>*/
/*           <a class="btn btn-primary" href="/">Logout</a>*/
/*         </div>*/
/*       </div>*/
/*     </div>*/
/*   </div>*/
/* */
/*   <!-- Bootstrap core JavaScript-->*/
/*   <script src="vendor/jquery/jquery.min.js"></script>*/
/*   <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>*/
/* */
/*   <!-- Core plugin JavaScript-->*/
/*   <script src="vendor/jquery-easing/jquery.easing.min.js"></script>*/
/* */
/*   <!-- Page level plugin JavaScript-->*/
/*   <script src="vendor/chart.js/Chart.min.js"></script>*/
/*   <script src="vendor/datatables/jquery.dataTables.js"></script>*/
/*   <script src="vendor/datatables/dataTables.bootstrap4.js"></script>*/
/* */
/*   <!-- Custom scripts for all pages-->*/
/*   <script src="js/sb-admin.min.js"></script>*/
/* */
/*   <!-- Demo scripts for this page-->*/
/*   <script src="js/demo/datatables-demo.js"></script>*/
/*   <script src="js/demo/chart-area-demo.js"></script>*/
/* */
/* </body>*/
/* */
/* </html>*/
