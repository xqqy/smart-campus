<?php
if($_POST['job']=="form1"){
    $con = new mysqli("localhost", "login", "loginmyphp", "MAIN");
    /*connect mysql*/
    if ($con->connect_error) {
        die("Could not connect!");
    }
    $con->query('set names utf8');
    $at =new mysqli("localhost","ativep","K3LKLv6tQkAaFLaa","ATIVEP");/*connect mysql*/
    if ($con->connect_error){die("Could not connect!");}
    $at->query('set names utf8');

    if(empty($_COOKIE['UID'])){die("请先登录(13)");}
    
        $sql = "SELECT * FROM ADMIN WHERE UID='".$_COOKIE["UID"]."'";
        $result = $con->query($sql);
        $row =  $result->fetch_assoc();
        if(!$_COOKIE["UID"] or $row['TOKEN']!=$_COOKIE['TOKEN']){echo "请先登录(18)";}

    $new=$at->prepare("INSERT INTO `MAIN`(`ATID`, `NAME`, `INFO`, `DATES`, `DATEE`, `PEOPLE`, `VER`) VALUES (?,?,?,?,?,?,?)");
}
echo "done1"
?>