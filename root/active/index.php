<!DOCTYPE html>
<head>
<meta charset="UTF-8">

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


<div style="color:white;font-size:1.5rem;margin-left:20px;heigh:10%"><h1>活动管理</h1></div>

</div>
<div style="top:10%;height:90%;color:snow">
        <?php 
        if(!$_COOKIE['UID']){die("请先登录");}
        
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

    $at =new mysqli("localhost","ativep","K3LKLv6tQkAaFLaa","ATIVEP");/*connect mysql*/
        if ($con->connect_error){die("Could not connect!");}
        $at->query('set names utf8');

$sqla="SELECT * FROM `".$_COOKIE['UID']."` WHERE 1";
$resulta=$at->query($sqla);
if($resulta){
   if($rowa = $resulta->fetch_assoc()){
       $result=$con->query($sql);
       $row = $result->fetch_assoc();
       $now= new METRO($row);
       $now->PRINT();
       // 输出数据
       while($rowa = $resulta->fetch_assoc()){
            $sql="SELECT * FROM `MAIN` WHERE ATID='".$rowa['ATID']."'";
            $result=$con->query($sql);
            $row = $result->fetch_assoc();
            $now= new METRO($row);
            $now->PRINT();
        }
    }else{echo "没有结果";}
}else{echo "系统内部错误(82)";}
 ?>
</div>
