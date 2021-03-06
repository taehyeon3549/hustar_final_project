<?php

/* login.html */
class __TwigTemplate_5c54a6191fe6fe65b010fd066791be196480393b33755972282b624683a3687b extends Twig_Template
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

  <title>Farm-ing Sign In</title>

  <!-- Custom fonts for this template-->
  <link href=\"/vendor/fontawesome-free/css/all.min.css\" rel=\"stylesheet\" type=\"text/css\">

  <!-- Custom styles for this template-->
  <link href=\"/css/sb-admin.css\" rel=\"stylesheet\">
</head>

<body class=\"bg-dark\">
  <div class=\"container\">
    <div class=\"card card-login mx-auto mt-5\" style=\"border-color: #01E1A5;\">
        <img src=\"http://teamc-iot.calit2.net/mail_iconn.png\" style=\"height: 200px;background-color: #01dea5;\">
    </div>
    <div class=\"card card-login mx-auto mt-5\" style=\"margin-top: 5px;\">
      <div class=\"card-header\">Farm-ing</div>
      <div class=\"card-body\">

        <form>
          <div class=\"form-group\">
            <div class=\"form-label-group\">
              <input type=\"email\" name=\"email\"id=\"inputEmail\" class=\"form-control\" placeholder=\"Email address\" required=\"required\" autofocus=\"autofocus\">
              <label for=\"inputEmail\">Test2_Email address</label>
            </div>
          </div>
          <div class=\"form-group\">
            <div class=\"form-label-group\">
              <input type=\"password\" name =\"pass\" id=\"inputPassword\" class=\"form-control\" placeholder=\"Password\" required=\"required\">
              <label for=\"inputPassword\">Password</label>
            </div>
          </div>
          <div class=\"form-group\">
            <div class=\"checkbox\">
              <label>
                <input type=\"checkbox\" value=\"remember-me\">
                Remember Password
              </label>
            </div>
          </div>
          <a class=\"btn btn-primary btn-block\" id=\"loginb\">Login</a>
        </form>

        <script type=\"text/javascript\">
          //When click the login btn
          document.getElementById(\"loginb\").addEventListener('click', function(){
            // Check the value are all filled
            var email = \$('input[name = email]').val();
            var pass = \$('input[name = pass]').val();

            if(email == \"\"){
              alert(\"Please, Enter the email\");
            }else if(pass == \"\"){
              alert(\"Please, Enter the password\");
            }else{
              //send json
              \$.ajax({
              method: \"POST\",
              url: \"/signin_proc\",
              data: {
                \"id\": \$('input[name = email]').val(),                
                \"pw\": \$('input[name = pass]').val()                
              }
              }).done(function( msg ) {
                  //If sign_up success, show up the sign in page
                  if(msg.message == 0){
                    //IF login success, get user's sensor data
                    \$.ajax({
                      method: \"POST\",
                      url: \"/sensorList\",
                      data: {
                        \"usn\": msg.usn                
                      }
                    }).done(function( msg ) {                  
                      //Get usn and is_admin
                      sessionStorage.setItem(\"sensor\", JSON.stringify(msg.message));                      
                    });         
                    alert(\"Welcome!!\");

                    //Create session
                    //Get usn and is_admin
                    sessionStorage.setItem(\"usn\", msg.usn);
                    sessionStorage.setItem(\"name\", msg.name);
                    sessionStorage.setItem(\"is_admin\", msg.is_admin);

                    location.href = \"/main\";
                  }
                  if(msg.message == 1){
                    alert(\"Please, check your password again.\");
                    location.href = \"/\";
                  }
                  if(msg.message == 2){
                    alert(\"You don't have account. Why don't you join our member\");
                    location.href = \"/register_email\";
                  }
                  if(msg.message == 3){
                    alert(\"You didn't certifate. Please, check your email.\");
                    location.href = \"/\";
                  }
              });
            }
          });
        </script>
        <div class=\"text-center\">
          <a class=\"d-block small mt-3\" href=\"/register_email\">Register an Account</a>
          <a class=\"d-block small\" href=\"/forgot-password\">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src=\"/vendor/jquery/jquery.min.js\"></script>
  <script src=\"/vendor/bootstrap/js/bootstrap.bundle.min.js\"></script>

  <!-- Core plugin JavaScript-->
  <script src=\"/vendor/jquery-easing/jquery.easing.min.js\"></script>

  <!-- POST value to make JSON -->
  <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>
  <script type=\"text/javascript\">
  
  </script>
</body>

</html>
";
    }

    public function getTemplateName()
    {
        return "login.html";
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
/*   <title>Farm-ing Sign In</title>*/
/* */
/*   <!-- Custom fonts for this template-->*/
/*   <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">*/
/* */
/*   <!-- Custom styles for this template-->*/
/*   <link href="/css/sb-admin.css" rel="stylesheet">*/
/* </head>*/
/* */
/* <body class="bg-dark">*/
/*   <div class="container">*/
/*     <div class="card card-login mx-auto mt-5" style="border-color: #01E1A5;">*/
/*         <img src="http://teamc-iot.calit2.net/mail_iconn.png" style="height: 200px;background-color: #01dea5;">*/
/*     </div>*/
/*     <div class="card card-login mx-auto mt-5" style="margin-top: 5px;">*/
/*       <div class="card-header">Farm-ing</div>*/
/*       <div class="card-body">*/
/* */
/*         <form>*/
/*           <div class="form-group">*/
/*             <div class="form-label-group">*/
/*               <input type="email" name="email"id="inputEmail" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">*/
/*               <label for="inputEmail">Test2_Email address</label>*/
/*             </div>*/
/*           </div>*/
/*           <div class="form-group">*/
/*             <div class="form-label-group">*/
/*               <input type="password" name ="pass" id="inputPassword" class="form-control" placeholder="Password" required="required">*/
/*               <label for="inputPassword">Password</label>*/
/*             </div>*/
/*           </div>*/
/*           <div class="form-group">*/
/*             <div class="checkbox">*/
/*               <label>*/
/*                 <input type="checkbox" value="remember-me">*/
/*                 Remember Password*/
/*               </label>*/
/*             </div>*/
/*           </div>*/
/*           <a class="btn btn-primary btn-block" id="loginb">Login</a>*/
/*         </form>*/
/* */
/*         <script type="text/javascript">*/
/*           //When click the login btn*/
/*           document.getElementById("loginb").addEventListener('click', function(){*/
/*             // Check the value are all filled*/
/*             var email = $('input[name = email]').val();*/
/*             var pass = $('input[name = pass]').val();*/
/* */
/*             if(email == ""){*/
/*               alert("Please, Enter the email");*/
/*             }else if(pass == ""){*/
/*               alert("Please, Enter the password");*/
/*             }else{*/
/*               //send json*/
/*               $.ajax({*/
/*               method: "POST",*/
/*               url: "/signin_proc",*/
/*               data: {*/
/*                 "id": $('input[name = email]').val(),                */
/*                 "pw": $('input[name = pass]').val()                */
/*               }*/
/*               }).done(function( msg ) {*/
/*                   //If sign_up success, show up the sign in page*/
/*                   if(msg.message == 0){*/
/*                     //IF login success, get user's sensor data*/
/*                     $.ajax({*/
/*                       method: "POST",*/
/*                       url: "/sensorList",*/
/*                       data: {*/
/*                         "usn": msg.usn                */
/*                       }*/
/*                     }).done(function( msg ) {                  */
/*                       //Get usn and is_admin*/
/*                       sessionStorage.setItem("sensor", JSON.stringify(msg.message));                      */
/*                     });         */
/*                     alert("Welcome!!");*/
/* */
/*                     //Create session*/
/*                     //Get usn and is_admin*/
/*                     sessionStorage.setItem("usn", msg.usn);*/
/*                     sessionStorage.setItem("name", msg.name);*/
/*                     sessionStorage.setItem("is_admin", msg.is_admin);*/
/* */
/*                     location.href = "/main";*/
/*                   }*/
/*                   if(msg.message == 1){*/
/*                     alert("Please, check your password again.");*/
/*                     location.href = "/";*/
/*                   }*/
/*                   if(msg.message == 2){*/
/*                     alert("You don't have account. Why don't you join our member");*/
/*                     location.href = "/register_email";*/
/*                   }*/
/*                   if(msg.message == 3){*/
/*                     alert("You didn't certifate. Please, check your email.");*/
/*                     location.href = "/";*/
/*                   }*/
/*               });*/
/*             }*/
/*           });*/
/*         </script>*/
/*         <div class="text-center">*/
/*           <a class="d-block small mt-3" href="/register_email">Register an Account</a>*/
/*           <a class="d-block small" href="/forgot-password">Forgot Password?</a>*/
/*         </div>*/
/*       </div>*/
/*     </div>*/
/*   </div>*/
/* */
/*   <!-- Bootstrap core JavaScript-->*/
/*   <script src="/vendor/jquery/jquery.min.js"></script>*/
/*   <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>*/
/* */
/*   <!-- Core plugin JavaScript-->*/
/*   <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>*/
/* */
/*   <!-- POST value to make JSON -->*/
/*   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>*/
/*   <script type="text/javascript">*/
/*   */
/*   </script>*/
/* </body>*/
/* */
/* </html>*/
/* */
