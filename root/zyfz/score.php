<?php
$con = new mysqli("localhost", "login", "loginmyphp", "MAIN");
/*connect mysql*/
if ($con->connect_error) {
    die("Could not connect!");
}
$con->query('set names utf8');
$sql = "select * from AUZN where UID='" . $_COOKIE["UID"] . "'";
/*select things*/
$result = $con->query($sql);
$row = $result->fetch_assoc();
if ($row['ZYFZ'] != 1) {
    die("您没有使用此程序的权限！(9)");
}
if (empty($_COOKIE['UID']) or empty($_COOKIE['TOKEN'])) {
    die("请先登录(10)");
}
/*登录验证*/
$sql = "SELECT * FROM ADMIN WHERE UID='" . $_COOKIE["UID"] . "'";
$result = $con->query($sql);
$row = $result->fetch_assoc();
if ($row['TOKEN'] != $_COOKIE['TOKEN']) {
    die("请先登录(14)");
}

$sql = "select * from LOGIN where UID='" . $_POST["UID"] . "'";
/*select things*/
$result = $con->query($sql);
$row = $result->fetch_assoc();
$name = $row['NAME'];
if (empty($name)) {
    die("查无此人(23)");
}

$xs = new mysqli("localhost", "zyfz", "zyfzalwayswithyou", "ZYFZ");
/*connect mysql*/
if ($xs->connect_error) {
    die("Could not connect!(38)");
}
$xs->query('set names utf8');
$sql = "select * from ZYFZMAIN where UID='" . $_POST["UID"] . "'";
/*select things*/
$result = $xs->query($sql);
$row = $result->fetch_assoc();
$ti = $row['TI'];
$ts = $row['TS'];
$nti = $ti + $_POST['TI'];
$nts = $ts + $_POST['TS'];
$sql = "UPDATE ZYFZMAIN SET TI='" . $nti . "',TS='" . $nts . " 'WHERE UID='" . $_POST['UID'] . "'";
$result = $xs->query($sql);
$t = 0;
$resultdo = false;
while (!$resultdo and $t < 1000) {
    $sql = "INSERT INTO ZYFZHSOY(UID,DATE,OTI,OTS,CTI,CTS,OTOR,RND) VALUES ('" . $_POST['UID'] . "','" . date('Y-m-d H:i:s', time()) . "','" . $ti . "','" . $ts . "','" . $_POST['TI'] . "','" . $_POST['TS'] . "','" . $_COOKIE['UID'] . "','" . mt_rand() . "')";
    $resultdo = $xs->query($sql);
    /*保存记录*/
}
$do = $xs->query($sql);
if ($result) {
    echo $name . $_POST['UID'] . "增加校内学时" . $_POST['TI'] . "增加校外学时" . $_POST['TS'];
} else {
    echo "ERROR(46)";
}
if (!$resultdo) {
    echo "无法保存更改记录！(49)";
}