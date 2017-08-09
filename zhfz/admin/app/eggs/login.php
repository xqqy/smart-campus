<?php

function sha512($data, $rawOutput=false){
                if(!is_scalar($data)){
                        return false;
                }
                $data = (string)$data;
                $rawOutput = !!$rawOutput;
                return hash('sha512', $data, $rawOutput);
        }

$con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql*/
if ($con->connect_error)
  {
  die('Could not connect: ' . mysql_error());
  }

if($_POST["UID"]==null){echo "Entry a UID!";}/*UID NULL CHECK*/
else {
$sql = "select * from LOGIN where UID=".$_POST["UID"];/*select things*/
$result = $con->query($sql);
$row =  $result->fetch_assoc();

echo "sqlUID=".$row['UID']."sqlPSWD=".$row['PSWD'];

if($row['PSWD']==null){echo "NO USERS FIND!";}/*echo if no users*/
else{


if(password_verify(sha512($_POST['PSWD']),$row['PSWD']))
	{
	echo "LOGED IN!<br />";
	echo "<script language='javascript'>document.location = 'loged.php'</script>";}

else{echo "ERROR!<br />";
echo "<a href='index.html'><button>PASSWORD WRONG! Try again!</button></a><br />";
echo "<a href='mailto:tuanwei@bjsdfz.com?subject=bad login!'><button>Call us for help</button></a><br />";}}}

$con->close();
?>

<!--echo entry-->
postUID:<?php echo $_POST["UID"]." "; ?>
postPSWD:<?php echo $_POST["PSWD"]; ?><br />
postMD5:<?php echo md5($_POST["PSWD"]);?>
<title>Login system</title>
