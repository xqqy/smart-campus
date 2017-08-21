

    <!DOCTYPE html>  
    <html>  
    <head>  
        <meta charset="UTF-8">  
        <title>学时管理</title>  
        <link rel="stylesheet" type="text/css" href="score.css"/>  
    </head>  
    <body>  


 <div style="color:#fff">
</div>

<div style="color:white;font-size:1.5rem;margin-left:20px;height:10%"><h1>志愿者部系统</h1></div>
<div id="message" style="color:#fff"></div>
<div style="position:absolute;top:13%;margin:50px;"> 

        <div class="login">  
            <h1>学时管理</h1>  
            <form method="post" action="javascript:xsadd()" id="form" name="form"> 
                <input type="text" required="required" placeholder="UID" class="onlyNumAlpha" id="UID" name="UID" />
                <input type="text" required="required" placeholder="校内学时" class="onlyNumAlpha" id="TI" name="TI" />
                <input type="text" required="required" placeholder="校外学时" class="onlyNumAlpha" id="TS" name="TS" />
                <button class="sub" type="submit">添加</button>
            </form>  
        </div>  


        <div class="login">  
            <h1>获取授权码</h1>  
            <form method="post" action="javascript:xssqm()" id="form" name="form"> 
                <input type="text" required="required" placeholder="获取个数" class="onlyNumAlpha" id="UID" name="UID" />
                <input type="text" required="required" placeholder="校内学时" class="onlyNumAlpha" id="TI" name="TI" />
                <input type="text" required="required" placeholder="校外学时" class="onlyNumAlpha" id="TS" name="TS" />
                <button class="sub" type="submit">提交</button>
            </form>  
        </div>  


<div class="login">  
        <h1 style="font-size:1.5rem">批量学时添加系统</h1>  
	<p style="color:red">导入前必须备份学时表！</p>
        <form action="javascript:xsaddpl" method="post" enctype="multipart/form-data">
			<label for="file">文件名：</label>
			<input type="file" name="file" id="file"><br />
			<button class="sub" type="submit">提交</button>
		</form>
	<a href="/root/admin/app/xs/help.txt">帮助</a>
	</div>
<!--"/root/admin/app/xs/updoc.php"-->


    </div> 
    </body>  
    </html>  
    <script>
    
    function xsadd(){
    var xhr=new XMLHttpRequest;
    var post=new FormData;
    var UID,TI,TO;
    UID=document.getElementById("UID").value;
    TI=document.getElementById("TI").value;
    TO=document.getElementById("TS").value;
    post.append("UID",UID);
    post.append("TI",TI);
    post.append("TS",TO);
    xhr.open("POST","score.php", true);
    xhr.send(post);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("message").innerHTML=xhr.responseText;
            }
        }
    }
    </script>


<?php
$con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");}
    $con->query('set names utf8'); 
    
$sql = "select * from AUZN where UID='".$_COOKIE["UID"]."'";/*select things*/
$result = $con->query($sql);
$row =  $result->fetch_assoc();
if($row['ZYFZ']!=1){die("您没有使用此程序的权限！(22)");}

if(empty($_COOKIE['UID']) or empty($_COOKIE['TOKEN'])){die("请先登录(24)");}/*登录验证*/
        $sql = "SELECT * FROM ADMIN WHERE UID='".$_COOKIE["UID"]."'";
	    $result = $con->query($sql);
	    $row =  $result->fetch_assoc();
    if($row['TOKEN']!=$_COOKIE['TOKEN']){die("请先登录(28)");} ?>

<!--本系统在Apache License2.0协议下开源，您可以在关于页面下载到许可协议。在输入指令页面输入about即可打开-->
<!--This system is open source under Apache License2.0, You can get License in about page,open it by entry "about" in command page-->
