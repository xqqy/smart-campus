<?php

if(!is_numeric($_COOKIE['ATID'])){die("非法输入(5)");}

$con =new mysqli("localhost","register","registerpswdbjsdfz","MAIN");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");;}
$con->query("set names utf8");

$at =new mysqli("localhost","ative","activemakeourlifebetter","ATIVE");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");}
$at->query('set names utf8');

if(empty($_COOKIE['UID']) or empty($_COOKIE['TOKEN'])){die("请先登录(7)");}/*登录验证*/
        $sql = "SELECT * FROM ADMIN WHERE UID='".$_COOKIE["UID"]."'";
	    $result = $con->query($sql);
	    $row =  $result->fetch_assoc();
    if($row['TOKEN']!=$_COOKIE['TOKEN']){die("请先登录(11)");}

// 允许上传的图片后缀
$allowedExts = array("txt","csv","");
$temp = explode(".", $_FILES["ative"]["name"]);
$extension = end($temp);     // 获取文件后缀名
if ($_FILES["ative"]["size"] < 2097152  and in_array($extension, $allowedExts))
{
	if ($_FILES["ative"]["error"] > 0)
	{
		echo "错误(31)：: " . $_FILES["people"]["error"] . "<br>";
	}
	else
	{
        $at->query("TRUNCATE `".$_COOKIE['ATID']."P`");
        $p=$at->prepare("INSERT INTO `".$_COOKIE['ATID']."P`(`UID`, `NAME`, `CID`) VALUES (?,?,?)");
        $p->bind_param("sss",$id,$name,$cid);


        $file = fopen($_FILES["ative"]["tmp_name"], "r") or exit("无法打开文件!");
		// 读取文件并开始批量导入
		while(!feof($file))
		{
			$in=str_getcsv(fgets($file));
			if(!$in[0]){break;}
			$id=$in[0];
			$name=$in[1];
			$cid=$in[2];
			$result=$p->execute();
		}
		fclose($file);
echo "人员限制更改成功";
    }
}else{die("非法的文件格式或文件过大");}