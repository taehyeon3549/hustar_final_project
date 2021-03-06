<?php

/* register_email.html */
class __TwigTemplate_580b9942e00b8ac7662fcb608a9774a3664b4ee2e6bc624a9c4c23522267daea extends Twig_Template
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

  <title>Sign Up</title>

  <!-- Custom fonts for this template-->
  <link href=\"vendor/fontawesome-free/css/all.min.css\" rel=\"stylesheet\" type=\"text/css\">

  <!-- Custom styles for this template-->
  <link href=\"css/sb-admin.css\" rel=\"stylesheet\">

</head>

<body class=\"bg-dark\">
  <div class=\"container\">
    <div class=\"card card-login mx-auto mt-5\" style=\"border-color: #01E1A5;\">
      <img src=\"http://teamc-iot.calit2.net/mail_iconn.png\" style=\"height: 200px;background-color: #01dea5;\">
    </div>
    <div class=\"card card-login mx-auto mt-5\" style=\"margin-top: 5px;\">
      <div class=\"card-header\">Sign Up</div>
      <div class=\"card-body\">
        <div class=\"mb-4\">
          <p>Enter your email address to check duplication</p>
        </div>
        <form>
          <div class=\"form-group\">
          </div>
          <div class=\"form-group\">
            <div class=\"form-label-group\">
              <input type=\"email\" name= \"email\" id=\"inputEmail\" class=\"form-control\" placeholder=\"Email address\" required=\"required\">
              <label for=\"inputEmail\">Email address</label>
            </div>
          </div>
          <a class=\"btn btn-primary btn-block\" id=\"verifyb\">Verify</a>   
        </form>

        <script type=\"text/javascript\">
          //When click the login btn
          document.getElementById(\"verifyb\").addEventListener('click', function(){
            // Check the value are all filled
            var email = \$('input[name = email]').val();

            if(email == \"\"){
              alert(\"Please, Enter the email\");
            }else{
              //send json
              \$.ajax({
              method: \"POST\",
              url: \"/click_verify/0\",
              data: {
                \"id\": \$('input[name = email]').val()               
              }
              }).done(function( msg ) {
                  //If sign_up success, show up the sign in page
                  if(msg.message == 0){
                    alert(\"We sent the certification email to you, please check.\");
                    location.href = \"/register_email_message\";
                  }
                  if(msg.message == 1){
                    alert(\"You already have account!!\");
                    location.href = \"/\";
                  }
              });         
            }
          });
        </script>

        <div class=\"text-center\">
          <a class=\"d-block small mt-3\" href=\"/\">Login Page</a>
          <a class=\"d-block small\" href=\"/forgot-password\">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src=\"vendor/jquery/jquery.min.js\"></script>
  <script src=\"vendor/bootstrap/js/bootstrap.bundle.min.js\"></script>

  <!-- Core plugin JavaScript-->
  <script src=\"vendor/jquery-easing/jquery.easing.min.js\"></script>

</body>

</html>
";
    }

    public function getTemplateName()
    {
        return "register_email.html";
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
/*   <title>Sign Up</title>*/
/* */
/*   <!-- Custom fonts for this template-->*/
/*   <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">*/
/* */
/*   <!-- Custom styles for this template-->*/
/*   <link href="css/sb-admin.css" rel="stylesheet">*/
/* */
/* </head>*/
/* */
/* <body class="bg-dark">*/
/*   <div class="container">*/
/*     <div class="card card-login mx-auto mt-5" style="border-color: #01E1A5;">*/
/*       <img src="http://teamc-iot.calit2.net/mail_iconn.png" style="height: 200px;background-color: #01dea5;">*/
/*     </div>*/
/*     <div class="card card-login mx-auto mt-5" style="margin-top: 5px;">*/
/*       <div class="card-header">Sign Up</div>*/
/*       <div class="card-body">*/
/*         <div class="mb-4">*/
/*           <p>Enter your email address to check duplication</p>*/
/*         </div>*/
/*         <form>*/
/*           <div class="form-group">*/
/*           </div>*/
/*           <div class="form-group">*/
/*             <div class="form-label-group">*/
/*               <input type="email" name= "email" id="inputEmail" class="form-control" placeholder="Email address" required="required">*/
/*               <label for="inputEmail">Email address</label>*/
/*             </div>*/
/*           </div>*/
/*           <a class="btn btn-primary btn-block" id="verifyb">Verify</a>   */
/*         </form>*/
/* */
/*         <script type="text/javascript">*/
/*           //When click the login btn*/
/*           document.getElementById("verifyb").addEventListener('click', function(){*/
/*             // Check the value are all filled*/
/*             var email = $('input[name = email]').val();*/
/* */
/*             if(email == ""){*/
/*               alert("Please, Enter the email");*/
/*             }else{*/
/*               //send json*/
/*               $.ajax({*/
/*               method: "POST",*/
/*               url: "/click_verify/0",*/
/*               data: {*/
/*                 "id": $('input[name = email]').val()               */
/*               }*/
/*               }).done(function( msg ) {*/
/*                   //If sign_up success, show up the sign in page*/
/*                   if(msg.message == 0){*/
/*                     alert("We sent the certification email to you, please check.");*/
/*                     location.href = "/register_email_message";*/
/*                   }*/
/*                   if(msg.message == 1){*/
/*                     alert("You already have account!!");*/
/*                     location.href = "/";*/
/*                   }*/
/*               });         */
/*             }*/
/*           });*/
/*         </script>*/
/* */
/*         <div class="text-center">*/
/*           <a class="d-block small mt-3" href="/">Login Page</a>*/
/*           <a class="d-block small" href="/forgot-password">Forgot Password?</a>*/
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
/* </body>*/
/* */
/* </html>*/
/* */
