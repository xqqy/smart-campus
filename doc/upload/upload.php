<?php
    if($_POST['job']=="uploading"){   
        if(!is_dir($_POST['docname'])){mkdir($_POST['docname']);}

        move_uploaded_file($_FILES["pkg"]["tmp_name"],$_POST['docname']."/".$_POST['pkgnumic'].".part");
    
    if($_POST['pkgnum']==(count(scandir($_POST['docname']))-3)){
            mix();
        }}
    if($_POST['job']=="ping"){die("pingdone");}
    if($_POST['job']=="ending"){echo "deldone";deldir($_POST['docname']);}



    function mix(){
        $docpath="upload/".$_POST['docname'];
        $docname=$_POST['docname'];
        $ver=0;
        while(file_exists($docpath)){
            $docpath="upload/".$_POST['docname'].".".$ver;
            $docname=$_POST['docname'].".".$ver;
            $ver+=1;
        }
        $doc=fopen($docpath,"w");
        $now=0;

        while($now<=$_POST['pkgnum']){
            $file=fopen($_POST['docname']."/".$now.".part","r");
            while(!feof($file)){
                fwrite($doc,fgets($file));
            }
            fclose($file);
            
            $now+=1;
        }
    deldir($_POST['docname']);
    echo "uploaddone";
    sqlgo($docpath,$docname);
    }


    function deldir($dir) {
  //先删除目录下的文件：
  $dh=opendir($dir);
  while ($file=readdir($dh)) {
    if($file!="." && $file!="..") {
      $fullpath=$dir."/".$file;
      if(!is_dir($fullpath)) {
          unlink($fullpath);
      } else {
          deldir($fullpath);
      }
    }
  }
 
  closedir($dh);
  //删除当前文件夹：
  if(rmdir($dir)) {
    return true;
  } else {
    return false;
  }
}


function sqlgo($doc,$name){
	$con = new mysqli("localhost","doc","EmZnmEkIRKFStf91","DOC");
if ($con->connect_error)
  {
  die('Could not connect: ');
  }

$con->query("set names utf8");
$con->query("INSERT INTO DOC (`PATH`,`NAME`,`INFO`) VALUES ('upload/".$doc."', '".$name."', '".$_POST['pkgnum']."M')");
}


if($_POST['job']=="both"){
	$con = new mysqli("localhost","doc","EmZnmEkIRKFStf91","DOC");
    if ($con->connect_error)
      {
      die('Could not connect:');
      }
    
    $con->query("use names utf8");
$result=$con->query("SELECT * FROM `DOC` WHERE `NAME`='".$_POST['docname']."'");
    if($row =  $result->fetch_assoc()){echo "both";}else{echo "notboth";}}

?>