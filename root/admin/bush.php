<!DOCTYPE HTML>
<head>
<meta charset="UTF-8">  
	<style>
		.small{
		text-align: center;
		padding:1rem;
		border: 1px solid black;
		background-color: #48ffc2;
		padding:10px;
        	position: absolute;   
        	top: 50%;   
        	left:50%;   
        	margin: -170px 0 0 -170px;   
        	width: 300px;   
        	height: 300px;   
		box-shadow:0px 10px 20px ;
		
		font-size:30px;}
body{   
        width: 100%;   
        height: 100%;   
           
        margin: 0;   
        background-color: #ff0000;   
    }   
</style>
</head>
<body>

<div class="small">
<?php
$con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");}
$con->query('set names utf8');


$sql = "select * from ADMIN where UID='".$_COOKIE["UID"]."'";/*select things*/
$result = $con->query($sql);
$row =  $result->fetch_assoc();
if($row['TOKEN']==$_COOKIE['TOKEN'] and !is_null($_COOKIE['TOKEN'])){




			$sql = "select * from ABUSH where CMD='".$_POST["CMD"]."'";/*select things*/
			$result = $con->query($sql);
			$row =  $result->fetch_assoc();

			if($row['FAS']==null){echo "Error!<br />NO SUCH COMMAND!<br />";}
			else{
				echo $row['HELP']."<br />";
				echo "<a href='".$row['FAS']."'><button>DO THIS COMMAND</button></a>";
				setcookie("ADD", $_POST['ADD'], 0);}}
else{echo "请先登录(55)";}
				


$con->close();
?>
</div>

<!--echo entry-->
<div style="color: #000;">
cookieUID:<?php echo $_COOKIE["UID"]." "; ?><br />
cookieTOKEN:<?php echo $_COOKIE["TOKEN"]; ?><br />
cookieADD:<?php echo $_POST['ADD']?>
</div>
</body>
