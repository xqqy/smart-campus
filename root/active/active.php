<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>活动系统</title>
<link href="/zhfz/metro/css/search.css" rel="stylesheet" />
<style>
body{width: 100%;   
        height: 100%;   
        margin: 0;     
        background-color:#161719}
a{
    color:#00fff0;
}
</style>
</head>
<html>
<div style="height:10%">
    <a href="active.php?ATID=<?php echo $_GET['ATID']?>&DEL=1"><button>删除这个活动</button></a>
    <a href="active.php?ATID=<?php echo $_GET['ATID']?>&CLS=1"><button>清空参加人员名单</button></a>
    <a href="index.php"><button>返回</button></a>
    <!--<a href="active.php?ATID=<?php echo $_GET['ATID']?>&PRT=1"><button>打印人员名单</button></a>-->
</div>
<div style="height:90%;color:snow">
参加人员名单：
<table border="1">
    <tr>
        <th>UID</th>
        <th>姓名</th>
        <th>5位学号</th>
        <th>加入时间</th>
        <th>删除此人</th>
        <th>封禁此人</th>
    </tr>
    <?php
        $con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql main*/
        if ($con->connect_error){die("Could not connect!");}
        $con->query('set names utf8');

        $ative =new mysqli("localhost","ative","activemakeourlifebetter","ATIVE");/*connect mysql ative*/
        if ($ative->connect_error){die("Could not connect!");}
        $ative->query('set names utf8');

    $at =new mysqli("localhost","ativep","K3LKLv6tQkAaFLaa","ATIVEP");/*connect mysql ativep*/
        if ($con->connect_error){die("Could not connect!");}
        $at->query('set names utf8');

    $sql="SELECT * FROM `".$_COOKIE['UID']."` WHERE ATID='".$_GET['ATID']."'";
    $result=$at->query($sql);
    $row=$result->fetch_assoc();

    if($row['VER']!='1'){
        echo "<script language='javascript'>document.location = 'doc/".$row['ATID']."'</script>";
    }

        if(empty($_COOKIE['UID']) or empty($_COOKIE['TOKEN'])){die("请先登录(48)");}/*登录验证*/
        $sql = "SELECT * FROM ADMIN WHERE UID='".$_COOKIE["UID"]."'";
	    $result = $con->query($sql);
	    $row =  $result->fetch_assoc();
        if($row['TOKEN']!=$_COOKIE['TOKEN']){die("请先登录(52)");}

        $sql="SELECT * FROM `".$_GET['ATID']."` WHERE 1";/*读取所有的条目*/
        $result=$ative->query($sql);

        class TABLE/*是时候面向对象了！*/{
                var $uid;
                var $name;
                var $cid; /*设置标题和信息*/

                function PRINT(){
                        echo "<tr>";
                            echo "<td>".$this->uid."</td>";
                            echo "<td>".$this->name."</td>";
                            echo "<td>".$this->cid."</td>";
                            echo "<td>".$this->time."</td>";
                            echo "<td><a href=active.php?ATID=".$_GET['ATID']."&delUID=".$this->uid.">删除</a>";
                            echo "<td><a href=active.php?ATID=".$_GET['ATID']."&banUID=".$this->uid.">封禁</a>";
                        echo"</tr>";
                }

                function __construct($row){
                        $this->uid=$row['UID'];
                        $this->name=$row['NAME'];
                        $this->cid=$row['CID'];
                        $this->time=$row['TIME'];
                }
                
        }

if($result){   
    // 输出数据
while($row = $result->fetch_assoc()){
                $now= new TABLE($row);
                $now->PRINT();
    }
} else {echo "系统错误(84)";}
$con->close();
$ative->close();
?>
</table>

封禁人员名单：
<table border="1">
    <tr>
        <th>UID</th>
        <th>姓名</th>
        <th>5位学号</th>
        <th>解封此人</th>
    </tr>
    <?php
        $con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql main*/
        if ($con->connect_error){die("Could not connect!");}
        $con->query('set names utf8');

        $ative =new mysqli("localhost","ative","activemakeourlifebetter","ATIVE");/*connect mysql ative*/
        if ($ative->connect_error){die("Could not connect!");}
        $ative->query('set names utf8');

    $at =new mysqli("localhost","ativep","K3LKLv6tQkAaFLaa","ATIVEP");/*connect mysql ativep*/
        if ($con->connect_error){die("Could not connect!");}
        $at->query('set names utf8');

        $sql="SELECT * FROM `".$_GET['ATID']."P` WHERE 1";/*读取所有的条目*/
        $result=$ative->query($sql);

        class TABLE2/*是时候面向对象了！*/{
            var $uid;
            var $name;
            var $cid; /*设置标题和信息*/

            function PRINT(){
                    echo "<tr>";
                        echo "<td>".$this->uid."</td>";
                        echo "<td>".$this->name."</td>";
                        echo "<td>".$this->cid."</td>";
                        echo "<td><a href=active.php?ATID=".$_GET['ATID']."&unbanUID=".$this->uid.">解封</a>";
                    echo"</tr>";
            }

            function __construct($row){
                    $this->uid=$row['UID'];
                    $this->name=$row['NAME'];
                    $this->cid=$row['CID'];
            }
            
    }

if($result){   
    // 输出数据
while($row = $result->fetch_assoc()){
                $now= new TABLE2($row);
                $now->PRINT();
    }
} else {echo "系统错误(84)";}
$con->close();
$ative->close();
?>
</table>

</div>
</html>





<?php
    if(!empty($_GET['DEL'])){/*删除活动*/

        $ative =new mysqli("localhost","ative","activemakeourlifebetter","ATIVE");/*connect mysql ative*/
        if ($ative->connect_error){die("Could not connect!");}
        $ative->query('set names utf8');

    $at =new mysqli("localhost","ativep","K3LKLv6tQkAaFLaa","ATIVEP");/*connect mysql*/
        if ($con->connect_error){die("Could not connect!");}
        $at->query('set names utf8');

        $sql="DROP TABLE `".$_GET['ATID']."`,`".$_GET['ATID']."P`";
        $result1=$ative->query($sql);
        $sql="DELETE FROM `MAIN` WHERE `ATID`='".$_GET['ATID']."'";
        $result2=$ative->query($sql);
        $sql="DELETE FROM `".$_COOKIE['UID']."` WHERE ATID='".$_GET['ATID']."'";
        $result3=$at->query($sql);

        if($result1 and $result2 and $result3){
            echo "<p style='color:snow'>删除成功</p>";
            echo "<script language='javascript'>alert('删除成功');document.location='index.php';</script>";            
        }
        else{echo "<script language='javascript'>alert('删除失败');<script>";}
    }

    if(!empty($_GET['CLS'])){
            $at =new mysqli("localhost","ative","activemakeourlifebetter","ATIVE");/*connect mysql*/
        if ($con->connect_error){die("Could not connect!");}
        $at->query('set names utf8');
        $result=$at->query("DELETE FROM `".$_GET['ATID']."` WHERE 1");
        if($result){
            echo "<p style='color:snow'>清空成功</p>";
            echo "<script language='javascript'>alert('清空成功');document.location='active.php?ATID=".$_GET['ATID']."';</script>";
        }
        else{echo "<script language='javascript'>alert('清空失败');<script>";}
    }
    if(!empty($_GET['delUID'])){
        $at =new mysqli("localhost","ative","activemakeourlifebetter","ATIVE");/*connect mysql*/
        if ($con->connect_error){die("Could not connect!");}
        $at->query('set names utf8');
        $result=$at->query("DELETE FROM `".$_GET['ATID']."` WHERE UID='".$_GET['delUID']."'");
        if($result){
            echo "<p style='color:snow'>删除".$_GET['delUID']."成功</p>";
            echo "<script language='javascript'>alert('删除".$_GET['delUID']."成功');document.location='active.php?ATID=".$_GET['ATID']."';</script>";
        }
        else{echo "<script language='javascript'>alert('删除".$_GET['delUID']."失败');<script>";}
    }
    if(!empty($_GET['banUID'])){
        $at =new mysqli("localhost","ative","activemakeourlifebetter","ATIVE");/*connect mysql*/
        if ($con->connect_error){die("Could not connect!");}
        $at->query('set names utf8');
        
        $con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql main*/
        if ($con->connect_error){die("Could not connect!");}
        $con->query('set names utf8');

        $sql = "SELECT * FROM LOGIN WHERE UID='".$_GET["banUID"]."'";
        $result = $con->query($sql);
        $row =  $result->fetch_assoc();

        $result1=$at->query("DELETE FROM `".$_GET['ATID']."` WHERE UID='".$_GET['banUID']."'");
        $result2=$at->query("INSERT INTO `".$_GET['ATID']."P`(`UID`,`NAME`,`CID`) VALUES ('".$_GET['banUID']."','".$row['NAME']."','".$row['CID']."')");
        if($result1 and $result2){
            echo "<p style='color:snow'>封禁".$_GET['banUID']."成功</p>";
            echo "<script language='javascript'>alert('封禁".$_GET['banUID']."成功');document.location='active.php?ATID=".$_GET['ATID']."';</script>";
        }
        else{echo "<script language='javascript'>alert('封禁".$_GET['banUID']."失败');<script>";}
    }
    if(!empty($_GET['unbanUID'])){
        $at =new mysqli("localhost","ative","activemakeourlifebetter","ATIVE");/*connect mysql*/
        if ($con->connect_error){die("Could not connect!");}
        $at->query('set names utf8');
        $result=$at->query("DELETE FROM `".$_GET['ATID']."P` WHERE UID='".$_GET['unbanUID']."'");
        if($result){
            echo "<p style='color:snow'>解封".$_GET['unbanUID']."成功</p>";
            echo "<script language='javascript'>alert('解封".$_GET['unbanUID']."成功');document.location='active.php?ATID=".$_GET['ATID']."';</script>";
        }
        else{echo "<script language='javascript'>alert('解封".$_GET['unbanUID']."失败');<script>";}
    }
?>
<script src="http://localhost/zhfz/metro/js/formdata.min.js"></script>