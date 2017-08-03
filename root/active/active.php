<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>活动系统</title>
<link href="/zhfz/metro/css/search.css" rel="stylesheet" />
<style>
body{width: 100%;   
        height: 100%;   
        font-family: 'Open Sans',sans-serif;   
        margin: 0;     
        background-color:#161719}
</style>
</head>
<html>
<div style="height:10%">
    <a href="active.php?ATID=<?php echo $_GET['ATID']?>&DEL=1"><button>删除这个活动</button></a>
    <a href="active.php?ATID=<?php echo $_GET['ATID']?>&CLS=1"><button>清空人员名单</button></a>
    <a href="active.php?ATID=<?php echo $_GET['ATID']?>&PRT=1"><button>打印人员名单</button></a>
</div>
<div style="height:90%;color:snow">
人员名单：
<table border="1">
    <tr>
        <th>UID</th>
        <th>姓名</th>
        <th>5位学号</th>
    </tr>
    <?php
        $con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql main*/
        if ($con->connect_error){die("Could not connect!");}
        $con->query('set names utf8');

        $ative =new mysqli("localhost","ative","activemakeourlifebetter","ATIVE");/*connect mysql ative*/
        if ($ative->connect_error){die("Could not connect!");}
        $ative->query('set names utf8');

        if(empty($_COOKIE['UID']) or empty($_COOKIE['TOKEN'])){die("请先登录");}/*登录验证*/
        $sql = "SELECT * FROM ADMIN WHERE UID='".$_COOKIE["UID"]."'";
	    $result = $con->query($sql);
	    $row =  $result->fetch_assoc();
        if($row['TOKEN']!=$_COOKIE['TOKEN']){die("请先登录");}

        $sql="SELECT * FROM `".$_GET['ATID']."` WHERE 1";/*读取所有的条目*/
        $result=$ative->query($sql);

        class TABLE/*是时候面向对象了！*/{
                var $uid;
                var $name;
                var $cid; /*设置每个磁铁的标题和信息*/

                function PRINT(){
                        echo "<tr>";
                            echo "<td>".$this->uid."</td>";
                            echo "<td>".$this->name."</td>";
                            echo "<td>".$this->cid."</td>";
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
                $now= new TABLE($row);
                $now->PRINT();
    }
} else {echo "系统错误";}
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

        $sql="DROP TABLE `".$_GET['ATID']."`";
        $result1=$ative->query($sql);
        $sql="DELETE FROM `MAIN` WHERE `ATID`='".$_GET['ATID']."'";
        $result2=$ative->query($sql);
        $sql="DELETE FROM `".$_COOKIE['UID']."` WHERE ATID='".$_GET['ATID']."'";
        $result3=$at->query($sql);
        if($result1 and $result2 and $result3){
            die("<p style='color:snow'>删除成功</p>");
        }
        else{die("<p style='color:snow'>删除失败</p>");}
    }
    if(!empty($_GET['CLS'])){
            $at =new mysqli("localhost","ativep","K3LKLv6tQkAaFLaa","ATIVEP");/*connect mysql*/
        if ($con->connect_error){die("Could not connect!");}
        $at->query('set names utf8');
        $result=$at->query("DELETE FROM `".$_GET['ATID']."` WHERE 1");
        if($result){
            die("<p style='color:snow'>清空成功</p>");
        }
        else{die("<p style='color:snow'>清空失败</p>");}
    }
?>