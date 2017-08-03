<?php
if(!empty($_POST['PID'])){
$con =new mysqli("localhost","app","rbTZahu47o1xPNVs","APP");/*connect mysql*/
if ($con->connect_error){die("Could not connect! 无法连接");;}

if($_POST["PID"]==null){die("!NO PID 缺少PID");}/*PID NULL CHECK*/

$sql = "select * from LOGIN where PID='".$_POST["PID"]."'";/*select things*/
$result = $con->query($sql);
$row =  $result->fetch_assoc();

//echo "sqlPID=".$row['PID']."sqlPSWD=".$row['PSWD'];

if($row['PSWD']==null){die("Error! NO USERS FIND!错误：没有这个用户");}


if(password_verify($_POST['PSWD'],$row['PSWD']))
	{
        echo $row['CCID'];
    }

	else{echo "ERROR! Wrong Password 抱歉，密码错误";}

$con->close();}
?>