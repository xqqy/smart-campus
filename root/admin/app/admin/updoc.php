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

			$sqlauzn="INSERT INTO `AUZN`(`UID`, `ZYFZ`, `PUSH`) VALUES ('".$_POST['UID']."','".$_POST['zyfz']."','".$_POST['push']."')";
			$sqllogin="INSERT INTO `ADMIN`(`UID`, `PSWD`, `TOKEN`, `NAME`) VALUES ('".$_POST['UID']."','".'$2y$10$vgInweVwkJZIjvPPe0Vk3ufiC.KlsSQ7wkAyEORA6zugXtbeqBgn6'."','','".$_POST['name']."')";
			$sqlativep="CREATE TABLE `ATIVEP`.`".$_POST['UID']."` ( `ATID` VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '活动编号' , `VER` VARCHAR(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '是否使用模板' ) ENGINE = InnoDB";
			$sqlativep2="INSERT INTO `".$_POST['UID']."` (`ATID`, `VER`) VALUES ('00000', '0');";
			$resultative=$at->query($sqlativep);
			$resultauzn=$con->query($sqlauzn);
		$resultlogin=$con->query($sqllogin);
		if($resultlogin and $resultauzn and $resultative){echo "设置成功<br />";}else{echo "设置失败<br />login:".$resultlogin."auzn:".$resultauzn."ative:".$resultative;}
		
?>
<a href="/root/admin/index.php"><button>返回</button></a>