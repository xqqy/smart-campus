<?php   
$con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");}

$sql = "select * from AUZN where UID='".$_COOKIE["UID"]."'";/*select things*/
$result = $con->query($sql);
$row =  $result->fetch_assoc();
if($row['PUSH']!=1){die("您没有使用此程序的权限！");}

if(empty($_COOKIE['UID']) or empty($_COOKIE['TOKEN'])){die("请先登录(23)");}/*登录验证*/
        $sql = "SELECT * FROM ADMIN WHERE UID='".$_COOKIE["UID"]."'";
	    $result = $con->query($sql);
	    $row =  $result->fetch_assoc();
    if($row['TOKEN']!=$_COOKIE['TOKEN']){die("请先登录(27)");}

    $sql = "select * from LOGIN where UID='" . $_POST["UID"] . "'";
    /*select things*/
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    $name = $row['NAME'];
    if (empty($name)) {
        die("查无此人(22)");
    }


    $push = new mysqli("localhost", "push", "5TPlpIGEX9Hy8xCC", "PUSH");
    /*connect mysql*/
    if ($push->connect_error) {
        die("Could not connect!(29)");
    }
    $push->query('set names utf8');

    $sql="SELECT * FROM `PUSHMAIN` WHERE UID='".$_POST['UID']."'";
    $result=$push->query($sql);
    $row=$result->fetch_assoc();
    $csv=$row['NUM'];
    $resultdo=false;
    $t=0;
    while (!$resultdo and $t < 1000000) {
        $rand=mt_rand();
        $sql = "INSERT INTO `PUSHMSGE`(`NUM`, `LINK`, `TITLE`, `INFO`,`TIME`) VALUES ('".$rand."','".$_POST['LINK']."','".$_POST['TITLE']."','".$_POST['INFO']."','".time()."')";
        $resultdo = $push->query($sql);
        /*保存记录*/
    }
    if(!$resultdo){echo "插入消息失败（45）";}else{echo "插入消息成功";}

if($csv==""){$csv='"'.$rand.'"';}else{$csv.=',"'.$rand.'"';}

    $sql="UPDATE `PUSHMAIN` SET `NUM`='".$csv."' WHERE UID='".$_POST['UID']."'";
    if($push->query($sql)){echo "更改字符串成功";}else{echo "更改字符串失败（50）";}


    $outdate=time()-2592000;
    $sql="DELETE FROM `PUSHMSGE` WHERE DATE<".$outdate;
    $push->query($sql);
?>