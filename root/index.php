

    <!DOCTYPE html>  
    <html>  
    <head>  
        <meta charset="UTF-8">  
        <title>登录</title>  
        <link rel="stylesheet" type="text/css" href="login.css"/>
        <script src="/zhfz/metro/js/sha512.js"></script>
        <script src="http://localhost/zhfz/metro/js/formdata.min.js"></script>
    </head>  
    <body>  
<script>
    if (!!window.ActiveXObject || "ActiveXObject" in window){
    alert('你正在使用IE浏览器，本网页对于IE的支持并不好。建议更换为Firefox或Chrome')}
</script>

        <div id="login">  
            <h1>欢迎</h1>  
            <form method="post" id="form">  
                <input id="uid" type="text" required="required" placeholder="用户名" name="UID"></input>  
                <input id="pswd" type="password" required="required" placeholder="密码" name="PSWD"></input>  
                <button class="sub" type="submit" onclick="mypswd()">登录</button>  
            </form>  

<?php
if(!empty($_POST['PSWD'])){
$con =new mysqli("localhost","register","registerpswdbjsdfz","MAIN");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");}
$con->query('set names utf8');

$sql = "select * from ADMIN where UID='".$_POST["UID"]."'";/*select things*/
$result = $con->query($sql);
$row =  $result->fetch_assoc();

//echo "sqlUID=".$row['UID']."sqlPSWD=".$row['PSWD'];

if($row['PSWD']==null){echo "Error! NO USERS FIND!";}/*echo if no users*/

else{/*check password*/


if(password_verify($_POST['PSWD'],$row['PSWD']))
	{setcookie("UID", $row['UID'], 0);
	$token=password_hash(time(),PASSWORD_DEFAULT);
	setcookie("TOKEN", $token, 0);
	$sql = "UPDATE ADMIN SET TOKEN='".$token."' WHERE UID='".$_POST["UID"]."'";
	$result = $con->query($sql);

	echo "LOGED IN!<br />";
	echo "<script language='javascript'>document.location = '/root/loged/frame.html'</script>";
	echo "<a href='/zhfz/loged/frame.html'>IF your brower does not go next page,click me</a>";}

	else{echo "ERROR!<br />Wrong Password<br />";}
    }

$con->close();}
?>


        </div>  
    </body>
    </html>

<script>
    function mypswd(){
         pswd=document.getElementById("pswd");
         uid=document.getElementById("uid");
        if(pswd.value=="" || uid.value==""){
            window.alert("请输入所有信息");
        }
        else{
        pswd.value=sha512(pswd.value);
        document.getElementById("form").submit();}
    }
</script>

<!--本系统在Apache License2.0协议下开源，您可以在关于页面下载到许可协议。在输入指令页面输入about即可打开-->
<!--This system is open source under Apache License2.0, You can get License in about page,open it by entry "about" in command page-->