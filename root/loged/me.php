<!DOCTYPE html>
<title>服务目录</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<html>

<body style="background-color:#161719;">
<div style="float:left;width:200px;height:auto;color:snow;">

	<?php 
$con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");}
$con->query('set names utf8');
if(empty($_COOKIE['UID'])){die("请先登录(13)");}

	$sql = "SELECT * FROM ADMIN WHERE UID='".$_COOKIE["UID"]."'";
	$result = $con->query($sql);
	$row =  $result->fetch_assoc();
	if(!$_COOKIE["UID"] or $row['TOKEN']!=$_COOKIE['TOKEN']){echo "请先登录(18)";}
	else {echo "Welcome!";
	echo $row['NAME'];}
	?>
<a target="_parent" style="color:aqua;" href="/root/logout.php">登出</a><br />

</div>

</body>
</html>
</meta>
