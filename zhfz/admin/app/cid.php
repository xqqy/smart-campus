<!DOCTYPE HTML>
<head>
	<title>更改学号</title>
	<meta charset="UTF-8">

	<style>
		.small{
		text-align: center;
		padding:1rem;
		border: 1px solid black;
		background-color: #d298ff;
		padding:10px;
        	position: absolute;   
        	top: 50%;   
        	left:50%;   
        	margin: -170px 0 0 -170px;   
        	width: 300px;   
        	height: 300px;   
		box-shadow:0px 10px 20px ;
		font-family:Adobe Heiti Std R;
		font-size:30px;}
body{   
        width: 100%;   
        height: 100%;   
        font-family: 'Open Sans',sans-serif;   
        margin: 0;   
	background-color: #7100c8;
    }   
</style>
</head>

<div class="small">
    <?php
$con =new mysqli("localhost","register","registerpswdbjsdfz","MAIN");/*connect mysql*/
if ($con->connect_error){echo 'Could not connect:';}

if(!$_COOKIE["UID"]){echo "请先登录";}else{
$sql = "select * from LOGIN where UID='".$_COOKIE["UID"]."'";/*select things*/
$result = $con->query($sql);
$row =  $result->fetch_assoc();
if($row['TOKEN']!=$_COOKIE['TOKEN']){echo"请先登录";}else{

        $sql="UPDATE `LOGIN` SET `CID`='".$_COOKIE['ADD']."' WHERE UID='".$_COOKIE['UID']."'";
        $result = $con->query($sql);
        if($result==1){echo "成功!";}else{echo"失败";}

    }}?>
</div>

<!--echo entry-->
<div style="color: #fff;">
postADD:<?php echo $_COOKIE["ADD"]." "; ?>
</div>
<title>Cid system</title>
