<!doctype html>
<html>

<script>(function(i,s,o,g,r,a,m){i["DaoVoiceObject"]=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;a.charset="utf-8";m.parentNode.insertBefore(a,m)})(window,document,"script",('https:' == document.location.protocol ? 'https:' : 'http:') + "//widget.daovoice.io/widget/96c356a7.js","daovoice")</script>

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>团籍管理</title>

</head>
	<style>
		.small{
		text-align: center;
		background-color: snow/*#a1e9dc  b4feff*/;
		padding:10px;
        	position: absolute;   
        	top: 50%;   
        	left:50%;   
        	margin: -170px 0 0 -170px;   
        	width: 300px;   
        	height: 300px;   
	
		font-size:40px;
		text-decoration: none;}
body{   
        width: 100%;   
        height: 100%;   
        font-family: 'Open Sans',sans-serif;   
        margin: 0;   
        background-color: #7100c8/*00c1c3*/;   
    }   
</style>

<body>


<div class="small">

<?php
$con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql*/
if ($con->connect_error)
  {
  die('Could not connect:');
  }
$con->query('set names utf8');

$conn =new mysqli("localhost","zhtj","zhtjalwayswithyou","ZHTJ");/*connect mysql*/
if ($conn->connect_error)
  {
  die('Could not connect: ' );
  }
$conn->query('set names utf8');

if(!$_COOKIE["UID"]){echo "请先登录";}else{
$sql = "SELECT * FROM LOGIN WHERE UID=".$_COOKIE["UID"];
$result = $con->query($sql);
$row =  $result->fetch_assoc();
if(!$_COOKIE["UID"] or $row['TOKEN']!=$_COOKIE['TOKEN']){echo "请先登录";}else{//登录验证


$sql = "SELECT * FROM ZHTJMAIN WHERE UID=".$_COOKIE["UID"];//查找
$result = $conn->query($sql);
$row =  $result->fetch_assoc();

  echo "你的返回值是:".$row['NUM'] . "<br />";//返回
$num=$row['NUM'];

$sql = "SELECT * FROM ZHTJRTUN WHERE NUM=".$num;//查看帮助信息
$result=$conn->query($sql);
$row =  $result->fetch_assoc();

	if($row['FASHION']!=null){echo $row['FASHION'];}
else{echo "未知返回值，请联系校团委";}


}}
$con->close();
$conn->close();
?>

<p style="font-size:25px">感谢使用查询系统</p>
<p style="font-size:15px">2017校团委组织部</p>
</meta>
</div>
</body>
</html>
