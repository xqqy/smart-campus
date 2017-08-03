<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>志愿附中</title>

<script>(function(i,s,o,g,r,a,m){i["DaoVoiceObject"]=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;a.charset="utf-8";m.parentNode.insertBefore(a,m)})(window,document,"script",('https:' == document.location.protocol ? 'https:' : 'http:') + "//widget.daovoice.io/widget/96c356a7.js","daovoice")</script>


</head>
	<style>
		.small{
		text-align: center;
		padding:1rem;
		background-color: snow/*#a1e9dc  c5c8ff*/;
		padding:10px;
        	position: absolute;   
        	top: 50%;   
        	left:50%;   
        	margin: -170px 0 0 -170px;   
        	width: 300px;   
        	height: 300px;   
		box-shadow:0px 10px 20px /*#c0c3ff*/;
		font-family:Adobe Heiti Std R;
		font-size:40px;
		text-decoration: none;}
body{   
        width: 100%;   
        height: 100%;   
        font-family: 'Open Sans',sans-serif;   
        margin: 0;   
        background-color: #7100c8/*7479e0*/;   
    }   
</style>
<body>



<div class="small">
<?php
$con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql*/
if ($con->connect_error)
  {
  die('Could not connect: ');
  }
$con->query('set names utf8');

$conn =new mysqli("localhost","zyfz","zyfzalwayswithyou","ZYFZ");/*connect mysql*/
if ($conn->connect_error)
  {
  die('Could not connect: ' );
  }
$conn->query('set names utf8');


if(!$_COOKIE["UID"]){echo "请先登录";}else{
$sql = "SELECT * FROM LOGIN WHERE UID=".$_COOKIE["UID"];
$result = $con->query($sql);
$row =  $result->fetch_assoc();
if( $row['TOKEN']!=$_COOKIE['TOKEN']){echo "请先登录";}else{//登录验证

$sql = "SELECT * FROM ZYFZMAIN WHERE UID=".$_COOKIE["UID"];//查询
$result = $conn->query($sql);
$row =  $result->fetch_assoc();

  echo "你有".$row['TI']."校内学时". "<br /> 你有". $row['TS']."校外学时" ;//返回
  echo "<br />";

}}
$con->close();
$conn->close();
?>
<p style="font-size:25px">感谢使用查询系统</p>
<p style="font-size:15px">2017校团委志愿者部</p>
</meta>
</div>
</body>
</html>
