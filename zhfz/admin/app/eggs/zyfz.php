<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>志愿府中</title>
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
$con =new mysqli("localhost","zyfz","zyfzalwayswithyou","ZYFZ");/*connect mysql*/
if ($con->connect_error)
  {
  die('Could not connect: ' . mysql_error());
  }
$con->query('set names utf8');

$sql = "SELECT * FROM ZYFZMAIN WHERE UID=".$_COOKIE["UID"];
$result = $con->query($sql);
$row =  $result->fetch_assoc();

  echo "你的校内学时是：".$row['TI'] . "<br /> 你的校外学时是：" . $row['TS'];
  echo "<br />";

$con->close();
?>
</meta>
</div>
</body>
</html>
