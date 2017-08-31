<?php

$con =new mysqli("localhost","register","registerpswdbjsdfz","MAIN");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");;}
$con->query("set names utf8");

if(empty($_COOKIE['UID']) or empty($_COOKIE['TOKEN'])){die("请先登录(7)");}/*登录验证*/
        $sql = "SELECT * FROM ADMIN WHERE UID='".$_COOKIE["UID"]."'";
	    $result = $con->query($sql);
	    $row =  $result->fetch_assoc();
    if($row['TOKEN']!=$_COOKIE['TOKEN']){die("请先登录(11)");}



$xs =new mysqli("localhost","zyfz","zyfzalwayswithyou","ZYFZ");/*connect mysql*/
if ($xs->connect_error){die("Could not connect!");} 
$xs->query('set names utf8');

// 允许上传的图片后缀
$allowedExts = array("txt", "csv","");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);     // 获取文件后缀名
if ($_FILES["file"]["size"] < 2048000  and in_array($extension, $allowedExts))
{
	if ($_FILES["file"]["error"] > 0)
	{
		echo "错误(28)：: " . $_FILES["file"]["error"] . "<br>";
	}
	else
	{
		
		// 读取文件并开始批量导入
		
		$file = fopen($_FILES["file"]["tmp_name"], "r") or exit("无法打开文件!");
		// 读取文件每一行，直到文件结尾
		while(!feof($file))
		{
			$in=str_getcsv(fgets($file));
			if(!$in[0]){break;}

		$sql = "select * from ZYFZMAIN where UID='".$in[0]."'";/*select things查找原学时*/
                        $result = $xs->query($sql);
                        $row =  $result->fetch_assoc();
                        $ti=$row['TI'];
                        $ts=$row['TS'];
		$nti=$ti+$in[1];
        $nts=$ts+$in[2];

		$sqlxs="UPDATE ZYFZMAIN SET TI='".$nti."',TS='".$nts." 'WHERE UID='".$in[0]."'";/*添加学时*/
		$resultadd=$xs->query($sqlxs);
		
		$t=0;
		$resultdo=false;
		while(!$resultdo and $t<1000000){
		$sql="INSERT INTO ZYFZHSOY(UID,DATE,OTI,OTS,CTI,CTS,OTOR,RND) VALUES ('".$in[0]."','".date('Y-m-d h:i:s',time())."','".$ti."','".$ts."','".$in[1]."','".$in[2]."','".$_COOKIE['UID']."','".mt_rand()."')";
		$resultdo = $xs->query($sql);/*保存记录*/}

		if($resultadd){echo "<br />".$in[0]."设置成功";}else{echo "<br />".$in[0]."设置失败(66)";}
		}
		if(!$resultdo){echo $in[0]."更改记录保存失败(68)";}
		fclose($file);

			}
}
else
{
	echo "非法的文件格式或文件过大(75)";
}
?>
