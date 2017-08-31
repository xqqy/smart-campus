<?php 
 
 $con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql*/
if(empty($_COOKIE['UID']) or empty($_COOKIE['TOKEN'])){die("请先登录(4)");}/*登录验证*/
        $sql = "SELECT * FROM LOGIN WHERE UID='".$_COOKIE["UID"]."'";
	    $result = $con->query($sql);
	    $row =  $result->fetch_assoc();
    if($row['TOKEN']!=$_COOKIE['TOKEN']){die("请先登录(8)");}
                        if(!$_COOKIE['ADD']){die("你没有设置附加值");}

                        
                        $xs =new mysqli("localhost","zyfz","zyfzalwayswithyou","ZYFZ");/*connect mysql*/
                      if ($xs->connect_error){die("Could not connect!(13)");} 
                      $xs->query('set names utf8');

                      $outdate=time()-2592000;
                      $sql="DELETE FROM `ZYFZSQM` WHERE DATE<".$outdate;
                      $xs->query($sql);

                        $sql = "select * from ZYFZMAIN where UID='".$_COOKIE['UID']."'";/*select things*/
                        $result = $xs->query($sql);
                        $row =  $result->fetch_assoc();
                        $ti=$row['TI'];
                        $ts=$row['TS'];
                        
            $sql="select * from ZYFZSQM where SQM='".$_COOKIE['ADD']."'";
            $result = $xs->query($sql);
            $sqm =  $result->fetch_assoc();
            if(!$sqm['OTOR']){die("授权码错误(29)");}

                        $nti=$ti+$sqm['TI'];
                        $nts=$ts+$sqm['TS'];
                        $sql="UPDATE ZYFZMAIN SET TI='".$nti."',TS='".$nts." 'WHERE UID='".$_COOKIE['UID']."'";
                        $result = $xs->query($sql);
                        if($result){
                            $sql="DELETE FROM `ZYFZSQM` WHERE `SQM`='".$_COOKIE['ADD']."'";
                            $resultdel = $xs->query($sql);
                        }


                        $t=0;
                        $resultdo=false;
                        while(!$resultdo and $t<1000000){
                            $sql="INSERT INTO ZYFZHSOY(UID,DATE,OTI,OTS,CTI,CTS,OTOR,RND) VALUES ('".$_COOKIE['UID']."','".date('Y-m-d H:i:s',time())."','".$ti."','".$ts."','".$sqm['TI']."','".$sqm['TS']."','".$sqm['OTOR']."-".$_COOKIE['ADD']."','".mt_rand()."')";
                        $resultdo = $xs->query($sql);/*保存记录*/}


                        $do = $xs->query($sql);
                        if($result){echo $_COOKIE['UID']."增加校内学时".$sqm['TI']."增加校外学时". $sqm['TS'];}else{echo "ERROR(49)";}
                        if(!$resultdo){echo "无法保存更改记录！(50)";}
                        if(!$resultdel){echo "未知错误，请联系校团委（51）";}

                        $sql="DELETE FROM `ZYFZSQM` WHERE DATE<".time()-2592000;
                        $xs->query($sql);
                         ?>