<!DOCTYPE HTML>
<head>
    <title>登出</title>
    <meta charset="UTF-8">
</head>
<?php 

$con =new mysqli("localhost","register","registerpswdbjsdfz","MAIN");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");}
$sql = "UPDATE LOGIN SET TOKEN='' WHERE UID='".$_COOKIE["UID"]."'";
$result = $con->query($sql);

setcookie("UID", null,time()-3600);
setcookie("TOKEN", null,time()-3600);
?>



<h1>登出成功！两秒后自动跳转</h1>
<script>window.setTimeout("window.location='index.php'",2000); </script>
