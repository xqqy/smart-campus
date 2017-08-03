

    <!DOCTYPE html>  
    <html>  
    <head>  
        <meta charset="UTF-8">  
        <title>团籍信息管理</title>  
        <link rel="stylesheet" type="text/css" href="info.css"/>  
    </head>  
    <body>  

 <div style="color:#fff"><?php 
$con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");}

$sql = "select * from AUZN where UID='".$_COOKIE["UID"]."'";/*select things*/
$result = $con->query($sql);
$row =  $result->fetch_assoc();
if($row['ZHTJ']!=1){die("您没有使用此程序的权限！");}

$sql = "select * from ADMIN where UID='".$_COOKIE["UID"]."'";/*select things*/
$result = $con->query($sql);
$row =  $result->fetch_assoc();
if($row['TOKEN']==$_COOKIE['TOKEN'] and !is_null($_COOKIE['TOKEN'])){
 

                if(!empty($_POST['UID'])){
                      $con->query('set names utf8');
                        $sql = "select * from LOGIN where UID='".$_POST["UID"]."'";/*select things*/
                        $result = $con->query($sql);
                        $row =  $result->fetch_assoc();
                        $name=$row['NAME'];
                        if(empty($name)){echo "查无此人";}else{
                        
                        $tj =new mysqli("localhost","zhtj","zhtjalwayswithyou","ZHTJ");/*connect mysql*/
                      if ($tj->connect_error){die("Could not connect!");} 
                      $tj->query('set names utf8');
                        $sql = "select * from ZHTJMAIN where UID='".$_POST["UID"]."'";/*select things*/
                        $result = $tj->query($sql);
                        $row =  $result->fetch_assoc();
                        $num=$row['NUM'];
                        
                        $sql="UPDATE ZHTJMAIN SET NUM='".$_POST['NUM']."'WHERE UID='".$_POST['UID']."'";
                        $result = $tj->query($sql);

                        if($result){echo $name.$_POST['UID']."团籍代码由".$num."变更为". $_POST['NUM'];}else{echo "ERROR";}}}}
                        else{echo "请先登录";}
?>
</div>

<div style="color:white;font-size:1.5rem;margin-left:20px;heigh:10%"><h1>组织部系统</h1></div>

<div style="position:absolute;top:10%;margin:50px;"> 
        <div class="login">  
            <h1>团籍信息管理</h1>  
            <form method="post" > 
                <input type="text" required="required" placeholder="UID" class="onlyNumAlpha" name="UID"></input>  
                <input type="text" required="required" placeholder="设置代码" class="onlyNumAlpha" name="NUM"></input>  
                <button class="sub" type="submit">更改</button>  
            </form>  
        </div>  
    </div>
    </body>  
    </html>  

<!--本系统在Apache License2.0协议下开源，您可以在关于页面下载到许可协议。在输入指令页面输入about即可打开-->
<!--This system is open source under Apache License2.0, You can get License in about page,open it by entry "about" in command page-->
