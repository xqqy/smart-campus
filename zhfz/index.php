<!DOCTYPE html>
<html>

<script>(function(i,s,o,g,r,a,m){i["DaoVoiceObject"]=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;a.charset="utf-8";m.parentNode.insertBefore(a,m)})(window,document,"script",('https:' == document.location.protocol ? 'https:' : 'http:') + "//widget.daovoice.io/widget/96c356a7.js","daovoice")</script>

<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Metro, a sleek, intuitive, and powerful framework for faster and easier web development for Windows Metro Style.">
    <meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, metro, front-end, frontend, web development">
    <meta name="author" content="Sergey Pimenov and Metro UI CSS contributors">

    <title>Login</title>

    <link href="metro/css/metro.css" rel="stylesheet">
    <link href="metro/css/metro-icons.css" rel="stylesheet">
    <link href="metro/css/metro-responsive.css" rel="stylesheet">

    <script src="metro/js/sha512.js"></script>
    <script async="" src="metro/js/analytics.js"></script><script src="metro/jquery-2.js"></script>
    <script src="metro/js/metro.js"></script>
 
    <style>
        .login-form {
            width: 25rem;
            height: 18.75rem;
            position: fixed;
            top: 50%;
            margin-top: -9.375rem;
            left: 50%;
            margin-left: -12.5rem;
            background-color: #ffffff;
            opacity: 0;
            -webkit-transform: scale(.8);
            transform: scale(.8);
        }
    </style>

    <script>

        /*
        * Do not use this is a google analytics fro Metro UI CSS
        * */
        if (window.location.hostname !== 'localhost') {

            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-58849249-3', 'auto');
            ga('send', 'pageview');

        }


        $(function(){
            var form = $(".login-form");

            form.css({
                opacity: 1,
                "-webkit-transform": "scale(1)",
                "transform": "scale(1)",
                "-webkit-transition": ".5s",
                "transition": ".5s"
            });
        });
    </script>
</head>
<body style="background-color:#007ad3">

<script>
daovoice('init', {
  app_id: "96c356a7"
});
daovoice('update');</script>

    <div class="login-form padding20 block-shadow" style="opacity: 1; transform: scale(1); transition: all 0.5s ease 0s;">
        <form method="post" id="form">
            <h1 class="text-light">登录</h1>
            <hr class="thin">
            <br>
            <div class="input-control text full-size" data-role="input">
                <label for="user_login">学号</label>

                <input name="UID" required="required" id="user_login" style="padding-right: 42px;" type="text">

            </div>
            <br>
            <br>
            <div class="input-control password full-size" data-role="input">
                <label for="user_password">密码</label>
                <input name="PSWD" required="required" id="user_password" style="padding-right: 42px;" type="password">
            </div>
            <br>
            <br>
            <div class="form-actions">
                <button onclick="mypswd()" type="submit" class="button primary">登录</button>
                <a  href="/zhfz/register/reg.html" ><button type="button"class="button link">找回学号</button></a>
            
<?php
if(!empty($_POST['UID'])){
$con =new mysqli("localhost","register","registerpswdbjsdfz","MAIN");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");;}
$con->query("set names utf8");

if($_POST["UID"]==null){echo "Entry a UID!";}/*UID NULL CHECK*/
else {
$sql = "select * from LOGIN where UID='".$_POST["UID"]."'";/*select things*/
$result = $con->query($sql);
$row =  $result->fetch_assoc();

//echo "sqlUID=".$row['UID']."sqlPSWD=".$row['PSWD'];

if($row['PSWD']==null){echo "Error! NO USERS FIND!错误：没有这个用户 ";}

else{/*check password*/


if(password_verify($_POST['PSWD'],$row['PSWD']))
	{setcookie("UID", $row['UID'], 0);
	$token=password_hash(time(),PASSWORD_DEFAULT);
	setcookie("TOKEN", $token, 0);
	$sql = "UPDATE LOGIN SET TOKEN='".$token."' WHERE UID='".$_POST["UID"]."'";
	$result = $con->query($sql);

	echo "LOGED IN!登录成功！";
	echo "<script language='javascript'>document.location = '/zhfz/loged/frame.html'</script>";
	echo "<a href='/zhfz/loged/frame.html'>IF your brower does not go next page,click me</a>";}

	else{echo "ERROR! Wrong Password 抱歉，密码错误";}}}

$con->close();}
?>

            </div>
        </form>
    </div>

<script>
    function mypswd(){
         pswd=document.getElementById("user_password");
         uid=document.getElementById("user_login");
        if(pswd.value=="" || uid.value==""){
            window.alert("请输入所有信息");
        }
        else{
       
        pswd.value=sha512(pswd.value);
        document.getElementById("form").submit();}
    }    
</script>

</body></html>

<!--本系统在Apache License2.0协议下开源，您可以在关于页面下载到许可协议。在输入指令页面输入about即可打开-->
<!--This system is open source under Apache License2.0, You can get License in about page,open it by entry "about" in command page-->
