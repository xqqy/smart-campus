<?php
     
 $con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql*/
 if ($con->connect_error){die("Could not connect!");}
     $con->query('set names utf8'); 
 $sql = "select * from AUZN where UID='".$_COOKIE["UID"]."'";/*select things*/
 $result = $con->query($sql);
 $row =  $result->fetch_assoc();
 if($row['ZYFZ']!=1){die("您没有使用此程序的权限！(9)");}
 if(empty($_COOKIE['UID']) or empty($_COOKIE['TOKEN'])){die("请先登录(10)");}/*登录验证*/
         $sql = "SELECT * FROM ADMIN WHERE UID='".$_COOKIE["UID"]."'";
         $result = $con->query($sql);
         $row =  $result->fetch_assoc();
     if($row['TOKEN']!=$_COOKIE['TOKEN']){die("请先登录(14)");}

     $n=$_POST['NUM'];
     $ti=$_POST['TIsqm'];
     $ts=$_POST['TSsqm'];
     
     $xs =new mysqli("localhost","zyfz","zyfzalwayswithyou","ZYFZ");/*connect mysql*/
     if ($xs->connect_error){die("Could not connect!");} 
     $xs->query('set names utf8');

     while($n>0){
         $n-=1;
         $resultdo=false;
         $t=0;
         while($t<1000 and !$resultdo){
            $rand=mt_rand();
            $sql="INSERT INTO `ZYFZSQM`(`SQM`, `TI`, `TS`,`OTOR`,`DATE`) VALUES ('".$rand."','".$ti."','".$ts."','".$_COOKIE['UID']."','".time()."')";
            $resultdo=$xs->query($sql);
            $t+=1;
         }
if(!$resultdo){echo "<br />一个代码生成失败";}else{echo "<br />".$rand;}
     }
     $outdate=time()-2592000;
     $sql="DELETE FROM `ZYFZSQM` WHERE DATE<".$outdate;
     $result=$xs->query($sql);
     if(!$result){echo "授权码超时删除失败！（39）";}
     ?>
     <a href="/root/zyfz/"><button>返回</button></a>