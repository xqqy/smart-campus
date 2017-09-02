<!DOCTYPE html>
<html class="csstransforms csstransforms3d csstransitions" lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>智慧附中系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <script src="/zhfz/metro/js/jquery.js"></script>

    <!--[if lt IE 9]>
    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="js/ie.js"></script>
    <![endif]-->

    <!-- Le styles -->
    
    <link href="/zhfz/metro/css/reset.css" rel="stylesheet">
    <link href="/zhfz/metro/css/grid.css" rel="stylesheet">
    <link href="/zhfz/metro/css/nivo.css" rel="stylesheet">
    <link href="/zhfz/metro/css/custom.css" rel="stylesheet">

<link href="/zhfz/metro/css/metro.css" rel="stylesheet">
    <link href="/zhfz/metro/css/metro-icons.css" rel="stylesheet">
    <link href="/zhfz/metro/css/metro-responsive.css" rel="stylesheet">
    <link href="/zhfz/metro/css/metro-schemes.css" rel="stylesheet">

    <link href="/zhfz/metro/css/docs.css" rel="stylesheet">

    
    <link rel="stylesheet" type="text/css" href="/zhfz/metro/css/prettify.css">
    

</head>

<body style="visibility: visible;">

<div id="page_wrap">

    <header>


        <nav>

            <ul id="menu">
                <li class="">
                    <div class="menu-abs-bg background-color"></div>
                    <div class="services-icon menu-specs">
                        <a href="/root/admin/adminh.php" target="showframe">设置</a>
                        <!--<span>更改密码、设置旧学号、个人信息……</span>-->
                    </div>
                </li>
<?php $con =new mysqli("localhost","login","loginmyphp","MAIN");/*connect mysql*/
if ($con->connect_error){die("Could not connect!");}
	$con->query('set names utf8'); 

$sql = "select * from AUZN where UID='".$_COOKIE["UID"]."'";/*select things*/
$result = $con->query($sql);
$row =  $result->fetch_assoc();
if($row['ZYFZ']==1){
                echo '<li class="">
                    <div class="menu-abs-bg background-color"></div>
                    <div class="services-icon menu-specs">
                        <a href="/root/zyfz/index.php" target="showframe">学时管理</a>
                        <!--<span>更改密码、设置旧学号、个人信息……</span>-->
                    </div>
                </li>';}
if($row['PUSH']==1){
            echo '<li class="">
                    <div class="menu-abs-bg background-color"></div>
                    <div class="services-icon menu-specs">
                        <a href="/root/push/index.php" target="showframe">推送</a>
                        <!--<span>更改密码、设置旧学号、个人信息……</span>-->
                    </div>
                </li>';}?>

                <li class="">
                    <div class="menu-abs-bg background-color"></div>
                    <div class="home-icon menu-specs">
                        <a href="/root/active/index.php" target="showframe" title="设置活动">活动</a>
                        <!--<span>志愿者学时、团籍信息……</span>-->
                    </div>
                </li>
    </ul><!-- Menu ENDS -->

        </nav><!-- Nav ENDS -->

        

    </header><!-- Left Side ENDS -->




<div id="toTop" style="display: none;"></div>

<!-- Placed at the end of the document so the pages load faster -->
<script src="/zhfz/metro/js/isotope.js"></script>
<script src="/zhfz/metro/js/caroufredsel.js"></script>
<script src="/zhfz/metro/js/nivo.js"></script>
<script src="/zhfz/metro/js/jquery_002.js"></script>
<script src="/zhfz/metro/js/tinyscrollbar.js"></script>
<script src="/zhfz/metro/js/custom.js"></script>
<script async="" src="/zhfz/metro/js/analytics.js"></script>
<script src="/zhfz/metro/js/jquery-2.js"></script>
<script src="/zhfz/metro/js/metro.js"></script>
<script src="/zhfz/metro/js/docs.js"></script>
<script src="/zhfz/metro/js/ga.js"></script>
<script async="" src="s_files/adsbygoogle.js"></script>

</body></html>
