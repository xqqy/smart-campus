<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<link href="/zhfz/metro/css/search.css" rel="stylesheet" />
<style>
body{width: 100%;   
        height: 100%;   
           
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
box-shadow:0px 10px 20px /*#fbffc0*/;
text-decoration: none;    }
button {
	background: #222;
	background: -webkit-linear-gradient(#333, #222);
	background: -moz-linear-gradient(#333, #222);
	background: -o-linear-gradient(#333, #222);
	background: -ms-linear-gradient(#333, #222);
	background: linear-gradient(#333, #222);
	-webkit-box-sizing: content-box;
	-moz-box-sizing: content-box;
	-o-box-sizing: content-box;
	-ms-box-sizing: content-box;
	box-sizing: content-box;
	border: 1px solid #444;
	border-left-color: #000;
	border-radius: 0 5px 5px 0;
	box-shadow: 0 2px 0 #000;
	color: #fff;
	display: block;
	float: left;
	font-family: 'Cabin', helvetica, arial, sans-serif;
	font-size: 13px;
	font-weight: 400;
	height: 40px;
	line-height: 40px;
	margin: 0;
	padding: 0;
	position: relative;
	text-shadow: 0 -1px 0 #000;
	width: 80px;
}	
</style>
<title>活动系统</title>
</head>



<div style="top:10%;color:snow">
<a href="index.php"><button>返回</button></a>
<div>
<?php   $con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql main*/
        if ($con->connect_error){die("Could not connect!");}
        $con->query('set names utf8');
        
        $ative =new mysqli("localhost","ative","activemakeourlifebetter","ATIVE");/*connect mysql ative*/
        if ($ative->connect_error){die("Could not connect!");}
        $ative->query('set names utf8');

        if(empty($_COOKIE['UID']) or empty($_COOKIE['TOKEN'])){die("请先登录(41)");}/*登录验证*/
        $sql = "SELECT * FROM LOGIN WHERE UID='".$_COOKIE["UID"]."'";
	$result = $con->query($sql);
	$row =  $result->fetch_assoc();
        if($row['TOKEN']!=$_COOKIE['TOKEN']){die("请先登录(45)");}

        $sql="SELECT * FROM `MAIN` WHERE ATID='".$_GET['ATID']."'";/*查看限制*/
        $result=$ative->query($sql);
        $at=$result->fetch_assoc();
        if($at['PEOPLE']==1){
                $sql="SELECT * FROM `".$_GET['ATID']."P` WHERE UID='".$_COOKIE['UID']."'";/*许可验证*/
                $result=$ative->query($sql);
                $ati=$result->fetch_assoc();
                if(empty($ati)){die("您不被准许加入此活动");}
        }
        if($at['PEOPLE']==2){
                $sql="SELECT * FROM `".$_GET['ATID']."P` WHERE UID='".$_COOKIE['UID']."'";
                $result=$ative->query($sql);
                $ati=$result->fetch_assoc();
                if(!empty($ati)){die("您不被准许加入此活动");}
        }
        if(strtotime($at['DATES'])>time()){die("活动未开始");}/*时间验证*/
        if(strtotime($at['DATEE'])<time()){die("活动已结束");}
        
        $sql="SELECT * FROM `".$_GET['ATID']."` WHERE UID='".$_COOKIE['UID']."'";
        $result = $ative->query($sql);
        if($row=$result->fetch_assoc()){echo "您已加入活动！请不要重复加入";}else{
                if($at['VER']==1){/*是否添加加入按钮*/
                                echo '<a href="active.php?ATID='.$_GET['ATID'].'&DO=1"><button>加入</button></a>';
                }
        }


        if(!empty($_GET['DO'])){/*将人员加入表*/
                $sql = "SELECT * FROM LOGIN WHERE UID='".$_COOKIE["UID"]."'";
                $result = $con->query($sql);
                $row =  $result->fetch_assoc();
        $sql="INSERT INTO `".$_GET['ATID']."`(`UID`,`NAME`,`CID`,`TIME`) VALUES ('".$_COOKIE['UID']."','".$row['NAME']."','".$row['CID']."','".date('Y-m-d H:i:s', time())."');";
        $result = $ative->query($sql);
        if($result){echo "加入活动成功";}else{
        $sql="SELECT * FROM `".$_GET['ATID']."` WHERE UID='".$_COOKIE['UID']."'";
        $result = $ative->query($sql);
        if($row=$result->fetch_assoc()){echo "您已加入活动";}else{echo "错误(71)";}}}



        echo '<iframe style="float:left;position:absolute;left:0;bottom:0;;height:';
        if($at['VER']==1){echo '90';}else{echo '100';}
        echo '%;color:snow;width:100%" frameborder="0" src=doc/'.$_GET['ATID'].'>Error!</iframe>';
        ?>
</div>
        </div>




<!--本系统在Apache License2.0协议下开源，您可以在关于页面下载到许可协议。在输入指令页面输入about即可打开-->
<!--This system is open source under Apache License2.0, You can get License in about page,open it by entry "about" in command page-->

