<?php
function right($a){
    if($a){return "成功";}else{return "失败";}
}
if(!is_numeric($_POST['ATID'])){die("非法输入(5)");}
if(is_numeric($_POST['NAME'])){die("非法输入(6)");}

    $con = new mysqli("localhost", "login", "loginmyphp", "MAIN");//connect mysql
    if ($con->connect_error) {
        die("Could not connect!");
    }
    $con->query('set names utf8');
    $atp =new mysqli("localhost","ativep","K3LKLv6tQkAaFLaa","ATIVEP");//connect mysql*
    if ($con->connect_error){die("Could not connect!");}
    $atp->query('set names utf8');
    $at =new mysqli("localhost","ative","activemakeourlifebetter","ATIVE");/*connect mysql*/
    if ($con->connect_error){die("Could not connect!");}
    $at->query('set names utf8');


    if(empty($_COOKIE['UID'])){die("请先登录(21)");}
    
        $sql = "SELECT * FROM ADMIN WHERE UID='".$_COOKIE["UID"]."'";
        $result = $con->query($sql);
        $row =  $result->fetch_assoc();
        if(!$_COOKIE["UID"] or $row['TOKEN']!=$_COOKIE['TOKEN']){die("请先登录(26)");}


$ins=$at->prepare("INSERT INTO `MAIN`(`ATID`, `NAME`, `INFO`, `DATES`, `DATEE`, `PEOPLE`, `VER`) VALUES (?,?,?,?,?,?,?)");
$ins->bind_param("sssssii",$_POST['ATID'],$_POST['NAME'],$_POST['INFO'],$_POST['DATES'],$_POST['DATEE'],$_POST['PEOPLE'],$_POST['BUTTON']);
$resultins=$ins->execute();
if(!$resultins){die("活动主表设置失败");}
$ins->close();

$add=$atp->prepare("INSERT INTO `".$_COOKIE['UID']."`(`ATID`, `VER`) VALUES (?,?)");
$add->bind_param("si",$_POST['ATID'],$_POST['SHOW']);
$resultadd=$add->execute();
if(!$resultadd){die("活动管理设置失败");}
$add->close();



    $sql="CREATE TABLE `ATIVE`.`".$_POST['ATID']."P` ( `UID` VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `NAME` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `CID` VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ) ENGINE = InnoDB;";
    $resulttablep=$at->query($sql);
    if(!$resulttablep){die("活动人员限制设置失败");}

    $sql="CREATE TABLE `ATIVE`.`".$_POST['ATID']."` ( `UID` VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `NAME` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `CID` VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,`TIME` INT NOT NULL ) ENGINE = InnoDB;";
    $resulttable=$at->query($sql);
    if(!$resulttable){die("活动人员表设置失败");}

    $sql="ALTER TABLE `".$_POST['ATID']."` ADD PRIMARY KEY(`UID`);";
    $resulttablea=$at->query($sql);
    if(!$resulttablea){die("活动人员限制主键设置失败");}

    $sql="ALTER TABLE `".$_POST['ATID']."P` ADD PRIMARY KEY(`UID`);";
    $resulttablepa=$at->query($sql);
    if(!$resulttablepa){die("活动人员表主键设置失败");}


    
    if($resultadd and $resultins and $resulttable and $resulttablep and $resulttablepa and $resulttablea){echo "done";}else{echo "创建活动表格".right($resultadd)."更改活动主表".right($resultins)."添加活动表格".right($resulttable)."设置人员限制".right($resulttablep)."活动人员限制主键设置失败".right($resulttablea)."活动人员表主键设置失败".right($resulttablepa);}
?>