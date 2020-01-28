<?php

/* login.html */
class __TwigTemplate_abbebacf45cc33f87d6cf00b96a5abd85bbace3e094661bcbb039473f30ddc1e extends Twig_Template
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
<html lang=\"kr\">

<head>

  <meta charset=\"utf-8\">
  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
  <meta name=\"description\" content=\"\">
  <meta name=\"author\" content=\"\">

  <title>환영합니다 Hustar 입니다.</title>

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
      <div class=\"card-header\">Hustar</div>
      <div class=\"card-body\">

        <form>
          <div class=\"form-group\">
            <div class=\"form-label-group\">
              <input type=\"email\" name=\"email\"id=\"inputEmail\" class=\"form-control\" placeholder=\"Email address\" required=\"required\" autofocus=\"autofocus\">
              <label for=\"inputEmail\">ID</label>
            </div>
          </div>
          <div class=\"form-group\">
            <div class=\"form-label-group\">
              <input type=\"password\" name =\"pass\" id=\"inputPassword\" class=\"form-control\" placeholder=\"Password\" required=\"required\">
              <label for=\"inputPassword\">PW</label>
            </div>
          </div>
          <div class=\"form-group\">
            <div class=\"checkbox\">
              <label>
                <input type=\"checkbox\" value=\"remember-me\">
                암호를 기억해주세요
              </label>
            </div>
          </div>
          <a class=\"btn btn-primary btn-block\" id=\"loginb\">로그인</a>
        </form>

        <script type=\"text/javascript\">
          //When click the login btn
          document.getElementById(\"loginb\").addEventListener('click', function(){
            // Check the value are all filled
            var email = \$('input[name = email]').val();
            var pass = \$('input[name = pass]').val();

            if(email == \"\"){
              alert(\"ID를 입력해주세요\");
            }else if(pass == \"\"){
              alert(\"비밀번호를 입력해주세요\");
            }else{
              //send json
              \$.ajax({
              method: \"POST\",
              url: \"/signin\",
              data: {
                \"EMAIL\": \$('input[name = email]').val(),                
                \"PASSWORD\": \$('input[name = pass]').val()                
              }
              }).done(function( msg ) {
                  //로그인 성공
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

                    // WEB SESSION 생성
                    //Get usn and is_admin
                    sessionStorage.setItem(\"usn\", msg.usn);
                    sessionStorage.setItem(\"name\", msg.name);
                    sessionStorage.setItem(\"is_admin\", msg.is_admin);

                    location.href = \"/main\";
                  }
                  if(msg.message == 1){
                    alert(\"패스워드가 틀렸습니다\");
                    location.href = \"/\";
                  }
                  if(msg.message == 2){
                    alert(\"계정이 없네요, 회원가입 하실래요?\");
                    location.href = \"/register_email\";
                  }
                  if(msg.message == 3){
                    alert(\"아직 인증이 안되었네요, 메일을 확인해주세요\");
                    location.href = \"/\";
                  }
              });
            }
          });
        </script>
        <div class=\"text-center\">
          <a class=\"d-block small mt-3\" href=\"/signup/email\">회원 가입</a>
          <a class=\"d-block small\" href=\"/signup/forgotpassword\">비밀번호가 기억나지 않은세요?</a>
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
/* <html lang="kr">*/
/* */
/* <head>*/
/* */
/*   <meta charset="utf-8">*/
/*   <meta http-equiv="X-UA-Compatible" content="IE=edge">*/
/*   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">*/
/*   <meta name="description" content="">*/
/*   <meta name="author" content="">*/
/* */
/*   <title>환영합니다 Hustar 입니다.</title>*/
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
/*       <div class="card-header">Hustar</div>*/
/*       <div class="card-body">*/
/* */
/*         <form>*/
/*           <div class="form-group">*/
/*             <div class="form-label-group">*/
/*               <input type="email" name="email"id="inputEmail" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">*/
/*               <label for="inputEmail">ID</label>*/
/*             </div>*/
/*           </div>*/
/*           <div class="form-group">*/
/*             <div class="form-label-group">*/
/*               <input type="password" name ="pass" id="inputPassword" class="form-control" placeholder="Password" required="required">*/
/*               <label for="inputPassword">PW</label>*/
/*             </div>*/
/*           </div>*/
/*           <div class="form-group">*/
/*             <div class="checkbox">*/
/*               <label>*/
/*                 <input type="checkbox" value="remember-me">*/
/*                 암호를 기억해주세요*/
/*               </label>*/
/*             </div>*/
/*           </div>*/
/*           <a class="btn btn-primary btn-block" id="loginb">로그인</a>*/
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
/*               alert("ID를 입력해주세요");*/
/*             }else if(pass == ""){*/
/*               alert("비밀번호를 입력해주세요");*/
/*             }else{*/
/*               //send json*/
/*               $.ajax({*/
/*               method: "POST",*/
/*               url: "/signin",*/
/*               data: {*/
/*                 "EMAIL": $('input[name = email]').val(),                */
/*                 "PASSWORD": $('input[name = pass]').val()                */
/*               }*/
/*               }).done(function( msg ) {*/
/*                   //로그인 성공*/
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
/*                     // WEB SESSION 생성*/
/*                     //Get usn and is_admin*/
/*                     sessionStorage.setItem("usn", msg.usn);*/
/*                     sessionStorage.setItem("name", msg.name);*/
/*                     sessionStorage.setItem("is_admin", msg.is_admin);*/
/* */
/*                     location.href = "/main";*/
/*                   }*/
/*                   if(msg.message == 1){*/
/*                     alert("패스워드가 틀렸습니다");*/
/*                     location.href = "/";*/
/*                   }*/
/*                   if(msg.message == 2){*/
/*                     alert("계정이 없네요, 회원가입 하실래요?");*/
/*                     location.href = "/register_email";*/
/*                   }*/
/*                   if(msg.message == 3){*/
/*                     alert("아직 인증이 안되었네요, 메일을 확인해주세요");*/
/*                     location.href = "/";*/
/*                   }*/
/*               });*/
/*             }*/
/*           });*/
/*         </script>*/
/*         <div class="text-center">*/
/*           <a class="d-block small mt-3" href="/signup/email">회원 가입</a>*/
/*           <a class="d-block small" href="/signup/forgotpassword">비밀번호가 기억나지 않은세요?</a>*/
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
