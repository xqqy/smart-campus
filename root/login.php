<!DOCTYPE HTML>
<head>
	<meta charset="UTF-8">  
<title>登录</title>
</head>
	<style>
		.small{
		text-align: center;
		padding:1rem;
		border: 1px solid black;
		background-color: snow /*#ff9a9a*/;
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
        background-color: #ff0000;   
    }   
</style>

<div class="small">
<?php
$con =new mysqli("localhost","register","registerpswdbjsdfz","MAIN");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");}
$con->query('set names utf8');

if($_POST["UID"]==null){echo "Entry a UID!";}/*UID NULL CHECK*/
else {
$sql = "select * from ADMIN where UID='".$_POST["UID"]."'";/*select things*/
$result = $con->query($sql);
$row =  $result->fetch_assoc();

//echo "sqlUID=".$row['UID']."sqlPSWD=".$row['PSWD'];

if($row['PSWD']==null){echo "Error!<br />NO USERS FIND!<br />";
	echo "<a href='index.html'><button>Try again!</button></a><br />";
	echo "<a href='mailto:tuanwei@bjsdfz.com?subject=bad login!'><button>Call us for help</button></a><br />";}/*echo if no users*/

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

	else{echo "ERROR!<br />Wrong Password<br />";
	echo "<a href='index.html'><button>Try again!</button></a><br />";
	echo "<a href='mailto:tuanwei@bjsdfz.com?subject=bad admin!'><button>Call us for help</button></a><br />";}}}

$con->close();
?>
</div>

<!--echo entry-->
<div style="color: #fff;">
postUID:<?php echo $_POST["UID"]." "; ?>
postPSWD:<?php echo $_POST["PSWD"]; ?><br />
postphppswd:<?php echo password_hash($_POST["PSWD"],PASSWORD_DEFAULT);?>
</div>
<title>Admin system</title>
