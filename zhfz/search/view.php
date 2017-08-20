
<!doctype html>
<head>
  <meta charset="UTF-8"> 
  <title>综合查询</title>
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
        font-family: 'Open Sans',sans-serif;   
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
  app_id: "96c356a7",
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


<!--智慧团籍-->
    <?php
    if(empty($_COOKIE['UID'])){die("请先登录(61)");}

$con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql*/
if ($con->connect_error)
  {
  die('Could not connect: ' . mysql_error());
  }
$con->query('set names utf8');

$tj =new mysqli("localhost","zhtj","zhtjalwayswithyou","ZHTJ");/*connect mysql*/
if ($con->connect_error)
  {
  die('Could not connect: ' . mysql_error());
  }
$tj->query('set names utf8');

if(!$_COOKIE["UID"]){echo "请先登录(77)";}else{
$sql = "SELECT * FROM LOGIN WHERE UID=".$_COOKIE["UID"];
$result = $con->query($sql);
$row =  $result->fetch_assoc();
if(!$_COOKIE["UID"] or $row['TOKEN']!=$_COOKIE['TOKEN']){echo "请先登录(81)";}else{//登录验证


$sql = "SELECT * FROM ZHTJMAIN WHERE UID=".$_COOKIE["UID"];//查找
$result = $tj->query($sql);
$row =  $result->fetch_assoc();

$num=$row['NUM'];

$sql = "SELECT * FROM ZHTJRTUN WHERE NUM=".$num;//查看帮助信息
$result=$tj->query($sql);
$row =  $result->fetch_assoc();

if($num!=0 and $num!=-1 and $num!=1){
  echo '<div class="small">';


	if($row['FASHION']==null){echo "未知返回值，请联系校团委<br />";
  echo "你的返回值是:".$num;}//返回值

else{
if($num!=0){
echo $row['FASHION'];
}}

}


}}
$con->close();
$tj->close();
if($num!=0 and $num!=-1 and $num!=1){echo '<p style="font-size:25px">感谢使用查询系统</p>';
echo '<p style="font-size:15px">2017校团委组织部</p>';
echo '</div>';}
    ?>





<div class="small"  >  <!--智慧学时-->
     <?php
     if(empty($_COOKIE['UID'])){die("请先登录(123)");}

$con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql*/
$zy =new mysqli("localhost","zyfz","zyfzalwayswithyou","ZYFZ");/*connect mysql*/
if ($con->connect_error)
  {
  die('Could not connect: ' . mysql_error());
  }
$con->query('set names utf8');
if(!$_COOKIE["UID"]){echo "请先登录(132)";}else{
$sql = "SELECT * FROM LOGIN WHERE UID=".$_COOKIE["UID"];
$result = $con->query($sql);
$row =  $result->fetch_assoc();
if( $row['TOKEN']!=$_COOKIE['TOKEN']){echo "请先登录(136)";}else{//登录验证

$sql = "SELECT * FROM ZYFZMAIN WHERE UID=".$_COOKIE["UID"];//查询
$result = $zy->query($sql);
$row =  $result->fetch_assoc();

  echo "你有".$row['TI']."校内学时". "<br /> 你有". $row['TS']."校外学时" ;//返回
  echo "<br />";

}}
$con->close();
?>       
<p style="font-size:25px">感谢使用查询系统</p>
<p style="font-size:15px">2017校团委志愿者部</p>
</div>


<!--未完成的推送系统-->
<?php 
  class SMALL/*是时候面向对象了！*/{
                var $msgid;
                var $name;
                var $info; /*设置每个磁铁的标题和信息*/

                function PRINT(){
                        echo "<div class='small'>".'<a href="active.php?ATID='. $this->atid .'">';/*设置为链接模式，get方法传递参数*/
                        echo "<p style='font-size:40px;'>".$this->name."</p>";/*输出title*/
                        echo "<p style='font-size:25px;'>".$this->info."</p>";/*输出帮助*/
                        echo"</a></div>";
                }

                function __construct($row){
                        $this->atid=$row['ATID'];
                        $this->name=$row['NAME'];
                        $this->info=$row['INFO'];
                }
                
        }
        ?>

</div>

</body>  
</html>  
