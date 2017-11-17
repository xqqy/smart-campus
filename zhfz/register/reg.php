<!DOCTYPE HTML>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>register system</title>
</head>
	<style>
body{background-color:skyblue;
width:100%;
height:100%;}
#X{text-align:center;margin:auto;}
</style>
<div id=X>
<table border="1" style="margin:auto;">
	<caption>可能的UID</caption>
	<tr><td>姓名</td><td>UID</td><td>CID</td></tr>

<?php
$con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");}
$con->query('set names utf8');

if($_POST["NAME"]==null){die("<script>alert('输入不能为空!')</script>");}/*UID NULL CHECK*/

$sql = "SELECT `UID`,`NAME`,`CID` FROM `LOGIN` WHERE `NAME` LIKE ?";/*select things*/
$conp = $con->prepare($sql);
$conp->bind_param("s",$_POST['NAME']);
$conp->execute();
$conp->bind_result($UID,$NAME,$CID);

while($conp->fetch()){
echo "<tr><td>".$NAME."</td><td>".$UID."</td><td>".$CID."</td></tr>";
}

$conp->close();
$con->close();
?>

</table>

<p style="font-size:25px">感谢使用查询系统</p>
<p style="font-size:15px">2017校团委智慧系统</p>
<a href="/zhfz/index.php"><button>返回</button></a>
</div>
<!--echo entry-->