<?php require_once('func/functions.php'); 
    $oUsr = new User();
    $oUsr->hasAccess();
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Manage Result</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/icomoon.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <div class="row">
                        <div class="sidebar">
                            <h2><a href="index.html" class="text-capitalize text-center">manage result</a></h2>
                            <ul>
                                <li><a href="#"><span class="glyphicon glyphicon-home"></span>Dashboard</a></li>
                                <li><a href="inc/student_profile.php" onclick="load_part(this, event)"><span class="glyphicon glyphicon-user"></span>Profile</a></li>
                                
                                <?php
                                    $oPermission = new Permission();
                                    echo $oPermission->user_permitted_menu();
                                    
                                ?>
                                <li><a href="login/index.php?out"><span class="glyphicon glyphicon-new-window"></span> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="topbar">
                            <div class="col-sm-8">
                                <div class="row">
                                    <h3>Manage your schools result</h3>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row text-right">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="content">
                            <div class="main">
                                <div class="col-sm-3 col-xs-6">
                                    <div class="each">
                                        <a href="inc/addclass.php" onclick="load_part(this, event)">
                                            <span class="icon-puzzle"></span>
                                            <p>Create Class</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-xs-6">
                                    <div class="each">
                                        <a href="inc/addsubject.php" onclick="load_part(this, event)">
                                            <span class="icon-scope"></span>
                                            <p>Create Subject</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-xs-6">
                                    <div class="each">
                                        <a href="inc/regsubtocls.php" onclick="load_part(this, event)">
                                            <span class="icon-strategy"></span>
                                            <p>Add Subject to class</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    
       
       
        <script src="js/vendor/jquery-1.11.2.min.js"></script>

        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>
