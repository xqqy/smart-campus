

    <!DOCTYPE html>  
    <html>  
    <head>  
        <meta charset="UTF-8">  
        <title>通知</title>  
        <link rel="stylesheet" type="text/css" href="info.css"/>  
    </head>  
    <body>  

 <div style="color:#fff"><?php 
$con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");}

$sql = "select * from AUZN where UID='".$_COOKIE["UID"]."'";/*select things*/
$result = $con->query($sql);
$row =  $result->fetch_assoc();
if($row['PUSH']!=1){die("您没有使用此程序的权限！");}

if(empty($_COOKIE['UID']) or empty($_COOKIE['TOKEN'])){die("请先登录(23)");}/*登录验证*/
        $sql = "SELECT * FROM ADMIN WHERE UID='".$_COOKIE["UID"]."'";
	    $result = $con->query($sql);
	    $row =  $result->fetch_assoc();
if($row['TOKEN']!=$_COOKIE['TOKEN']){die("请先登录(27)");}
?>
</div>

<div style="color:white;font-size:1.5rem;margin-left:20px;heigh:10%"><h1>推送</h1></div>
<div id="message" style="color:#fff"></div>

<div style="position:absolute;top:15%;margin:50px;"> 
        <div class="login">
            <h1>发送推送</h1>
            <p style="color:red">通知七天内有效！支持逗号分割批量发送</p><!--可以用逗号分割来向多个同学发送通知，push指令用于批量发送通知-->
            <form method="post" action="javascript:push()" id="form">
            <button class="sub" type="submit">确定</button>
                <input type="text" required="required" placeholder="UID" name="UID" id="UID"></input>
                <input type="text" required="required" placeholder="通知标题" name="TITLE" id="TITLE"></input>
                <input type="text" required="required" placeholder="通知内容" name="INFO" id="INFO"></input>
                <input type="text" placeholder="超链接" name="LINK" id="LINK"></input>
                
            </form>
        </div>

    </div>
    </body>  
    </html>  

<!--本系统在Apache License2.0协议下开源，您可以在关于页面下载到许可协议。在输入指令页面输入about即可打开-->
<!--This system is open source under Apache License2.0, You can get License in about page,open it by entry "about" in command page-->
<script>
function push(){
    if (window.XMLHttpRequest)
    {// code for all new browsers
        var xhr=new XMLHttpRequest;
    }
    else if (window.ActiveXObject)
    {// code for IE5 and IE6
        var xhr=new ActiveXObject("Microsoft.XMLHTTP");
    }
    if(!xhr){alert("你的浏览器不支持AJAX，请使用Firefox、Chrome等现代浏览器");return;}
    var UID,TI,TO;
    UID=document.getElementById("UID").value;
    TITLE=document.getElementById("TITLE").value;
    INFO=document.getElementById("INFO").value;
    LINK=document.getElementById("LINK").value;
    
    if(self.FormData){
       var post=new FormData();
    post.append("UID",UID);
    post.append("TITLE",TITLE);
    post.append("INFO",INFO);
    post.append("LINK",LINK);
    xhr.open("POST","push.php", true);
    xhr.send(post);}else{
        xhr.open("POST","push.php", true);
        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhr.send("UID="+UID+"&TITLE="+TITLE+"&INFO="+INFO+"&LINK="+LINK);
    }
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("message").innerHTML=xhr.responseText;
                window.setTimeout('document.getElementById("message").innerHTML="";',1000);
                return;
            }
        }
    }
</script>

