<?php
    
        $con =new mysqli("localhost","app","rbTZahu47o1xPNVs","APP");/*connect mysql*/
    if ($con->connect_error){die("Could not connect! 无法连接");}

$sql = "select * from CHCK where QR='".$_POST["QR"]."'";/*select things*/
$result = $con->query($sql);
$row =  $result->fetch_assoc();

if(!$result){die("!查无此人");}else{
echo $row['RTUN'];}
    


?>