<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>团籍管理</title>
</head>
	<style>
		.small{
		text-align: center;
		padding:1rem;
		border: 1px solid black;
		height: 20rem;
		width: 20rem;
		background-color:#A1A0A3;
		font-family:Adobe Heiti Std R;
		font-size:2rem;
		text-decoration: none; 
		text-align: center;
		margin: 0 auto;}
</style>
<body>
<div class="small">
<?php
$con =new mysqli("localhost","zhtj","zhtjalwayswithyou","ZHTJ");/*connect mysql*/
if ($con->connect_error)
  {
  die('Could not connect: ' . mysql_error());
  }
$con->query('set names utf8');


$sql = "SELECT * FROM ZHTJMAIN WHERE UID=".$_COOKIE["UID"];
$result = $con->query($sql);
$row =  $result->fetch_assoc();

  echo "你的返回值是:".$row['NUM'] . "<br />";
$num=$row['NUM'];

$sql = "SELECT * FROM ZHTJRTUN WHERE NUM=".$num;
$result=$con->query($sql);
$row =  $result->fetch_assoc();

	if($row['FASHION']!=null){echo $row['FASHION'];}
else{echo "未知返回值，请联系校团委";}

$con->close()
?>
</meta>
</div>
</body>
</html>
