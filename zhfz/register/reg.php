<!DOCTYPE HTML>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>register system</title>
</head>
	<style>
		.small{
		text-align: center;
		padding:1rem;
		border: 1px solid black;
		background-color: #abfaff;
		padding:10px;
        	position: absolute;   
        	top: 50%;   
        	left:50%;   
        	margin: -170px 0 0 -170px;   
        	width: 300px;   
        	height: 300px;   
		box-shadow:0px 10px 20px;
		font-family:Adobe Heiti Std R;
		font-size:30px;}
body{   
        width: 100%;   
        height: 100%;   
        font-family: 'Open Sans',sans-serif;   
        margin: 0;   
        background-color: #00cad6;   
    }   
</style>

<div class="small">
<?php
$con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");}

if($_POST["CID"]==null){echo "Entry a CID!";}/*UID NULL CHECK*/
else {
$sql = "select * from LOGIN where CID='".$_POST["CID"]."'";/*select things*/
$result = $con->query($sql);
$row =  $result->fetch_assoc();

//echo "sqlUID=".$row['UID']."sqlPSWD=".$row['PSWD'];

if($row['PSWD']==null){echo "Error!<br />NO USERS FIND!";
	echo "<a href='reg.html'><button>Try again!</button></a><br />";
	echo "<a href='mailto:tuanwei@bjsdfz.com?subject=bad login!'><button>Call us for help</button></a><br />";}/*echo if no users*/

else{echo "你的UID是".$row['UID']."<br />";
	echo"默认密码是123456<br />";}}



$con->close();
?>
<p style="font-size:25px">感谢使用查询系统</p>
<p style="font-size:15px">2017校团委智慧系统</p>
</div>

<!--echo entry-->
<div style="color: #fff;">
postCID:<?php echo $_POST["CID"]." "; ?>
</div>
