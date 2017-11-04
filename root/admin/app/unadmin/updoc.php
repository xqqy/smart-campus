<?php

if($_POST['pswd']!="tuan2017"){die("密码错误");}

$con =new mysqli("localhost","register","registerpswdbjsdfz","MAIN");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");;}
$con->query("set names utf8");

if(empty($_COOKIE['UID']) or empty($_COOKIE['TOKEN'])){die("请先登录(7)");}/*登录验证*/
        $sql = "SELECT * FROM ADMIN WHERE UID='".$_COOKIE["UID"]."'";
	    $result = $con->query($sql);
	    $row =  $result->fetch_assoc();
    if($row['TOKEN']!=$_COOKIE['TOKEN']){die("请先登录(11)");}

	$at =new mysqli("localhost","ativep","K3LKLv6tQkAaFLaa","ATIVEP");/*connect mysql*/
	if ($con->connect_error){die("Could not connect!");}
	$at->query('set names utf8');

			$sqlauzn="DELETE FROM `AUZN` WHERE UID='".$_POST['UID']."'";
			$sqllogin="DELETE FROM `ADMIN` WHERE UID='".$_POST['UID']."'";
			$sqlativep="DROP TABLE `".$_POST['UID']."`";
			
			$resultative=$at->query($sqlativep);
			$resultauzn=$con->query($sqlauzn);
			$resultlogin=$con->query($sqllogin);
		if($resultlogin and $resultauzn and $resultative){echo "设置成功<br />";}else{echo "设置失败<br />login:".$resultlogin."auzn:".$resultauzn."ative:".$resultative;}
		
?>
<a href="/root/admin/index.php"><button>返回</button></a>