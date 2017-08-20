<!DOCTYPE HTML>
<head>
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
<title>密码设置</title>
<meta charset="UTF-8">  
</head>
<div class="small">
<?php
$con =new mysqli("localhost","register","registerpswdbjsdfz","MAIN");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");;}

if(!$_COOKIE["UID"]){echo "请先登录";}else{


$sql = "select * from ADMIN where UID='".$_COOKIE["UID"]."'";/*select things*/
$result = $con->query($sql);
$row =  $result->fetch_assoc();

/*check password*/
if(password_verify($_POST['OPSWD'],$row['PSWD']))

	{if($_POST["NPSWD"]==$_POST["RPSWD"])
		{$sql="UPDATE ADMIN SET PSWD='". password_hash($_POST["NPSWD"],PASSWORD_DEFAULT) ."' WHERE UID='".$_COOKIE["UID"]."'";
		$result=$con->query($sql);
			if($result)
			{echo "密码更改成功!";}
			else{echo "密码更改失败！(50)";}}
		else{echo "两次输入不一致(51)";}}
	else{echo "原密码错误(52)";}}

$con->close();
?>
</div>

<!--echo entry-->
<div style="color: #fff;">
postUID:<?php echo $_COOKIE["UID"]." "; ?>
postOPSWD<?php echo $_POST["OPSWD"]; ?><br />
postNPSWD:<?php echo $_POST["NPSWD"]; ?><br />
postRPSWD:<?php echo $_POST["RPSWD"];?><br />
phppswd:<?php echo password_hash($_POST['NPSWD'],PASSWORD_DEFAULT);?>
</div>
<title>admin system</title>
