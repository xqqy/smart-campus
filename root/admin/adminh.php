

    <!DOCTYPE html>  
    <html>  
    <head>  

        <meta charset="UTF-8">  
        <title>更改密码</title>  
        <link rel="stylesheet" type="text/css" href="admin.css"/>

<script>(function(i,s,o,g,r,a,m){i["DaoVoiceObject"]=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;a.charset="utf-8";m.parentNode.insertBefore(a,m)})(window,document,"script",('https:' == document.location.protocol ? 'https:' : 'http:') + "//widget.daovoice.io/widget/96c356a7.js","daovoice")</script>
<script src="/zhfz/metro/js/sha512.js"></script>
    </head> 
 
    <body>  

<div style="color:white;font-size:1.5rem;margin-left:20px;heigh:10%"><h1>设置</h1></div>


<div style="top:10%;height:90%">

        <div class="login">  
            <h1>更改密码</h1>  
            <form method="post" id="form">  

        <input type="password" id="opswd" required="required" placeholder="原密码" class="onlyNumAlpha" name="OPSWD"></input>
	<input type="password" id="npswd" required="required" placeholder="新密码" class="onlyNumAlpha" name="NPSWD"></input>  
	<input type="password" id="apswd" required="required" placeholder="再次输入" class="onlyNumAlpha" name="RPSWD"></input>    
                <br /><br />
                <button class="sub" type="submit" onclick="mypswd()">确定</button>  <br />
            </form>  

<p style="color:white">
<?php
if(!empty($_POST['OPSWD'])){
$con =new mysqli("localhost","register","registerpswdbjsdfz","MAIN");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");;}

if(!$_COOKIE["UID"]){echo "请先登录";}else{


$sql = "select * from ADMIN where UID='".$_COOKIE["UID"]."'";/*select things*/
$result = $con->query($sql);
$row =  $result->fetch_assoc();

/*check password*/
if(password_verify($_POST['OPSWD'],$row['PSWD']))

	{if($_POST["NPSWD"]==$_POST["RPSWD"])
		{$sql="UPDATE ADMIN SET PSWD='". password_hash($_POST["NPSWD"],PASSWORD_DEFAULT) ."' WHERE UID='".$_COOKIE["UID"]."'";
		$result=$con->query($sql);
			if($result)
			{echo "密码更改成功!";}
			else{echo "密码更改失败！";}}
		else{echo "两次输入不一致";}}
	else{echo "原密码错误";}}

$con->close();}
?>
</p>
        </div>  

        <div class="login">  
            <h1>输入你的指令</h1>  
            <form method="post" action="bush.php">  

<p style="color:#000">点击确定前请确定指令及其附加值正确，错误的指令可能损坏您的账户！</p>
                <input type="text" required="required" placeholder="指令" class="onlyNumAlpha" name="CMD"></input>  
                <input type="text" placeholder="附加值" class="onlyNumAlpha" name="ADD"></input>  
                <button class="sub" type="submit">我已知风险并确定继续</button>  
		
            </form>  
        </div>

    <div class="login">  
            <h1>关于</h1> <br /><br /> 
            <a href="/License.txt"><button class="reg">License</button></a><br /><br />
                <a href="/Thanks.txt"><button class="reg">Thanks</button></a>
        </div>  
    </div>  

<script>
    function mypswd(){
         npswd=document.getElementById("npswd")
         opswd=document.getElementById("opswd")
         apswd=document.getElementById("apswd")
        if(npswd.value=="" || opswd.value=="" || apswd.value==""){
            window.alert("请输入所有信息");
        }
        else{
        npswd.value=sha512(npswd.value);
        opswd.value=sha512(opswd.value);
        apswd.value=sha512(apswd.value);
        document.getElementById("form").submit();}
    }
</script>
    </body>
    </html>


