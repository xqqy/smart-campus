<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<script>(function(i,s,o,g,r,a,m){i["DaoVoiceObject"]=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;a.charset="utf-8";m.parentNode.insertBefore(a,m)})(window,document,"script",('https:' == document.location.protocol ? 'https:' : 'http:') + "//widget.daovoice.io/widget/96c356a7.js","daovoice")</script><!--daovoice-->

<link href="/zhfz/metro/css/search.css" rel="stylesheet" />
<style>
body{width: 100%;   
        height: 100%;   
        font-family: 'Open Sans',sans-serif;   
        margin: 0;     
        background-color:#161719}
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
text-decoration: none;    }
</style>
<title>活动系统</title>
</head>


<div class="webdesigntuts-workshop" style="width:100%;height:20%;top:10%">
	<form method="get">		    
		<input name="SEARCH" type="search" placeholder="活动代码或活动名称">		    	
		<button>GO</button>
	</form>
</div>
<div style="float:left;position:absolute;bottom:0;margin:50px;height:60%;color:snow">
        <?php 
        if(!empty($_GET['SEARCH'])) {
        
        class METRO/*是时候面向对象了！*/{
                var $atid;
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

        $con =new mysqli("localhost","ative","activemakeourlifebetter","ATIVE");/*connect mysql*/
        if ($con->connect_error){die("Could not connect!");}
        $con->query('set names utf8');

        if(is_numeric($_GET['SEARCH'])){$sql="SELECT * FROM MAIN WHERE ATID='".$_GET['SEARCH']."'";}/*判定是否使用唯一代码*/
        else{$sql="SELECT * FROM MAIN WHERE NAME like '%".$_GET['SEARCH']."%'";}
        $result=$con->query($sql);
if($result){
        
    // 输出数据
    while($row = $result->fetch_assoc()){
                $now= new METRO($row);
                $now->PRINT();
    }
} else {echo "没有结果";}
} ?>
</div>
<script>daovoice('init', {
  app_id: "96c356a7",
  user_id: "<?php echo $_COOKIE['UID'] ?>", // 必填: 该用户在您系统上的唯一ID
  name: <?php $con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql*/
	if ($con->connect_error){die("Could not connect!");}
if(!$_COOKIE["UID"]){echo "请先登录(83)";}else{
	$con->query('set names utf8'); 
		$sql = "SELECT * FROM LOGIN WHERE UID=".$_COOKIE["UID"];
		$result = $con->query($sql);
		$row =  $result->fetch_assoc();
		echo '"'.$row['NAME'].'"';}?>, // 选填: 用户名
 
});
daovoice('update');</script>