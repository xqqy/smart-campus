

    <!DOCTYPE html>  
    <html>  
    <head>  
        <meta charset="UTF-8">  
        <title>学时管理</title>  
        <link rel="stylesheet" type="text/css" href="score.css"/>  
    </head>  
    <body>  


 <div style="color:#fff"><?php 
 
 $con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");}
	$con->query('set names utf8'); 

$sql = "select * from AUZN where UID='".$_COOKIE["UID"]."'";/*select things*/
$result = $con->query($sql);
$row =  $result->fetch_assoc();
if($row['ZYFZ']!=1){die("您没有使用此程序的权限！");}

if(empty($_COOKIE['UID']) or empty($_COOKIE['TOKEN'])){die("请先登录");}/*登录验证*/
        $sql = "SELECT * FROM ADMIN WHERE UID='".$_COOKIE["UID"]."'";
	    $result = $con->query($sql);
	    $row =  $result->fetch_assoc();
    if($row['TOKEN']!=$_COOKIE['TOKEN']){die("请先登录");}
                        

                        if(!empty($_POST['UID'])){$con =new mysqli("localhost","register","registerpswdbjsdfz","MAIN");/*connect mysql*/
                      if ($con->connect_error){die("Could not connect!");} 
                      $con->query('set names utf8');
                        $sql = "select * from LOGIN where UID='".$_POST["UID"]."'";/*select things*/
                        $result = $con->query($sql);
                        $row =  $result->fetch_assoc();
                        $name=$row['NAME'];
                        if(empty($name)){echo "查无此人";}else{
                        
                        $xs =new mysqli("localhost","zyfz","zyfzalwayswithyou","ZYFZ");/*connect mysql*/
                      if ($xs->connect_error){die("Could not connect!");} 
                      $xs->query('set names utf8');
                        $sql = "select * from ZYFZMAIN where UID='".$_POST["UID"]."'";/*select things*/
                        $result = $xs->query($sql);
                        $row =  $result->fetch_assoc();
                        $ti=$row['TI'];
                        $ts=$row['TS'];
                        
                        $nti=$ti+$_POST['TI'];
                        $nts=$ts+$_POST['TS'];
                        $sql="UPDATE ZYFZMAIN SET TI='".$nti."',TS='".$nts." 'WHERE UID='".$_POST['UID']."'";
                        $result = $xs->query($sql);
 			
			$sql="INSERT INTO ZYFZHSOY(UID,DATE,OTI,OTS,CTI,CTS,OTOR) VALUES ('".$_POST['UID']."','".date('Y-m-d h:i:s',time())."','".$ti."','".$ts."','".$_POST['TI']."','".$_POST['TS']."','".$_COOKIE['UID']."')";
                        $do = $xs->query($sql);

                        if($result){echo $name.$_POST['UID']."增加校内学时".$_POST['TI']."增加校外学时". $_POST['TS'];}else{echo "ERROR";}}}if(!$do){echo "无法保存更改记录！";}
                         ?>
</div>

<div style="color:white;font-size:1.5rem;margin-left:20px;heigh:10%"><h1>志愿者部系统</h1></div>

<div style="position:absolute;top:10%;margin:50px;"> 

        <div class="login">  
            <h1>学时管理</h1>  
            <form method="post" > 
                <input type="text" required="required" placeholder="UID" class="onlyNumAlpha" name="UID"></input>  
                <input type="text" required="required" placeholder="校内学时" class="onlyNumAlpha" name="TI"></input>  
                <input type="text" required="required" placeholder="校外学时" class="onlyNumAlpha" name="TS"></input>  
                <button class="sub" type="submit">添加</button>  
            </form>  
        </div>  
    </div> 
    </body>  
    </html>  

<!--本系统在Apache License2.0协议下开源，您可以在关于页面下载到许可协议。在输入指令页面输入about即可打开-->
<!--This system is open source under Apache License2.0, You can get License in about page,open it by entry "about" in command page-->
