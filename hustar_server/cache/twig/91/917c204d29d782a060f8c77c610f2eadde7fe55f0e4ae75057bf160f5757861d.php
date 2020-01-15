<?php

/* sign_up.html */
class __TwigTemplate_5ba9e9c7da36c9e827b694f52913e2a96ab14d0933d9d317810164ef76d17c9a extends Twig_Template
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
  <title>C team_summer_IoT_Sign_up</title>
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
  <!-- Font Awesome 추가 -->
  <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css\">
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

  <!-- text field check -->
\t<script>
\t\tfunction check(ff){
\t\t\tif(ff.id.value==\"\"){
\t\t\t\talert(\"Enter your email address\");
\t\t\t\tff.id.focus();
\t\t\t\treturn false;
\t\t\t}
\t\t\tif(ff.name.value==\"\"){
\t\t\t\talert(\"Enter your name\");
\t\t\t\tff.name.focus();
\t\t\t\treturn false;
\t\t\t}
\t\t\tif(ff.password.value==\"\"){
\t\t\t\talert(\"Enter your password\");
\t\t\t\tff.password.focus();
\t\t\t\treturn false;
\t\t\t}
\t\t\tif(ff.re_password.value==\"\"){
\t\t\t\talert(\"Enter your confirm password\");
\t\t\t\tff.re_password.focus();
\t\t\t\treturn false;
\t\t\t}
\t\t\tif(ff.re_password.value!=ff.password.value){
\t\t\t\talert(\"Check those passwords\");
\t\t\t\tff.re_password.focus();
\t\t\t\treturn false;
\t\t\t}\t\t\t
\t\t\tif(ff.birth.value==\"\"){
\t\t\t\talert(\"Enter your birth\");
\t\t\t\tff.birth.focus();
\t\t\t\treturn false;
\t\t\t}\t\t
\t\t
\t\t\treturn true;
\t\t}

// 버튼 동작
// 0 : 다음 1: 인증확인 2: 등록버튼
\t\tfunction insert(val){
\t\t\tff=document.sign_in_form;
\t\t\t//다음
\t\t\tif(val == 0){
\t\t\t\talert(\"다음버튼\");
\t\t\t}
\t\t\t//인증확인
\t\t\tif(val == 1){
\t\t\t\talert(\"인증버튼\");
\t\t\t}
\t\t\t//등록버튼
\t\t\tif(val == 2){
\t\t\t\talert(\"등록버튼\");
\t\t\t\tif(check(ff)==true){
\t\t\t\t\tff.action=\"/signup_proc\";
\t\t\t\t\tff.submit();
\t\t\t\t}else{
\t\t\t\t\treturn;
\t\t\t\t}
\t\t\t}
\t\t}
\t</script>
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
        <!-- 내용 -->
\t\t<div class=\"login-box\">
\t\t  <!-- 로그인 로고 -->
\t\t  <div class = \"login-logo\">
\t\t\t<b>Create Account</b>
\t\t  </div>
\t\t  <div class=\"login-box-body\">
\t\t    <!-- <p class=\"login-box-msg\">Create Account</p> -->

\t\t\t<!-- 세부 내용 -->

\t\t    <form name=\"sign_in_form\" method=\"POST\">
\t\t\t  <!-- 메일 입력 -->
\t\t\t  <div class=\"form-group has-feedback\">
\t\t\t\t<input type=\"email\" name =\"id\" id=\"id\" class=\"form-control\" placeholder=\"Email address\">
\t\t\t\t<span class=\"glyphicon glyphicon-envelope form-control-feedback\"></span>
\t\t\t  </div>
\t\t\t  <!-- 이메일 인증, 확인 버튼 -->
\t\t\t  <div class = \"row\" style=\"margin-bottom: 15px;\">
\t\t\t\t<div class=\"col-xs-4\" style=\"width: fit-content;float: right;padding-left: 3px;\">
\t\t\t\t\t<button type=\"button\" class=\"btn btn-primary btn-block btn-flat\" onclick = \"insert(0)\">Next</button>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-xs-4\" style=\"width: fit-content;float:  right;padding-right: 0px;\">
\t\t\t\t\t<button type=\"button\" class=\"btn btn-primary btn-block btn-flat\" onclick = \"insert(1)\">Verify</button>
\t\t\t\t</div>\t\t\t\t
\t\t\t  </div>
\t\t\t\t 
\t\t\t  <!-- 이메일 확인 했으면 추가 입력창 출력 아니면 출력 안함 -->
\t\t\t  <?php
\t\t\t\t//if()
\t\t\t  ?>
\t\t\t  <!-- 이름 -->
\t\t\t  <div class=\"form-group has-feedback\">
\t\t\t\t<input type=\"text\" id=\"name\" name =\"name\" class=\"form-control\" placeholder=\"Full name\">
\t\t\t\t<span class=\"glyphicon glyphicon-user form-control-feedback\"></span>
\t\t\t  </div>
\t\t\t  <!-- 비번 -->
\t\t\t  <div class=\"form-group has-feedback\">
\t\t\t\t<input type=\"password\" id=\"password\" name=\"password\" class=\"form-control\" placeholder=\"Password\">
\t\t\t\t<span class=\"glyphicon glyphicon-lock form-control-feedback\"></span>
\t\t\t  </div>
\t\t\t  <!-- 비번 확인 -->
\t\t\t  <div class=\"form-group has-feedback\">
\t\t\t\t<input type=\"password\" id=\"re_password\" name=\"re_password\" class=\"form-control\" placeholder=\"Confirm password\">
\t\t\t\t<span class=\"glyphicon glyphicon-log-in form-control-feedback\"></span>
\t\t\t  </div>
\t\t\t  <!-- 생일, 성별 -->
\t\t\t  <div class = \"row\" style=\"margin-bottom: 15px; margin-left: 0px; margin-right: 0px;\">
\t\t\t\t<div class=\"col-xs-8\" style=\"width:fit-content;padding-right: 10px;padding-left: 1px;border: 1px solid #ccc;padding-top: 1px;padding-bottom: 1px;margin-right: 2px;background: white;\">
\t\t\t\t\t<input type=\"date\" name = \"birth\" id = \"birth\" style=\"border: none;padding-top: 6px;padding-bottom: 6px;width: 116px;\">\t\t\t\t\t
\t\t\t\t\t<span class=\"fa fa-calendar\"></span>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-xs-4\" style=\"width: 172px;border: 1px solid #ccc;padding-top: 1px;padding-bottom: 1px;padding-left: 3px;padding-right: 0px;\">
\t\t\t\t\t<div style=\"border: none;padding-top: 6px;padding-bottom: 6px;padding-right: 0px;padding-left: 0px;background: white;\">
\t\t\t\t\t\t<input type=\"radio\" name =\"gender\" value ='0'>Male
\t\t\t\t\t\t<input type=\"radio\" name =\"gender\" value ='1'>Female
\t\t\t\t\t\t<span class=\"fa fa-venus-mars fa-lg\" style=\"padding-left: 20px;\"></span>
\t\t\t\t\t</div>\t\t\t\t\t
\t\t\t\t</div>
\t\t\t  </div>
\t\t\t  <!-- emergency call -->
\t\t\t  <div class=\"form-group has-feedback\">
\t\t\t\t<div>
\t\t\t\t<input type=\"phone\" name =\"emergency\" id=\"emergency\" class=\"form-control\" placeholder=\"emergency call\">
\t\t\t\t<span class=\"fa fa-phone\"></span></div>
\t\t\t  </div>

\t\t\t  <div class=\"row\">
\t\t\t\t<div class=\"col-xs-8\">
\t\t\t\t  <div class=\"checkbox icheck\">
\t\t\t\t  <!-- 약관 동의
\t\t\t\t\t<label>
\t\t\t\t\t  <input type=\"checkbox\"> I agree to the <a href=\"#\">terms</a>
\t\t\t\t\t</label>
\t\t\t\t\t-->
\t\t\t\t  </div>
\t\t\t\t</div>
\t\t\t\t<!-- /.col -->
\t\t\t\t
\t\t\t\t<div class=\"col-xs-4\">
\t\t\t\t  <button type=\"button\" id=\"btnSubmit\" class=\"btn btn-primary btn-block btn-flat\" onclick = \"insert(2)\">Register</button>
\t\t\t\t</div>
\t\t\t\t<!-- /.col -->
\t\t\t  </div>
\t\t\t</form>\t\t\t
\t\t  </div>
\t\t  <!-- /.form-box -->
\t\t</div>
\t\t<!-- /.register-box -->
      </div>
    </div>

 

    

  <div class=\"footer\">
    <div class=\"container\">
      <div class=\"love\">
        <p><a href=\"http://qi.ucsd.edu/\">QI institute UCSD</a></p>
      </div>
    </div>
  </div>

<!-- POST value to make JSON -->
<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>

<script type=\"text/javascript\">
\$(document).ready(function() {
\t\$(\"#btnSubmit\").on('click',function(){
\t\talert(\"sign_up_btn_clicked\");

\t\tvar formData = {
\t\t\t\"id\": \$('input[name=id]').val(),
\t\t\t\"name\": \$('input[name=name]').val(),
\t\t\t\"password\": \$('input[name=password]').val(),
\t\t\t\"birth\": \$('input[name=birth]').val(),
\t\t\t\"gender\": \$('input[name=gender]:checked').val(),
\t\t\t\"emergency\": \$('input[name=emergency]').val()
\t\t};

\t\tconst serialize_form = form => JSON.stringify(formData);

\t\t//json이 보낼 파일
\t\tconst json = serialize_form(this);
\t\tconsole.log(json);\t\t
\t\t
\t\t\$.ajax({
\t\t\turl: 'http://192.168.33.99/signup_proc',
\t\t\tdata: json,
\t\t\ttype: \"POST\",
\t\t\tdataType: 'json',
\t\t\tsuccess : function(data, status, xhr) { 
\t\t\t\tconsole.log(data); 
\t\t\t}
\t\t})
\t\t
\t});
});
  
</script>
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
        return "sign_up.html";
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
/*   <title>C team_summer_IoT_Sign_up</title>*/
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
/*   <!-- Font Awesome 추가 -->*/
/*   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">*/
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
/*   <!-- text field check -->*/
/* 	<script>*/
/* 		function check(ff){*/
/* 			if(ff.id.value==""){*/
/* 				alert("Enter your email address");*/
/* 				ff.id.focus();*/
/* 				return false;*/
/* 			}*/
/* 			if(ff.name.value==""){*/
/* 				alert("Enter your name");*/
/* 				ff.name.focus();*/
/* 				return false;*/
/* 			}*/
/* 			if(ff.password.value==""){*/
/* 				alert("Enter your password");*/
/* 				ff.password.focus();*/
/* 				return false;*/
/* 			}*/
/* 			if(ff.re_password.value==""){*/
/* 				alert("Enter your confirm password");*/
/* 				ff.re_password.focus();*/
/* 				return false;*/
/* 			}*/
/* 			if(ff.re_password.value!=ff.password.value){*/
/* 				alert("Check those passwords");*/
/* 				ff.re_password.focus();*/
/* 				return false;*/
/* 			}			*/
/* 			if(ff.birth.value==""){*/
/* 				alert("Enter your birth");*/
/* 				ff.birth.focus();*/
/* 				return false;*/
/* 			}		*/
/* 		*/
/* 			return true;*/
/* 		}*/
/* */
/* // 버튼 동작*/
/* // 0 : 다음 1: 인증확인 2: 등록버튼*/
/* 		function insert(val){*/
/* 			ff=document.sign_in_form;*/
/* 			//다음*/
/* 			if(val == 0){*/
/* 				alert("다음버튼");*/
/* 			}*/
/* 			//인증확인*/
/* 			if(val == 1){*/
/* 				alert("인증버튼");*/
/* 			}*/
/* 			//등록버튼*/
/* 			if(val == 2){*/
/* 				alert("등록버튼");*/
/* 				if(check(ff)==true){*/
/* 					ff.action="/signup_proc";*/
/* 					ff.submit();*/
/* 				}else{*/
/* 					return;*/
/* 				}*/
/* 			}*/
/* 		}*/
/* 	</script>*/
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
/*         <!-- 내용 -->*/
/* 		<div class="login-box">*/
/* 		  <!-- 로그인 로고 -->*/
/* 		  <div class = "login-logo">*/
/* 			<b>Create Account</b>*/
/* 		  </div>*/
/* 		  <div class="login-box-body">*/
/* 		    <!-- <p class="login-box-msg">Create Account</p> -->*/
/* */
/* 			<!-- 세부 내용 -->*/
/* */
/* 		    <form name="sign_in_form" method="POST">*/
/* 			  <!-- 메일 입력 -->*/
/* 			  <div class="form-group has-feedback">*/
/* 				<input type="email" name ="id" id="id" class="form-control" placeholder="Email address">*/
/* 				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>*/
/* 			  </div>*/
/* 			  <!-- 이메일 인증, 확인 버튼 -->*/
/* 			  <div class = "row" style="margin-bottom: 15px;">*/
/* 				<div class="col-xs-4" style="width: fit-content;float: right;padding-left: 3px;">*/
/* 					<button type="button" class="btn btn-primary btn-block btn-flat" onclick = "insert(0)">Next</button>*/
/* 				</div>*/
/* 				<div class="col-xs-4" style="width: fit-content;float:  right;padding-right: 0px;">*/
/* 					<button type="button" class="btn btn-primary btn-block btn-flat" onclick = "insert(1)">Verify</button>*/
/* 				</div>				*/
/* 			  </div>*/
/* 				 */
/* 			  <!-- 이메일 확인 했으면 추가 입력창 출력 아니면 출력 안함 -->*/
/* 			  <?php*/
/* 				//if()*/
/* 			  ?>*/
/* 			  <!-- 이름 -->*/
/* 			  <div class="form-group has-feedback">*/
/* 				<input type="text" id="name" name ="name" class="form-control" placeholder="Full name">*/
/* 				<span class="glyphicon glyphicon-user form-control-feedback"></span>*/
/* 			  </div>*/
/* 			  <!-- 비번 -->*/
/* 			  <div class="form-group has-feedback">*/
/* 				<input type="password" id="password" name="password" class="form-control" placeholder="Password">*/
/* 				<span class="glyphicon glyphicon-lock form-control-feedback"></span>*/
/* 			  </div>*/
/* 			  <!-- 비번 확인 -->*/
/* 			  <div class="form-group has-feedback">*/
/* 				<input type="password" id="re_password" name="re_password" class="form-control" placeholder="Confirm password">*/
/* 				<span class="glyphicon glyphicon-log-in form-control-feedback"></span>*/
/* 			  </div>*/
/* 			  <!-- 생일, 성별 -->*/
/* 			  <div class = "row" style="margin-bottom: 15px; margin-left: 0px; margin-right: 0px;">*/
/* 				<div class="col-xs-8" style="width:fit-content;padding-right: 10px;padding-left: 1px;border: 1px solid #ccc;padding-top: 1px;padding-bottom: 1px;margin-right: 2px;background: white;">*/
/* 					<input type="date" name = "birth" id = "birth" style="border: none;padding-top: 6px;padding-bottom: 6px;width: 116px;">					*/
/* 					<span class="fa fa-calendar"></span>*/
/* 				</div>*/
/* 				<div class="col-xs-4" style="width: 172px;border: 1px solid #ccc;padding-top: 1px;padding-bottom: 1px;padding-left: 3px;padding-right: 0px;">*/
/* 					<div style="border: none;padding-top: 6px;padding-bottom: 6px;padding-right: 0px;padding-left: 0px;background: white;">*/
/* 						<input type="radio" name ="gender" value ='0'>Male*/
/* 						<input type="radio" name ="gender" value ='1'>Female*/
/* 						<span class="fa fa-venus-mars fa-lg" style="padding-left: 20px;"></span>*/
/* 					</div>					*/
/* 				</div>*/
/* 			  </div>*/
/* 			  <!-- emergency call -->*/
/* 			  <div class="form-group has-feedback">*/
/* 				<div>*/
/* 				<input type="phone" name ="emergency" id="emergency" class="form-control" placeholder="emergency call">*/
/* 				<span class="fa fa-phone"></span></div>*/
/* 			  </div>*/
/* */
/* 			  <div class="row">*/
/* 				<div class="col-xs-8">*/
/* 				  <div class="checkbox icheck">*/
/* 				  <!-- 약관 동의*/
/* 					<label>*/
/* 					  <input type="checkbox"> I agree to the <a href="#">terms</a>*/
/* 					</label>*/
/* 					-->*/
/* 				  </div>*/
/* 				</div>*/
/* 				<!-- /.col -->*/
/* 				*/
/* 				<div class="col-xs-4">*/
/* 				  <button type="button" id="btnSubmit" class="btn btn-primary btn-block btn-flat" onclick = "insert(2)">Register</button>*/
/* 				</div>*/
/* 				<!-- /.col -->*/
/* 			  </div>*/
/* 			</form>			*/
/* 		  </div>*/
/* 		  <!-- /.form-box -->*/
/* 		</div>*/
/* 		<!-- /.register-box -->*/
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
/* <!-- POST value to make JSON -->*/
/* <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>*/
/* */
/* <script type="text/javascript">*/
/* $(document).ready(function() {*/
/* 	$("#btnSubmit").on('click',function(){*/
/* 		alert("sign_up_btn_clicked");*/
/* */
/* 		var formData = {*/
/* 			"id": $('input[name=id]').val(),*/
/* 			"name": $('input[name=name]').val(),*/
/* 			"password": $('input[name=password]').val(),*/
/* 			"birth": $('input[name=birth]').val(),*/
/* 			"gender": $('input[name=gender]:checked').val(),*/
/* 			"emergency": $('input[name=emergency]').val()*/
/* 		};*/
/* */
/* 		const serialize_form = form => JSON.stringify(formData);*/
/* */
/* 		//json이 보낼 파일*/
/* 		const json = serialize_form(this);*/
/* 		console.log(json);		*/
/* 		*/
/* 		$.ajax({*/
/* 			url: 'http://192.168.33.99/signup_proc',*/
/* 			data: json,*/
/* 			type: "POST",*/
/* 			dataType: 'json',*/
/* 			success : function(data, status, xhr) { */
/* 				console.log(data); */
/* 			}*/
/* 		})*/
/* 		*/
/* 	});*/
/* });*/
/*   */
/* </script>*/
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
