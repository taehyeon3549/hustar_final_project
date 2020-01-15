<?php

/* Map.html */
class __TwigTemplate_b5ccd55abbc98ab7fc0b24a59bdb9a274d70131ead9a7985cb02911b534bfea5 extends Twig_Template
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
<html>

<head>
  <title>Google Map API Testing</title>
  <meta charset=\"utf-8\">

  <script type=\"text/javascript\" src=\"https://code.jquery.com/jquery-3.1.1.min.js\"></script><script type=\"text/javascript\" src=\"http://maps.google.com/maps/api/js?key=AIzaSyCZ_5s3S4uTqhtcBNUndDLKvmvcD23QKvY&language=en\" ></script>
  
  <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
  <link href=\"https://cloud.typography.com/737368/747986/css/fonts.css\" rel=\"stylesheet\" type=\"text/css\">
  <link href=\"assets/css/keen-static.css\" rel=\"stylesheet\" type='text/css' />
  <link href=\"assets/css/keen-dashboards.css\" rel=\"stylesheet\" type='text/css' />
  <!-- Admin LTE -->
  <meta http-equiv=\"X-UA-Compatible\">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" name=\"viewport\">
  <!-- Bootstrap 3.3.7 -->
  <link rel=\"stylesheet\" href=\"bower_components/bootstrap/dist/css/bootstrap.min.css\" type=\"text/css\">
  <!-- Font Awesome -->
  <link rel=\"stylesheet\" href=\"bower_components/font-awesome/css/font-awesome.min.css\" type=\"text/css\">
  <!-- Ionicons -->
  <link rel=\"stylesheet\" href=\"bower_components/Ionicons/css/ionicons.min.css\" type=\"text/css\">
  <!-- Theme style -->
  <link rel=\"stylesheet\" href=\"dist/css/AdminLTE.min.css\" type=\"text/css\">
  <!-- iCheck -->
  <link rel=\"stylesheet\" href=\"plugins/iCheck/square/blue.css\" type=\"text/css\">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src=\"https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js\"></script>
  <script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic\">

   <style>#map_ma {width:100%; height:400px; clear:both;border:solid 1px red;}
  </style>
</head>

<body class=\"hold-transition login-page\" style=\"background: #f5ffe8;\">
\t <div class=\"masthead hero\" style = \"min-height: 100px; height: 100px;\">
\t<div class=\"container\" style=\"text-align:right; font-size:15px; font-color:#FFFFFF\">
\t\t<a href=\"/sign_in\"><span class=\"btn-user-info\" style=\"font-weight:bold\">Sign in</span></a>
\t\t/
\t\t<a href=\"/sign_up\"><span class=\"btn-user-signin\" style=\"font-weight:bold\">Create Account</span></a>
\t</div>
    <div class=\"container\">
      <header class=\"navbar\">
        <div class=\"navbar-header\">
          <button class=\"navbar-toggle\" type=\"button\" data-target=\".keen-navbar-collapse\">
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
          </button>
          <!-- 로고 동작 -->
          <a href=\"/\" class=\"navbar-brand\">
           <img src=\"test_logo.png\" alt=\"\" style=\"width: 150px;\">
          </a>
        </div>
        <nav class=\"navbar-collapse collapse keen-navbar-collapse\" role=\"navigation\">
          <ul class=\"navbar-nav nav main-nav\">
            <li><a href=\"blank\" style=\"background: none;\">메뉴1</a></li>
            <li><a href=\"blank\" style=\"background: none;\">메뉴2</a></li>
            <li><a href=\"blank\" style=\"background: none;\">메뉴3</a></li>
            <li><a href=\"blank\" style=\"background: none;\">메뉴4</a></li>
            <li><a href=\"_blank\" style=\"background: none;\">메뉴5</a></li>
          </ul>
          <ul class=\"navbar-nav nav main-nav align-right\">
            <!-- 
\t\t\t<li><a href=\"https://keen.io/signup?s=gh-dashboards\" class=\"btn navbar-btn\" target=\"_blank\">Create a Free
                Project</a></li> -->
          </ul>
        </nav>
      </header>    

    </div>
  </div>

\t<div style=\"min-height: auto\">
      <div>
        <div id=\"map_ma\"></div>
\t\t\t<script type=\"text/javascript\">
\t\t\t\t\$(document).ready(function() {
\t\t\t\t  var myLatlng = new google.maps.LatLng(32.8824866,-117.2348399); // 위치값 위도 경도
\t\t\t  var Y_point     = 32.8824866;    // Y 좌표
\t\t\t  var X_point     = -117.2348399;   // X 좌표
\t\t\t  var zoomLevel   = 18;       // 지도의 확대 레벨 : 숫자가 클수록 확대정도가 큼
\t\t\t  var markerTitle   = \"Calit2(QI)\";    // 현재 위치 마커에 마우스를 오버을때 나타나는 정보
\t\t\t  var markerMaxWidth  = 300;        // 마커를 클릭했을때 나타나는 말풍선의 최대 크기

\t\t\t// 말풍선 내용
\t\t\t  var contentString = '<div>' +
\t\t\t  '<h2>QI in UCSD</h2>'+
\t\t\t  '<p>Here we are studying !! :D</p>' +
\t\t\t  
\t\t\t  '</div>';
\t\t\t  var myLatlng = new google.maps.LatLng(Y_point, X_point);
\t\t\t  var mapOptions = {
\t\t\t\t\t\tzoom: zoomLevel,
\t\t\t\t\t\tcenter: myLatlng,
\t\t\t\t\t\tmapTypeId: google.maps.MapTypeId.ROADMAP
\t\t\t\t\t  }
\t\t\t  var map = new google.maps.Map(document.getElementById('map_ma'), mapOptions);
\t\t\t  var marker = new google.maps.Marker({
\t\t\t\t\t\t\t\t  position: myLatlng,
\t\t\t\t\t\t\t\t  map: map,
\t\t\t\t\t\t\t\t  title: markerTitle
\t\t\t  });
\t\t\t  var infowindow = new google.maps.InfoWindow(
\t\t\t\t\t\t\t\t\t{
\t\t\t\t\t\t\t\t\t  content: contentString,
\t\t\t\t\t\t\t\t\t  maxWizzzdth: markerMaxWidth
\t\t\t\t\t\t\t\t\t}
\t\t\t\t  );
\t\t\t  google.maps.event.addListener(marker, 'click', function() {
\t\t\t\tinfowindow.open(map, marker);
\t\t\t  });
\t\t\t});
\t\t\t\t</script>
\t\t  <!-- /.login-box-body -->
\t\t</div>
\t\t<!-- /.login-box -->
      </div>
    </div>

 

    

  <div class=\"footer\">
    <div class=\"container\">
      <div class=\"love\">
        <p><a href=\"http://qi.ucsd.edu/\">QI institute UCSD</a></p>
      </div>
    </div>
  </div>

<!-- jQuery 3 -->
<script src=\"bower_components/jquery/dist/jquery.min.js\"></script>
<!-- Bootstrap 3.3.7 -->
<script src=\"bower_components/bootstrap/dist/js/bootstrap.min.js\"></script>
<!-- iCheck -->
<script src=\"plugins/iCheck/icheck.min.js\"></script>
  <script type=\"text/javascript\" src=\"assets/js/keen-analytics.js\"></script>
  <script>
    function toggleMenu() {
      const toggleBtn = document.querySelector('.navbar-toggle');

      toggleBtn.addEventListener('click', (e) => {
        let menu;
        if (e.currentTarget.dataset.target) {
          menu = document.querySelector(e.currentTarget.dataset.target);
        }
        if (menu) menu.classList.toggle('collapsed');
      });
    }

    window.addEventListener('DOMContentLoaded', toggleMenu);\t
  </script>
  <script>
  \$(function () {
    \$('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>

</html>";
    }

    public function getTemplateName()
    {
        return "Map.html";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/* */
/* <head>*/
/*   <title>Google Map API Testing</title>*/
/*   <meta charset="utf-8">*/
/* */
/*   <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script><script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCZ_5s3S4uTqhtcBNUndDLKvmvcD23QKvY&language=en" ></script>*/
/*   */
/*   <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />*/
/*   <link href="https://cloud.typography.com/737368/747986/css/fonts.css" rel="stylesheet" type="text/css">*/
/*   <link href="assets/css/keen-static.css" rel="stylesheet" type='text/css' />*/
/*   <link href="assets/css/keen-dashboards.css" rel="stylesheet" type='text/css' />*/
/*   <!-- Admin LTE -->*/
/*   <meta http-equiv="X-UA-Compatible">*/
/*   <!-- Tell the browser to be responsive to screen width -->*/
/*   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">*/
/*   <!-- Bootstrap 3.3.7 -->*/
/*   <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css" type="text/css">*/
/*   <!-- Font Awesome -->*/
/*   <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css" type="text/css">*/
/*   <!-- Ionicons -->*/
/*   <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css" type="text/css">*/
/*   <!-- Theme style -->*/
/*   <link rel="stylesheet" href="dist/css/AdminLTE.min.css" type="text/css">*/
/*   <!-- iCheck -->*/
/*   <link rel="stylesheet" href="plugins/iCheck/square/blue.css" type="text/css">*/
/* */
/*   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->*/
/*   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->*/
/*   <!--[if lt IE 9]>*/
/*   <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>*/
/*   <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>*/
/*   <![endif]-->*/
/* */
/*   <!-- Google Font -->*/
/*   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">*/
/* */
/*    <style>#map_ma {width:100%; height:400px; clear:both;border:solid 1px red;}*/
/*   </style>*/
/* </head>*/
/* */
/* <body class="hold-transition login-page" style="background: #f5ffe8;">*/
/* 	 <div class="masthead hero" style = "min-height: 100px; height: 100px;">*/
/* 	<div class="container" style="text-align:right; font-size:15px; font-color:#FFFFFF">*/
/* 		<a href="/sign_in"><span class="btn-user-info" style="font-weight:bold">Sign in</span></a>*/
/* 		/*/
/* 		<a href="/sign_up"><span class="btn-user-signin" style="font-weight:bold">Create Account</span></a>*/
/* 	</div>*/
/*     <div class="container">*/
/*       <header class="navbar">*/
/*         <div class="navbar-header">*/
/*           <button class="navbar-toggle" type="button" data-target=".keen-navbar-collapse">*/
/*             <span class="icon-bar"></span>*/
/*             <span class="icon-bar"></span>*/
/*             <span class="icon-bar"></span>*/
/*           </button>*/
/*           <!-- 로고 동작 -->*/
/*           <a href="/" class="navbar-brand">*/
/*            <img src="test_logo.png" alt="" style="width: 150px;">*/
/*           </a>*/
/*         </div>*/
/*         <nav class="navbar-collapse collapse keen-navbar-collapse" role="navigation">*/
/*           <ul class="navbar-nav nav main-nav">*/
/*             <li><a href="blank" style="background: none;">메뉴1</a></li>*/
/*             <li><a href="blank" style="background: none;">메뉴2</a></li>*/
/*             <li><a href="blank" style="background: none;">메뉴3</a></li>*/
/*             <li><a href="blank" style="background: none;">메뉴4</a></li>*/
/*             <li><a href="_blank" style="background: none;">메뉴5</a></li>*/
/*           </ul>*/
/*           <ul class="navbar-nav nav main-nav align-right">*/
/*             <!-- */
/* 			<li><a href="https://keen.io/signup?s=gh-dashboards" class="btn navbar-btn" target="_blank">Create a Free*/
/*                 Project</a></li> -->*/
/*           </ul>*/
/*         </nav>*/
/*       </header>    */
/* */
/*     </div>*/
/*   </div>*/
/* */
/* 	<div style="min-height: auto">*/
/*       <div>*/
/*         <div id="map_ma"></div>*/
/* 			<script type="text/javascript">*/
/* 				$(document).ready(function() {*/
/* 				  var myLatlng = new google.maps.LatLng(32.8824866,-117.2348399); // 위치값 위도 경도*/
/* 			  var Y_point     = 32.8824866;    // Y 좌표*/
/* 			  var X_point     = -117.2348399;   // X 좌표*/
/* 			  var zoomLevel   = 18;       // 지도의 확대 레벨 : 숫자가 클수록 확대정도가 큼*/
/* 			  var markerTitle   = "Calit2(QI)";    // 현재 위치 마커에 마우스를 오버을때 나타나는 정보*/
/* 			  var markerMaxWidth  = 300;        // 마커를 클릭했을때 나타나는 말풍선의 최대 크기*/
/* */
/* 			// 말풍선 내용*/
/* 			  var contentString = '<div>' +*/
/* 			  '<h2>QI in UCSD</h2>'+*/
/* 			  '<p>Here we are studying !! :D</p>' +*/
/* 			  */
/* 			  '</div>';*/
/* 			  var myLatlng = new google.maps.LatLng(Y_point, X_point);*/
/* 			  var mapOptions = {*/
/* 						zoom: zoomLevel,*/
/* 						center: myLatlng,*/
/* 						mapTypeId: google.maps.MapTypeId.ROADMAP*/
/* 					  }*/
/* 			  var map = new google.maps.Map(document.getElementById('map_ma'), mapOptions);*/
/* 			  var marker = new google.maps.Marker({*/
/* 								  position: myLatlng,*/
/* 								  map: map,*/
/* 								  title: markerTitle*/
/* 			  });*/
/* 			  var infowindow = new google.maps.InfoWindow(*/
/* 									{*/
/* 									  content: contentString,*/
/* 									  maxWizzzdth: markerMaxWidth*/
/* 									}*/
/* 				  );*/
/* 			  google.maps.event.addListener(marker, 'click', function() {*/
/* 				infowindow.open(map, marker);*/
/* 			  });*/
/* 			});*/
/* 				</script>*/
/* 		  <!-- /.login-box-body -->*/
/* 		</div>*/
/* 		<!-- /.login-box -->*/
/*       </div>*/
/*     </div>*/
/* */
/*  */
/* */
/*     */
/* */
/*   <div class="footer">*/
/*     <div class="container">*/
/*       <div class="love">*/
/*         <p><a href="http://qi.ucsd.edu/">QI institute UCSD</a></p>*/
/*       </div>*/
/*     </div>*/
/*   </div>*/
/* */
/* <!-- jQuery 3 -->*/
/* <script src="bower_components/jquery/dist/jquery.min.js"></script>*/
/* <!-- Bootstrap 3.3.7 -->*/
/* <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>*/
/* <!-- iCheck -->*/
/* <script src="plugins/iCheck/icheck.min.js"></script>*/
/*   <script type="text/javascript" src="assets/js/keen-analytics.js"></script>*/
/*   <script>*/
/*     function toggleMenu() {*/
/*       const toggleBtn = document.querySelector('.navbar-toggle');*/
/* */
/*       toggleBtn.addEventListener('click', (e) => {*/
/*         let menu;*/
/*         if (e.currentTarget.dataset.target) {*/
/*           menu = document.querySelector(e.currentTarget.dataset.target);*/
/*         }*/
/*         if (menu) menu.classList.toggle('collapsed');*/
/*       });*/
/*     }*/
/* */
/*     window.addEventListener('DOMContentLoaded', toggleMenu);	*/
/*   </script>*/
/*   <script>*/
/*   $(function () {*/
/*     $('input').iCheck({*/
/*       checkboxClass: 'icheckbox_square-blue',*/
/*       radioClass: 'iradio_square-blue',*/
/*       increaseArea: '20%' /* optional *//* */
/*     });*/
/*   });*/
/* </script>*/
/* </body>*/
/* */
/* </html>*/
