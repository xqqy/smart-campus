<?php

if(!is_numeric($_COOKIE['ATID'])){die("非法输入(5)");}

$con =new mysqli("localhost","register","registerpswdbjsdfz","MAIN");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");;}
$con->query("set names utf8");

if(empty($_COOKIE['UID']) or empty($_COOKIE['TOKEN'])){die("请先登录(7)");}/*登录验证*/
        $sql = "SELECT * FROM ADMIN WHERE UID='".$_COOKIE["UID"]."'";
	    $result = $con->query($sql);
	    $row =  $result->fetch_assoc();
    if($row['TOKEN']!=$_COOKIE['TOKEN']){die("请先登录(11)");}

// 允许上传的图片后缀
$allowedExts = array("zip","ZIP");
$temp = explode(".", $_FILES["ative"]["name"]);
$extension = end($temp);     // 获取文件后缀名
if ($_FILES["ative"]["size"] < 2097152  and in_array($extension, $allowedExts))
{
	if ($_FILES["ative"]["error"] > 0)
	{
		echo "错误(31)：: " . $_FILES["ative"]["error"];
	}
	else
	{
		$zip=new ZipArchive;
		$doc=$zip->open($_FILES["ative"]["tmp_name"]);

if ($doc === TRUE) {
    //解压缩到test文件夹
	$result=$zip->extractTo("../doc/".$_COOKIE['ATID']."/");
	if($result){echo '管理页面更新完成';}else{echo "管理页面解压缩失败";}
    $zip->close();
} else {
    echo '管理页面打开失败, code:' . $res;
} 
	}
}
else
{
	echo "非法的文件格式或文件过大";
}
?>
