<?php

/* sign_in.html */
class __TwigTemplate_c6bb0b87dca310e80a8fe25c20b57dc6d6d810db1fc70610706f411313ec5aa8 extends Twig_Template
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
  <title>C team_summer_IoT_Login</title>
  <meta charset=\"utf-8\">
  
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
</head>

<body class=\"hold-transition login-page\" style=\"background: ##f5ffe8;\">
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
          <!-- ?????? ?????? -->
          <a href=\"/\" class=\"navbar-brand\">
           <img src=\"test_logo.png\" alt=\"\" style=\"width: 150px;\">
          </a>
        </div>
        <nav class=\"navbar-collapse collapse keen-navbar-collapse\" role=\"navigation\">
          <ul class=\"navbar-nav nav main-nav\">
            <li><a href=\"blank\" style=\"background: none;\">??????1</a></li>
            <li><a href=\"blank\" style=\"background: none;\">??????2</a></li>
            <li><a href=\"blank\" style=\"background: none;\">??????3</a></li>
            <li><a href=\"blank\" style=\"background: none;\">??????4</a></li>
            <li><a href=\"_blank\" style=\"background: none;\">??????5</a></li>
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
        <!-- ?????? -->
\t\t<div class=\"login-box\">
\t\t  <!-- ????????? ?????? -->
\t\t  <div class = \"login-logo\">
\t\t\t<b>Sign In</b>
\t\t  </div>
\t\t  <div class=\"login-box-body\">
\t\t    <!-- <p class=\"login-box-msg\">Sign in to start your session</p> -->

\t\t    <form action=\"index2.html\" method=\"post\">
\t\t      <div class=\"form-group has-feedback\">
\t\t        <input type=\"email\" class=\"form-control\" placeholder=\"Email address\">
\t\t        <span class=\"glyphicon glyphicon-envelope form-control-feedback\"></span>
\t\t      </div>
\t\t      <div class=\"form-group has-feedback\">
\t\t        <input type=\"password\" class=\"form-control\" placeholder=\"Password\">
\t\t        <span class=\"glyphicon glyphicon-lock form-control-feedback\"></span>
\t\t      </div>\t\t      
\t\t\t    <div class=\"form-group has-feedback\">
\t\t\t\t  <button type=\"submit\" class=\"btn btn-primary btn-block btn-flat\">Sign In</button>
\t\t\t    </div>
\t\t\t\t<!-- /.col -->
\t\t      </div>
\t\t\t</form>
\t\t\t<div class=\"social-auth-links text-center\">
\t\t\t  <p>- OR -</p>
\t\t\t  <a href=\"/forgotten_password\">Forgot password</a><br>
  \t\t      <a href=\"/sign_up\" class=\"text-center\">Create a Account</a>
\t\t\t</div>
\t\t\t
\t\t  </div>
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
        return "sign_in.html";
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
/*   <title>C team_summer_IoT_Login</title>*/
/*   <meta charset="utf-8">*/
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
/* </head>*/
/* */
/* <body class="hold-transition login-page" style="background: ##f5ffe8;">*/
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
/*           <!-- ?????? ?????? -->*/
/*           <a href="/" class="navbar-brand">*/
/*            <img src="test_logo.png" alt="" style="width: 150px;">*/
/*           </a>*/
/*         </div>*/
/*         <nav class="navbar-collapse collapse keen-navbar-collapse" role="navigation">*/
/*           <ul class="navbar-nav nav main-nav">*/
/*             <li><a href="blank" style="background: none;">??????1</a></li>*/
/*             <li><a href="blank" style="background: none;">??????2</a></li>*/
/*             <li><a href="blank" style="background: none;">??????3</a></li>*/
/*             <li><a href="blank" style="background: none;">??????4</a></li>*/
/*             <li><a href="_blank" style="background: none;">??????5</a></li>*/
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
/*         <!-- ?????? -->*/
/* 		<div class="login-box">*/
/* 		  <!-- ????????? ?????? -->*/
/* 		  <div class = "login-logo">*/
/* 			<b>Sign In</b>*/
/* 		  </div>*/
/* 		  <div class="login-box-body">*/
/* 		    <!-- <p class="login-box-msg">Sign in to start your session</p> -->*/
/* */
/* 		    <form action="index2.html" method="post">*/
/* 		      <div class="form-group has-feedback">*/
/* 		        <input type="email" class="form-control" placeholder="Email address">*/
/* 		        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>*/
/* 		      </div>*/
/* 		      <div class="form-group has-feedback">*/
/* 		        <input type="password" class="form-control" placeholder="Password">*/
/* 		        <span class="glyphicon glyphicon-lock form-control-feedback"></span>*/
/* 		      </div>		      */
/* 			    <div class="form-group has-feedback">*/
/* 				  <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>*/
/* 			    </div>*/
/* 				<!-- /.col -->*/
/* 		      </div>*/
/* 			</form>*/
/* 			<div class="social-auth-links text-center">*/
/* 			  <p>- OR -</p>*/
/* 			  <a href="/forgotten_password">Forgot password</a><br>*/
/*   		      <a href="/sign_up" class="text-center">Create a Account</a>*/
/* 			</div>*/
/* 			*/
/* 		  </div>*/
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
