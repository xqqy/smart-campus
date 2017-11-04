<?php   
$con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");}

$push = new mysqli("localhost", "push", "5TPlpIGEX9Hy8xCC", "PUSH");
/*connect mysql*/
if ($push->connect_error) {
    die("Could not connect!(29)");
}
$push->query('set names utf8');
$con->query('set names utf8');

$sql = "select * from AUZN where UID='".$_COOKIE["UID"]."'";/*select things*/
$result = $con->query($sql);
$row =  $result->fetch_assoc();
if($row['PUSH']!=1){die("您没有使用此程序的权限！");}

if(empty($_COOKIE['UID']) or empty($_COOKIE['TOKEN'])){die("请先登录(23)");}/*登录验证*/
        $sql = "SELECT * FROM ADMIN WHERE UID='".$_COOKIE["UID"]."'";
	    $result = $con->query($sql);
	    $row =  $result->fetch_assoc();
    if($row['TOKEN']!=$_COOKIE['TOKEN']){die("请先登录(27)");}

    $resultdo=false;//插入消息
    $t=0;
    while (!$resultdo and $t < 1000000) {
        $rand=mt_rand();
        $sql = "INSERT INTO `PUSHMSGE`(`NUM`, `LINK`, `TITLE`, `INFO`,`TIME`) VALUES ('".$rand."','".$_POST['LINK']."','".$_POST['TITLE']."','".$_POST['INFO']."','".time()."')";
        $resultdo = $push->query($sql);
        /*保存记录*/
    }


    $now=0;
    $UID=str_getcsv($_POST['UID']);
    $a=count($UID);

    while($now<$a){//为每个人更新字符串
    $sql = "select * from LOGIN where UID='" . $UID[$now] . "'";
    /*select things*/
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    $name = $row['NAME'];
    if (empty($name)) {
        die("查无此人(22)");
    }


    
    $push->query('set names utf8');

    $sql="SELECT * FROM `PUSHMAIN` WHERE UID='".$UID[$now]."'";
    $result=$push->query($sql);
    $row=$result->fetch_assoc();
    $csv=$row['NUM'];

    if($csv==""){$csv='"'.$rand.'"';}else{$csv.=',"'.$rand.'"';}
    
        $sql="UPDATE `PUSHMAIN` SET `NUM`='".$csv."' WHERE UID='".$UID[$now]."'";
        if($push->query($sql)){echo "更改字符串成功<>";}else{echo "更改字符串失败（50）".$UID[$now]."<>";}
    $now+=1;
    }





    if(!$resultdo){echo "插入消息失败（45）";}else{echo "插入消息成功";}

    $outdate=time()-604800;
    $sql="DELETE FROM `PUSHMSGE` WHERE `TIME`<".$outdate;
    $push->query($sql);
?>