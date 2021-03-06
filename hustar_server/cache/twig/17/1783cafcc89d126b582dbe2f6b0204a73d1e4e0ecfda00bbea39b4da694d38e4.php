<?php

/* index.html */
class __TwigTemplate_aafe76df600f41b7c23d367674c9805b29dd99492718c82eb02d24f816243211 extends Twig_Template
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

  <script>
    
    var today = new Date();
      today.setDate(today.getDate() - 1);

      today = today.toISOString().slice(0, 10);
      var tomorrow = new Date().toISOString().slice(0, 10);

    sessionStorage['today'] = today;
    sessionStorage['tomorrow'] = tomorrow;
     
  </script>

  <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js\"></script>
  <script type=\"text/javascript\">
    // Set a global variable for map
    var map;

    var activeInfoWindow;

    function initMap() {
      var options = {
        //Center : QI(Calit2)
        center: { lat: 32.8826247, lng: -117.2367698 },
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.TERRAIN
      }     

      map = new google.maps.Map(document.getElementById(\"map_canvas\"), options);

      // Create markers into DOM
      var json = null;
      
      /*
      \$.ajax({
        'async': false,
        'global': false,
        //?????? ?????? ???????????? ??????
        'url': \"/getGPS\",
        'dataType': \"json\",
        'success': function (data) {
          console.log(data);
          createMarkers(data);
        }
      });
      */      

      \$.ajax({
        method: \"POST\",
        url: \"/location\",
        data: {
            usn : usn,
            date : \"2019-08-11\",
            tomorrow : \"2019-08-13\"          
        }
      }).done(function( msg ) {
          createMarkers(msg);
          drawStuff(msg);
          console.log(msg);
      }).fail((msg) => {
          console.log(msg);
      });      
    };
    // Instantiate markers in the background and pass it back to the json object
    function createMarkers(markerJson) {
      var length = Object.keys(markerJson).length;

      var contentString = [];
      var infowindow = [];
      var marker = [];

      for (let i = 0; i < length; i++) {
        var sensormark = markerJson[i];
        //sensormark = JSON.parse(`{\${sensormark}}`);
        //sensormark = JSON.parse(sensormark);

        
        contentString[i] = 
        '<div id=\"content\">' +
          '<div id=\"showupAQI\">' +
          '</div>' +
          '<h4 id=\"firstHeading\" class=\"firstHeading\">' + 'location' + '</h4>'+
          '<h2 id=\"firstHeading\" class=\"firstHeading\">'+'('+sensormark['latitude']+','+sensormark['longitude']+')'+'</h2>' +
          '<div id=\"bodyContent\">' +
          '<p>' +
          '<div>' +
          '<table class = \"mytable\" width=\"100%\" cellspacing=\"0\">' +
          '<thead>' +
          '<tr>' +
          '<th>Element</th>' +
          '<th>Value</th>' +
          '<th>AQI</th>' +
          '</tr>' +
          '</thead>' +
          '<tbody>' +
          '<tr>' +
          '<th> O3 </th>' +
          '<th>'+sensormark['O3']+'</th>' +
          '<th id = \"aq\">'+sensormark['AQ_O3']+'</th>' +
          '</tr>' +
          '<tr>' +
          '<th> CO </th>' +
          '<th>'+sensormark['CO']+'</th>' +
          '<th id = \"aq\">'+sensormark['AQ_CO']+'</th>' + 
          '</tr>' +
          '<tr>' +
          '<th> NO2 </th>' +
          '<th>'+sensormark['NO2']+'</th>' +
          '<th id = \"aq\">'+sensormark['AQ_NO2']+'</th>' +
          '</tr>' +
          '<tr>' +
          '<th> SO2 </th>' +
          '<th>'+sensormark['SO2']+'</th>' +
          '<th id = \"aq\">'+sensormark['AQ_SO2']+'</th>' +
          '</tr>' +
          '<tr>' +
          '<th> PM2.5 </th>' +
          '<th>'+sensormark['PM2_5']+'</th>' +
          '<th id = \"aq\">'+sensormark['AQ_PM2_5']+'</th>' +
          '</tr>' +
          '<tr>' +
          '<th> Temperature </th>' +
          '<th>'+sensormark['Temperature']+'</th>' +
          '<th>-</th>' +
          '</tr>' +
          '</tbody>' +
          '</table>' +
          '</div>' +
          '</p>' +
          '</div>';


        
        
        infowindow[i] = new google.maps.InfoWindow({
          content: contentString[i]
        });

        marker[i] = new google.maps.Circle({
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FF0000',
          fillOpacity: 0.35,
          map: map,
          position: { lat: sensormark['latitude'], lng: sensormark['longitude'] },
          center: { lat: sensormark['latitude'], lng: sensormark['longitude'] },
          radius: 100
          //html: \"<span class='pogo_name'>\" + sensormark.name + \"</a></span><br />\" + sensormark.location[0] + \"<br />\"
        });


      
        marker[i].addListener('click', function () {
          //????????? ?????? ???????????? - ?????? ??? ???????????? ????????? ???
          for(var k = 0; k< length; k++){              
              marker[k].setOptions({
              strokeColor: '#FF0000',
              fillColor: '#FF0000',
            });
          }
          //??????
          infowindow[i].open(map, marker[i]);        
          //?????? ?????????
          marker[i].setOptions({
            strokeColor: '#000000',
            fillColor: '#000000',
          });          
        });   
      }
    }

    //?????? ?????? ?????? ??????
    function mapchange(object){
      var today = new Date(object.value).toISOString().slice(0, 10);

      var tomorrow = new Date(object.value);
      tomorrow.setDate(tomorrow.getDate() + 1);
      tomorrow = tomorrow.toISOString().slice(0, 10);

      \$.ajax({
        method: \"POST\",
        url: \"/location\",
        data: {
            usn : usn,
            date : today,
            tomorrow : tomorrow          
        }
      }).done(function( msg ) {
          createMarkers(msg);
          console.log(msg);
          console.log(\"??????\");
      }).fail((msg) => {
          console.log(msg);
      }); 

      console.log(object.value);


    }
  </script>

  <!-- Google Chart-->
  <script type=\"text/javascript\" src=\"https://www.gstatic.com/charts/loader.js\"></script>
  <script type=\"text/javascript\">
    google.charts.load('current', { 'packages': ['bar'] });
    google.charts.setOnLoadCallback(drawStuff);

    //?????? ??????????????? AQI ?????? ???????????? ?????? ????????? ???????????? ????????? ??? ??????????????? ???
    function drawStuff(markerJson) {
      //var sensormark = markerJson[0];
      
      var test ;



      var data = new google.visualization.arrayToDataTable([
      ['Air Elements', 'Row Data', 'AQI'],
            ['PM2.5', 2, 0],
            ['O3', 49, 0],
            ['CO', 0.49, 0],
            ['NO2', 5.8, 0],
            ['SO2', 0.93, 0],
            ['temperature', 21, 0],
            ['AQI PM2.5', 0, 19],
            ['AQI O3', 0, 43],
            ['AQI CO', 0, 4],
            ['AQI NO2', 0, 4],
            ['AQI SO2', 0, 1]
      ]);

     


      var options = {
        width: 800,
        chart: {
          title: 'Real-time Air Quality',
          subtitle: 'distance on the left, brightness on the right'
        },
        bars: 'horizontal', // Required for Material Bar Charts.
        series: {
          0: { axis: 'distance' }, // Bind series 0 to an axis named 'distance'.
          1: { axis: 'brightness' } // Bind series 1 to an axis named 'brightness'.
        },
        axes: {
          x: {
            distance: { label: 'parsecs' }, // Bottom x-axis.
            brightness: { side: 'top', label: 'apparent magnitude' } // Top x-axis.
          }
        }
      };


      var chart = new google.charts.Bar(document.getElementById('dual_x_div'));
      chart.draw(data, options);
    };
  </script>
  <!-- ?????? ????????? css -->
  <style>
    .mytable {
      border-collapse: collapse;
    }

    .mytable th,
    .mytable td {
      border: 1px solid black;
    }
  </style>
</head>

<body id=\"page-top\">
  <!--IF user not login go to login page-->
  <script>
    if (sessionStorage.getItem('usn') == null) {
      location.href = \"/\";
    }
  </script>
  <nav class=\"navbar navbar-expand navbar-dark bg-dark static-top\">
      <img src=\"http://teamc-iot.calit2.net/mail_iconn.png\" style=\"height: 48px; width:100px;background-color: #01dea5;\">
    <a class=\"navbar-brand mr-1\" href=\"/main\">Farm-ing</a>
    <button class=\"btn btn-link btn-sm text-white order-1 order-sm-0\" id=\"sidebarToggle\" href=\"#\">
      <i class=\"fas fa-bars\"></i>
    </button>

    <!-- Navbar Search -->
    <form class=\"d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0\">
      <div class=\"input-group\">
        <div class=\"input-group-append\">
          <i></i>
        </div>
      </div>
    </form>

    <!-- Navbar -->
    <ul class=\"navbar-nav ml-auto ml-md-0\">
      <li class=\"nav-item dropdown no-arrow\">
        <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"userDropdown\" role=\"button\" data-toggle=\"dropdown\"
          aria-haspopup=\"true\" aria-expanded=\"false\">
          <i class=\"fas fa-user-circle fa-fw\"></i>
        </a>

        <!-- ?????? ?????????-->
        <div class=\"dropdown-menu dropdown-menu-right\" aria-labelledby=\"userDropdown\">
          <a>Hi,
            <script>
              var name = sessionStorage.getItem('name');
              document.write(name);
            </script>
          </a>
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
          <a class=\"dropdown-item\" href=\"/change_password\">Change Password</a>
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
        <!-- ?????? ?????? ?????? ??????-->
        <div class=\"card mb-3\">
          <div class=\"card-header\">              
            <i class=\"fas fa-chart-area\"></i>
            AQI Map
            <div>
                <!-- <input type=\"date\" id = \"datechanger\" name = \"datechanger\" onchange=\"mapchange(this);\"> -->
            </div>
          </div>
          <div class=\"card-body\">
            <div id=\"map_canvas\" style=\"position: relative;overflow: hidden;height: 500px;\"></div>
            <script async defer
              src=\"https://maps.googleapis.com/maps/api/js?key=AIzaSyCZ_5s3S4uTqhtcBNUndDLKvmvcD23QKvY&language=en&callback=initMap\">
              </script>
            <div class='myLinkContainer'></div>
          </div>
        </div>

        <!-- Google Chart-->
        <div class=\"card mb-3\">
          <div class=\"card-header\">            
            <i class=\"fas fa-chart-area\"></i>
            Real-Time Chart
          </div>
          <div class=\"card-body\">
            <!-- ?????? ????????? ?????? ??????-->
            <div id=\"dual_x_div\" style=\"width: 900px; height: 500px;\"></div>
          </div>
        </div>

        <!-- DataTables Example -->
        <br><br>
        <div class=\"card mb-3\">
          <div class=\"card-header\">
            <i class=\"fas fa-table\"></i>
            Sensor List Table</div>
          <div class=\"card-body\">
            <div class=\"table-responsive\">
              <table class=\"table table-bordered\" id=\"dataTable\" width=\"100%\" cellspacing=\"0\">
                <thead>
                  <tr>
                    <th>MAC</th>
                    <th>Sensor Name</th>
                    <th>State</th>
                  </tr>
                </thead>
                <tbody id=\"senosr_list\">
                  <!-- ?????? ??? ?????????-->
                  <script>
                    var usn = sessionStorage.usn;
                    //send json
                    \$.ajax({
                      method: \"POST\",
                      url: \"/sensorList\",
                      'dataType': \"json\",
                      data: {
                        \"usn\": usn
                      }
                    }).done(function (msg) {
                      var lenght = msg.message.length;
                      var temp = JSON.stringify(msg.message);

                      for (var i = 0; i < lenght; i++) {
                        var tr = document.createElement('tr');

                        if (JSON.parse(temp)[i].state == 1)
                          var text = '<th>' + JSON.parse(temp)[i].mac + '</th>' + '<th>' + JSON.parse(temp)[i].name + '</th>' + '<th>' + \"Active\" + '</th>';
                        else
                          var text = '<th>' + JSON.parse(temp)[i].mac + '</th>' + '<th>' + JSON.parse(temp)[i].name + '</th>' + '<th>' + \"NotActive\" + '</th>';

                        tr.innerHTML = text;
                        document.getElementById('senosr_list').appendChild(tr);
                      }
                    });
                  </script>
                </tbody>
              </table>
            </div>
          </div>
          <div class=\"card-footer small text-muted\">Updated yesterday at 11:59 PM</div>
        </div>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class=\"sticky-footer\">
        <div class=\"container my-auto\">
          <div class=\"copyright text-center my-auto\">
            <span>Copyright ?? Your Website 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

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
        <div class=\"modal-body\">Do you want to quit our 'Farming'?</div>
        <div class=\"modal-footer\">
          <button class=\"btn btn-secondary\" type=\"button\" data-dismiss=\"modal\">Cancel</button>
          <a class=\"btn btn-primary\" id=\"logoutb\">Logout</a>
          <!-- LogOut btn action -->
          <script type=\"text/javascript\">
            document.getElementById(\"logoutb\").addEventListener('click', function () {
              // Check the value are all filled
              var usn = sessionStorage.getItem('usn');
              //send json
              \$.ajax({
                method: \"POST\",
                url: \"/signout_proc\",
                data: {
                  \"usn\": usn
                }
              }).done(function (msg) {
                if (msg.message == 0) {
                  //logout success
                  //sessionStorage clear
                  sessionStorage.clear();
                  location.href = \"/\";
                }
                if (msg.message == 1) {
                  alert(\"Please, try logout again.\");
                }
              });
            });
          </script>
        </div>
      </div>
    </div>
  </div>


  <!-- My Account-->
  <!-- <div class=\"modal fade\" id=\"MyaccountModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog\" role=\"document\">
      <div class=\"modal-content\">
        <div class=\"modal-header\">
          <h5 class=\"modal-title\" id=\"accountModalLabel\">My Account</h5>
          <button class=\"close\" type=\"button\" data-dismiss=\"modal\" aria-label=\"Close\">
            <span aria-hidden=\"true\">??</span>
          </button>
        </div>
        <div class=\"modal-body\">Your Email: teamciot2019@gmail.com<br>Your Name: Jane</div>
        <div class=\"modal-footer\">
          <button class=\"btn btn-secondary\" type=\"button\" data-dismiss=\"modal\">Cancel</button>
          <a class=\"btn btn-primary\" href=\"login.html\">Change</a>
        </div>
      </div>
    </div>
  </div> -->






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
  <!-- <script src=\"js/demo/datatables-demo.js\"></script>
  <script src=\"js/demo/chart-area-demo.js\"></script> -->

</body>

</html>";
    }

    public function getTemplateName()
    {
        return "index.html";
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
/*   <script>*/
/*     */
/*     var today = new Date();*/
/*       today.setDate(today.getDate() - 1);*/
/* */
/*       today = today.toISOString().slice(0, 10);*/
/*       var tomorrow = new Date().toISOString().slice(0, 10);*/
/* */
/*     sessionStorage['today'] = today;*/
/*     sessionStorage['tomorrow'] = tomorrow;*/
/*      */
/*   </script>*/
/* */
/*   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>*/
/*   <script type="text/javascript">*/
/*     // Set a global variable for map*/
/*     var map;*/
/* */
/*     var activeInfoWindow;*/
/* */
/*     function initMap() {*/
/*       var options = {*/
/*         //Center : QI(Calit2)*/
/*         center: { lat: 32.8826247, lng: -117.2367698 },*/
/*         zoom: 15,*/
/*         mapTypeId: google.maps.MapTypeId.TERRAIN*/
/*       }     */
/* */
/*       map = new google.maps.Map(document.getElementById("map_canvas"), options);*/
/* */
/*       // Create markers into DOM*/
/*       var json = null;*/
/*       */
/*       /**/
/*       $.ajax({*/
/*         'async': false,*/
/*         'global': false,*/
/*         //?????? ?????? ???????????? ??????*/
/*         'url': "/getGPS",*/
/*         'dataType': "json",*/
/*         'success': function (data) {*/
/*           console.log(data);*/
/*           createMarkers(data);*/
/*         }*/
/*       });*/
/*       *//*       */
/* */
/*       $.ajax({*/
/*         method: "POST",*/
/*         url: "/location",*/
/*         data: {*/
/*             usn : usn,*/
/*             date : "2019-08-11",*/
/*             tomorrow : "2019-08-13"          */
/*         }*/
/*       }).done(function( msg ) {*/
/*           createMarkers(msg);*/
/*           drawStuff(msg);*/
/*           console.log(msg);*/
/*       }).fail((msg) => {*/
/*           console.log(msg);*/
/*       });      */
/*     };*/
/*     // Instantiate markers in the background and pass it back to the json object*/
/*     function createMarkers(markerJson) {*/
/*       var length = Object.keys(markerJson).length;*/
/* */
/*       var contentString = [];*/
/*       var infowindow = [];*/
/*       var marker = [];*/
/* */
/*       for (let i = 0; i < length; i++) {*/
/*         var sensormark = markerJson[i];*/
/*         //sensormark = JSON.parse(`{${sensormark}}`);*/
/*         //sensormark = JSON.parse(sensormark);*/
/* */
/*         */
/*         contentString[i] = */
/*         '<div id="content">' +*/
/*           '<div id="showupAQI">' +*/
/*           '</div>' +*/
/*           '<h4 id="firstHeading" class="firstHeading">' + 'location' + '</h4>'+*/
/*           '<h2 id="firstHeading" class="firstHeading">'+'('+sensormark['latitude']+','+sensormark['longitude']+')'+'</h2>' +*/
/*           '<div id="bodyContent">' +*/
/*           '<p>' +*/
/*           '<div>' +*/
/*           '<table class = "mytable" width="100%" cellspacing="0">' +*/
/*           '<thead>' +*/
/*           '<tr>' +*/
/*           '<th>Element</th>' +*/
/*           '<th>Value</th>' +*/
/*           '<th>AQI</th>' +*/
/*           '</tr>' +*/
/*           '</thead>' +*/
/*           '<tbody>' +*/
/*           '<tr>' +*/
/*           '<th> O3 </th>' +*/
/*           '<th>'+sensormark['O3']+'</th>' +*/
/*           '<th id = "aq">'+sensormark['AQ_O3']+'</th>' +*/
/*           '</tr>' +*/
/*           '<tr>' +*/
/*           '<th> CO </th>' +*/
/*           '<th>'+sensormark['CO']+'</th>' +*/
/*           '<th id = "aq">'+sensormark['AQ_CO']+'</th>' + */
/*           '</tr>' +*/
/*           '<tr>' +*/
/*           '<th> NO2 </th>' +*/
/*           '<th>'+sensormark['NO2']+'</th>' +*/
/*           '<th id = "aq">'+sensormark['AQ_NO2']+'</th>' +*/
/*           '</tr>' +*/
/*           '<tr>' +*/
/*           '<th> SO2 </th>' +*/
/*           '<th>'+sensormark['SO2']+'</th>' +*/
/*           '<th id = "aq">'+sensormark['AQ_SO2']+'</th>' +*/
/*           '</tr>' +*/
/*           '<tr>' +*/
/*           '<th> PM2.5 </th>' +*/
/*           '<th>'+sensormark['PM2_5']+'</th>' +*/
/*           '<th id = "aq">'+sensormark['AQ_PM2_5']+'</th>' +*/
/*           '</tr>' +*/
/*           '<tr>' +*/
/*           '<th> Temperature </th>' +*/
/*           '<th>'+sensormark['Temperature']+'</th>' +*/
/*           '<th>-</th>' +*/
/*           '</tr>' +*/
/*           '</tbody>' +*/
/*           '</table>' +*/
/*           '</div>' +*/
/*           '</p>' +*/
/*           '</div>';*/
/* */
/* */
/*         */
/*         */
/*         infowindow[i] = new google.maps.InfoWindow({*/
/*           content: contentString[i]*/
/*         });*/
/* */
/*         marker[i] = new google.maps.Circle({*/
/*           strokeColor: '#FF0000',*/
/*           strokeOpacity: 0.8,*/
/*           strokeWeight: 2,*/
/*           fillColor: '#FF0000',*/
/*           fillOpacity: 0.35,*/
/*           map: map,*/
/*           position: { lat: sensormark['latitude'], lng: sensormark['longitude'] },*/
/*           center: { lat: sensormark['latitude'], lng: sensormark['longitude'] },*/
/*           radius: 100*/
/*           //html: "<span class='pogo_name'>" + sensormark.name + "</a></span><br />" + sensormark.location[0] + "<br />"*/
/*         });*/
/* */
/* */
/*       */
/*         marker[i].addListener('click', function () {*/
/*           //????????? ?????? ???????????? - ?????? ??? ???????????? ????????? ???*/
/*           for(var k = 0; k< length; k++){              */
/*               marker[k].setOptions({*/
/*               strokeColor: '#FF0000',*/
/*               fillColor: '#FF0000',*/
/*             });*/
/*           }*/
/*           //??????*/
/*           infowindow[i].open(map, marker[i]);        */
/*           //?????? ?????????*/
/*           marker[i].setOptions({*/
/*             strokeColor: '#000000',*/
/*             fillColor: '#000000',*/
/*           });          */
/*         });   */
/*       }*/
/*     }*/
/* */
/*     //?????? ?????? ?????? ??????*/
/*     function mapchange(object){*/
/*       var today = new Date(object.value).toISOString().slice(0, 10);*/
/* */
/*       var tomorrow = new Date(object.value);*/
/*       tomorrow.setDate(tomorrow.getDate() + 1);*/
/*       tomorrow = tomorrow.toISOString().slice(0, 10);*/
/* */
/*       $.ajax({*/
/*         method: "POST",*/
/*         url: "/location",*/
/*         data: {*/
/*             usn : usn,*/
/*             date : today,*/
/*             tomorrow : tomorrow          */
/*         }*/
/*       }).done(function( msg ) {*/
/*           createMarkers(msg);*/
/*           console.log(msg);*/
/*           console.log("??????");*/
/*       }).fail((msg) => {*/
/*           console.log(msg);*/
/*       }); */
/* */
/*       console.log(object.value);*/
/* */
/* */
/*     }*/
/*   </script>*/
/* */
/*   <!-- Google Chart-->*/
/*   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>*/
/*   <script type="text/javascript">*/
/*     google.charts.load('current', { 'packages': ['bar'] });*/
/*     google.charts.setOnLoadCallback(drawStuff);*/
/* */
/*     //?????? ??????????????? AQI ?????? ???????????? ?????? ????????? ???????????? ????????? ??? ??????????????? ???*/
/*     function drawStuff(markerJson) {*/
/*       //var sensormark = markerJson[0];*/
/*       */
/*       var test ;*/
/* */
/* */
/* */
/*       var data = new google.visualization.arrayToDataTable([*/
/*       ['Air Elements', 'Row Data', 'AQI'],*/
/*             ['PM2.5', 2, 0],*/
/*             ['O3', 49, 0],*/
/*             ['CO', 0.49, 0],*/
/*             ['NO2', 5.8, 0],*/
/*             ['SO2', 0.93, 0],*/
/*             ['temperature', 21, 0],*/
/*             ['AQI PM2.5', 0, 19],*/
/*             ['AQI O3', 0, 43],*/
/*             ['AQI CO', 0, 4],*/
/*             ['AQI NO2', 0, 4],*/
/*             ['AQI SO2', 0, 1]*/
/*       ]);*/
/* */
/*      */
/* */
/* */
/*       var options = {*/
/*         width: 800,*/
/*         chart: {*/
/*           title: 'Real-time Air Quality',*/
/*           subtitle: 'distance on the left, brightness on the right'*/
/*         },*/
/*         bars: 'horizontal', // Required for Material Bar Charts.*/
/*         series: {*/
/*           0: { axis: 'distance' }, // Bind series 0 to an axis named 'distance'.*/
/*           1: { axis: 'brightness' } // Bind series 1 to an axis named 'brightness'.*/
/*         },*/
/*         axes: {*/
/*           x: {*/
/*             distance: { label: 'parsecs' }, // Bottom x-axis.*/
/*             brightness: { side: 'top', label: 'apparent magnitude' } // Top x-axis.*/
/*           }*/
/*         }*/
/*       };*/
/* */
/* */
/*       var chart = new google.charts.Bar(document.getElementById('dual_x_div'));*/
/*       chart.draw(data, options);*/
/*     };*/
/*   </script>*/
/*   <!-- ?????? ????????? css -->*/
/*   <style>*/
/*     .mytable {*/
/*       border-collapse: collapse;*/
/*     }*/
/* */
/*     .mytable th,*/
/*     .mytable td {*/
/*       border: 1px solid black;*/
/*     }*/
/*   </style>*/
/* </head>*/
/* */
/* <body id="page-top">*/
/*   <!--IF user not login go to login page-->*/
/*   <script>*/
/*     if (sessionStorage.getItem('usn') == null) {*/
/*       location.href = "/";*/
/*     }*/
/*   </script>*/
/*   <nav class="navbar navbar-expand navbar-dark bg-dark static-top">*/
/*       <img src="http://teamc-iot.calit2.net/mail_iconn.png" style="height: 48px; width:100px;background-color: #01dea5;">*/
/*     <a class="navbar-brand mr-1" href="/main">Farm-ing</a>*/
/*     <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">*/
/*       <i class="fas fa-bars"></i>*/
/*     </button>*/
/* */
/*     <!-- Navbar Search -->*/
/*     <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">*/
/*       <div class="input-group">*/
/*         <div class="input-group-append">*/
/*           <i></i>*/
/*         </div>*/
/*       </div>*/
/*     </form>*/
/* */
/*     <!-- Navbar -->*/
/*     <ul class="navbar-nav ml-auto ml-md-0">*/
/*       <li class="nav-item dropdown no-arrow">*/
/*         <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"*/
/*           aria-haspopup="true" aria-expanded="false">*/
/*           <i class="fas fa-user-circle fa-fw"></i>*/
/*         </a>*/
/* */
/*         <!-- ?????? ?????????-->*/
/*         <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">*/
/*           <a>Hi,*/
/*             <script>*/
/*               var name = sessionStorage.getItem('name');*/
/*               document.write(name);*/
/*             </script>*/
/*           </a>*/
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
/*           <a class="dropdown-item" href="/change_password">Change Password</a>*/
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
/*         <!-- ?????? ?????? ?????? ??????-->*/
/*         <div class="card mb-3">*/
/*           <div class="card-header">              */
/*             <i class="fas fa-chart-area"></i>*/
/*             AQI Map*/
/*             <div>*/
/*                 <!-- <input type="date" id = "datechanger" name = "datechanger" onchange="mapchange(this);"> -->*/
/*             </div>*/
/*           </div>*/
/*           <div class="card-body">*/
/*             <div id="map_canvas" style="position: relative;overflow: hidden;height: 500px;"></div>*/
/*             <script async defer*/
/*               src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZ_5s3S4uTqhtcBNUndDLKvmvcD23QKvY&language=en&callback=initMap">*/
/*               </script>*/
/*             <div class='myLinkContainer'></div>*/
/*           </div>*/
/*         </div>*/
/* */
/*         <!-- Google Chart-->*/
/*         <div class="card mb-3">*/
/*           <div class="card-header">            */
/*             <i class="fas fa-chart-area"></i>*/
/*             Real-Time Chart*/
/*           </div>*/
/*           <div class="card-body">*/
/*             <!-- ?????? ????????? ?????? ??????-->*/
/*             <div id="dual_x_div" style="width: 900px; height: 500px;"></div>*/
/*           </div>*/
/*         </div>*/
/* */
/*         <!-- DataTables Example -->*/
/*         <br><br>*/
/*         <div class="card mb-3">*/
/*           <div class="card-header">*/
/*             <i class="fas fa-table"></i>*/
/*             Sensor List Table</div>*/
/*           <div class="card-body">*/
/*             <div class="table-responsive">*/
/*               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">*/
/*                 <thead>*/
/*                   <tr>*/
/*                     <th>MAC</th>*/
/*                     <th>Sensor Name</th>*/
/*                     <th>State</th>*/
/*                   </tr>*/
/*                 </thead>*/
/*                 <tbody id="senosr_list">*/
/*                   <!-- ?????? ??? ?????????-->*/
/*                   <script>*/
/*                     var usn = sessionStorage.usn;*/
/*                     //send json*/
/*                     $.ajax({*/
/*                       method: "POST",*/
/*                       url: "/sensorList",*/
/*                       'dataType': "json",*/
/*                       data: {*/
/*                         "usn": usn*/
/*                       }*/
/*                     }).done(function (msg) {*/
/*                       var lenght = msg.message.length;*/
/*                       var temp = JSON.stringify(msg.message);*/
/* */
/*                       for (var i = 0; i < lenght; i++) {*/
/*                         var tr = document.createElement('tr');*/
/* */
/*                         if (JSON.parse(temp)[i].state == 1)*/
/*                           var text = '<th>' + JSON.parse(temp)[i].mac + '</th>' + '<th>' + JSON.parse(temp)[i].name + '</th>' + '<th>' + "Active" + '</th>';*/
/*                         else*/
/*                           var text = '<th>' + JSON.parse(temp)[i].mac + '</th>' + '<th>' + JSON.parse(temp)[i].name + '</th>' + '<th>' + "NotActive" + '</th>';*/
/* */
/*                         tr.innerHTML = text;*/
/*                         document.getElementById('senosr_list').appendChild(tr);*/
/*                       }*/
/*                     });*/
/*                   </script>*/
/*                 </tbody>*/
/*               </table>*/
/*             </div>*/
/*           </div>*/
/*           <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>*/
/*         </div>*/
/* */
/*       </div>*/
/*       <!-- /.container-fluid -->*/
/* */
/*       <!-- Sticky Footer -->*/
/*       <footer class="sticky-footer">*/
/*         <div class="container my-auto">*/
/*           <div class="copyright text-center my-auto">*/
/*             <span>Copyright ?? Your Website 2019</span>*/
/*           </div>*/
/*         </div>*/
/*       </footer>*/
/* */
/*     </div>*/
/*     <!-- /.content-wrapper -->*/
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
/*         <div class="modal-body">Do you want to quit our 'Farming'?</div>*/
/*         <div class="modal-footer">*/
/*           <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>*/
/*           <a class="btn btn-primary" id="logoutb">Logout</a>*/
/*           <!-- LogOut btn action -->*/
/*           <script type="text/javascript">*/
/*             document.getElementById("logoutb").addEventListener('click', function () {*/
/*               // Check the value are all filled*/
/*               var usn = sessionStorage.getItem('usn');*/
/*               //send json*/
/*               $.ajax({*/
/*                 method: "POST",*/
/*                 url: "/signout_proc",*/
/*                 data: {*/
/*                   "usn": usn*/
/*                 }*/
/*               }).done(function (msg) {*/
/*                 if (msg.message == 0) {*/
/*                   //logout success*/
/*                   //sessionStorage clear*/
/*                   sessionStorage.clear();*/
/*                   location.href = "/";*/
/*                 }*/
/*                 if (msg.message == 1) {*/
/*                   alert("Please, try logout again.");*/
/*                 }*/
/*               });*/
/*             });*/
/*           </script>*/
/*         </div>*/
/*       </div>*/
/*     </div>*/
/*   </div>*/
/* */
/* */
/*   <!-- My Account-->*/
/*   <!-- <div class="modal fade" id="MyaccountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">*/
/*     <div class="modal-dialog" role="document">*/
/*       <div class="modal-content">*/
/*         <div class="modal-header">*/
/*           <h5 class="modal-title" id="accountModalLabel">My Account</h5>*/
/*           <button class="close" type="button" data-dismiss="modal" aria-label="Close">*/
/*             <span aria-hidden="true">??</span>*/
/*           </button>*/
/*         </div>*/
/*         <div class="modal-body">Your Email: teamciot2019@gmail.com<br>Your Name: Jane</div>*/
/*         <div class="modal-footer">*/
/*           <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>*/
/*           <a class="btn btn-primary" href="login.html">Change</a>*/
/*         </div>*/
/*       </div>*/
/*     </div>*/
/*   </div> -->*/
/* */
/* */
/* */
/* */
/* */
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
/*   <!-- <script src="js/demo/datatables-demo.js"></script>*/
/*   <script src="js/demo/chart-area-demo.js"></script> -->*/
/* */
/* </body>*/
/* */
/* </html>*/
