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



  <title>Hustar 출결관리 시스템</title>


  <link rel=\"shortcut icon\" href=\"/hustar_server/app/templates/image/favicon.ico\"type=\"image/x-ico\">

  <!-- Custom fonts for this template-->
  <link href=\"/vendor/fontawesome-free/css/all.min.css\" rel=\"stylesheet\" type=\"text/css\">

  <!-- Custom styles for this template-->
  <link href=\"/css/sb-admin.css\" rel=\"stylesheet\">
  
  <style>
    body {
      background-image: url(\"https://ifh.cc/g/Zzv5w.jpg\");
      background: url(https://ifh.cc/g/Zzv5w.jpg) no-repeat center center fixed; 
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
      opacity: 0.7;
    } 
    </style>


</head>

<body>
  <div class=\"container\">
       
    </div>
    <div class=\"card card-login mx-auto mt-5\" style=\"margin-top: 5px;\">
      <div class=\"card-header\">Hustar</div>
      <div class=\"card-body\">

        <form >
          <div class=\"form-group\">
            <div class=\"form-label-group\">
              <input type=\"email\" name=\"email\"id=\"inputEmail\" class=\"form-control\" placeholder=\"Email address\" required=\"required\" autofocus=\"autofocus\">
              <label for=\"inputEmail\">아이디(이메일)</label>
            </div>
          </div>
          <div class=\"form-group\">
            <div class=\"form-label-group\">
              <input type=\"password\" name =\"pass\" id=\"inputPassword\" class=\"form-control\" placeholder=\"Password\" required=\"required\">
              <label for=\"inputPassword\">비밀번호</label>
            </div>
          </div>
          <div class=\"form-group\">
            <div class=\"checkbox\">
              <label>
                <input type=\"checkbox\" value=\"remember-me\">
                비밀번호 자동저장
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
                    alert(\"로그인 성공했습니다!!\");

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
          <div style=\"margin-top: 15px;\">
          <a class=\"d-block small\" href=\"/signup/forgotpassword\">비밀번호 찾기</a>
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
</body  opacity: 0.5;>

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
/* */
/* */
/*   <title>Hustar 출결관리 시스템</title>*/
/* */
/* */
/*   <link rel="shortcut icon" href="/hustar_server/app/templates/image/favicon.ico"type="image/x-ico">*/
/* */
/*   <!-- Custom fonts for this template-->*/
/*   <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">*/
/* */
/*   <!-- Custom styles for this template-->*/
/*   <link href="/css/sb-admin.css" rel="stylesheet">*/
/*   */
/*   <style>*/
/*     body {*/
/*       background-image: url("https://ifh.cc/g/Zzv5w.jpg");*/
/*       background: url(https://ifh.cc/g/Zzv5w.jpg) no-repeat center center fixed; */
/*       -webkit-background-size: cover;*/
/*       -moz-background-size: cover;*/
/*       -o-background-size: cover;*/
/*       background-size: cover;*/
/*       opacity: 0.7;*/
/*     } */
/*     </style>*/
/* */
/* */
/* </head>*/
/* */
/* <body>*/
/*   <div class="container">*/
/*        */
/*     </div>*/
/*     <div class="card card-login mx-auto mt-5" style="margin-top: 5px;">*/
/*       <div class="card-header">Hustar</div>*/
/*       <div class="card-body">*/
/* */
/*         <form >*/
/*           <div class="form-group">*/
/*             <div class="form-label-group">*/
/*               <input type="email" name="email"id="inputEmail" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">*/
/*               <label for="inputEmail">아이디(이메일)</label>*/
/*             </div>*/
/*           </div>*/
/*           <div class="form-group">*/
/*             <div class="form-label-group">*/
/*               <input type="password" name ="pass" id="inputPassword" class="form-control" placeholder="Password" required="required">*/
/*               <label for="inputPassword">비밀번호</label>*/
/*             </div>*/
/*           </div>*/
/*           <div class="form-group">*/
/*             <div class="checkbox">*/
/*               <label>*/
/*                 <input type="checkbox" value="remember-me">*/
/*                 비밀번호 자동저장*/
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
/*                     alert("로그인 성공했습니다!!");*/
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
/*           <div style="margin-top: 15px;">*/
/*           <a class="d-block small" href="/signup/forgotpassword">비밀번호 찾기</a>*/
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
/* </body  opacity: 0.5;>*/
/* */
/* </html>*/
/* */
