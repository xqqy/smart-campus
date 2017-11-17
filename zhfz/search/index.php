
<!doctype html>
<head>
  <meta charset="UTF-8"> 
  <title>通知中心</title>
</head>
<html>  
<style>
.small{
float:left;
margin: 5px;
padding: 15px;
/*width: 300px;
height: 300px;*/
		text-align: center;
		background-color: snow/*#a1e9dc  b4feff*/;
        	/*position: absolute;   */
        	top: 50%;   
        	left:50%;   
        	/*margin: -170px 0 0 -170px;   */
	
		font-size:40px;
		text-decoration: none;    }
body{   
        width: 100%;   
        height: 100%;   
           
        margin: 0;   
        background-color: #161719/*00c1c3*/;   
    }   
</style>
<head>  
    <meta charset="UTF-8"> 
    <title>志愿附中</title>
 
<script>(function(i,s,o,g,r,a,m){i["DaoVoiceObject"]=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;a.charset="utf-8";m.parentNode.insertBefore(a,m)})(window,document,"script",('https:' == document.location.protocol ? 'https:' : 'http:') + "//widget.daovoice.io/widget/96c356a7.js","daovoice")</script>

<body>
<script>daovoice('init', {
  app_id: "1f3d8ed1",
  user_id: "<?php echo $_COOKIE['UID'] ?>", // 必填: 该用户在您系统上的唯一ID
  name: <?php $con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql*/
	if ($con->connect_error){die("Could not connect!");}
if(!$_COOKIE["UID"]){die();}else{
	$con->query('set names utf8'); 
		$sql = "SELECT * FROM LOGIN WHERE UID=".$_COOKIE["UID"];
		$result = $con->query($sql);
		$row =  $result->fetch_assoc();
		echo '"'.$row['NAME'].'"';}?>, // 选填: 用户名
 
});
daovoice('update');</script>

<div style="color:white;font-size:1.5rem;margin-left:20px;heigh:10%"><h1>通知中心</h1></div>

<div style="position:absolute;top:10%;margin:50px;"> 





<div class="small"  >  <!--智慧学时-->
     <?php
     if(empty($_COOKIE['UID'])){die("请先登录(64)");}

$con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql*/
$zy =new mysqli("localhost","zyfz","zyfzalwayswithyou","ZYFZ");/*connect mysql*/
if ($con->connect_error or $zy->connect_error)
  {
  die('Could not connect: ' . mysql_error());
  }
$con->query('set names utf8');
$zy->query('set names utf8');
if(!$_COOKIE["UID"]){echo "请先登录(74)";}else{
$sql = "SELECT * FROM LOGIN WHERE UID=".$_COOKIE["UID"];
$result = $con->query($sql);
$row =  $result->fetch_assoc();
if( $row['TOKEN']!=$_COOKIE['TOKEN']){die("请先登录(78)");}//登录验证

$sql = "SELECT * FROM ZYFZMAIN WHERE UID=".$_COOKIE["UID"];//查询
$result = $zy->query($sql);
$row =  $result->fetch_assoc();

  echo "你有".$row['TI']."校内学时". "<br /> 你有". $row['TS']."校外学时" ;//返回
  echo "<br />";

}
$con->close();
?>       
<p style="font-size:25px">感谢使用查询系统</p>
<p style="font-size:15px">2017校团委志愿者部</p>
</div>


<?php 
$con =new mysqli("localhost","push","5TPlpIGEX9Hy8xCC","PUSH");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");}
$con->query('set names utf8');


$outdate=time()-604800;
$sql="DELETE FROM `PUSHMSGE` WHERE `TIME`<'".$outdate."'";
$con->query($sql);

$sql="SELECT * FROM `PUSHMAIN` WHERE UID='".$_COOKIE['UID']."'";
$result=$con->query($sql);
$row =  $result->fetch_assoc();
$message=str_getcsv($row['NUM']);//获取为CSV行
$t=0;
$a=count($message);
while($t<$a){
    $sql="SELECT * FROM `PUSHMSGE` WHERE NUM='".$message[$t]."'";
    $result=$con->query($sql);
    $row =  $result->fetch_assoc();
    if($row['TITLE']){
      small($row);
      $t+=1;
    }
    else{
      array_splice($message,$t,1);
      $a=count($message);
    }
}
$nmsg="";
$t=0;
while($t<$a){
  $nmsg.=',"'.$message[$t].'"';
  $t+=1;
}
$nmsg=substr($nmsg,1);
$sql="UPDATE `PUSHMAIN` SET `NUM`='".$nmsg."' WHERE `UID`='".$_COOKIE['UID']."'";
$con->query($sql);

                function small($row){
                        echo "<div class='small'>";
                        if($row['LINK']){echo "<a href='".$row['LINK']."'>";}
                        echo "<p style='font-size:40px;'>".$row['TITLE']."</p>";/*输出title*/
                        echo "<p style='font-size:25px;'>".$row['INFO']."</p>";/*输出内容*/
                        echo"</a></div>";
                }

                

        ?>

</div>
</body>  
</html>  
