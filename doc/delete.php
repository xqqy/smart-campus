<!DOCTYPE html>
<head>
<meta charset="UTF-8">

<link href="search.css" rel="stylesheet" />
<style>
body{width: 100%;   
        height: 100%;   
        font-family: 'Open Sans',sans-serif;   
        margin: 0;     
        background-color:red}
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
<title>文件系统</title>
</head>
<div style="height:10%;color:snow;font-size:50px">
删除文件
</div>
<div style="float:left;height:90%;color:snow">
        <?php 
        
        class METRO/*是时候面向对象了！*/{
                var $atid;
                var $name;
                var $info; /*设置每个磁铁的标题和信息*/

                function OUT(){
                        echo "<div class='small'>".'<a href='.$this->path .'>';/*设置为链接模式*/
                        echo "<p style='font-size:40px;'>".$this->name."</p>";/*输出title*/
                        echo "<p style='font-size:25px;'>".$this->info."</p>";/*输出帮助*/
                        echo"</a></div>";
                }

                function __construct($row){
                        if($row['PATH']=="upload/"){
                                $this->path="/doc/";
                                $this->name="返回";
                                $this->info="";
                        }else{
                        $this->path="delete.php?DEL=".$row['PATH'];
                        $this->name=$row['NAME'];
                        $this->info=$row['INFO'];}
                }
                
                
        }

        $con = new mysqli("localhost","doc","EmZnmEkIRKFStf91","DOC");/*connect mysql*/
        if ($con->connect_error){die("Could not connect!");}
	
	$result=$con->query('set names utf8');

        $sql="SELECT * FROM DOC WHERE 1";
        $result=$con->query($sql);

if($result){
    // 输出数据
    while($row =  $result->fetch_assoc()){
            if($row['PATH']!="delete.php"){
                $now= new METRO($row);
                $now->OUT();}
    }
} else {echo "没有结果";} ?>
</div>

<?php
        if(!empty($_GET['DEL'])){
                $con = new mysqli("localhost","doc","EmZnmEkIRKFStf91","DOC");/*connect mysql*/
                if ($con->connect_error){die("Could not connect!");}
                
                $result=$con->query('set names utf8');
                unlink($_GET['DEL']);
                $sql="DELETE FROM `DOC` WHERE `PATH`='".$_GET['DEL']."'";
                $result=$con->query($sql);
                echo "<script language='javascript'>alert('删除成功');document.location='/doc/delete.php';</script>";
        }
?>