<?php require_once('func/functions.php');
    $oDb = new Database();
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Student Area</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <div class="container-fluid">
            <div class="row">
                <div class="student">
                <h1 class="text-uppercase text-center sname">school name</h1>
                <p class="text-center">Address</p>
                    <div class="show_res">
                        <div class="col-sm-6">
                        <div class="row text-center">
                            <h2>Search Result</h2>
                            <form action="inc/options.php" method="post">
                                <input type="hidden" name="OP" value="SRSRES"/>
                                <div class="col-sm-8 col-sm-offset-2">
                                   <div class="row">
                                       <select name="class" id="" class="form-control">
                                           <option value="" default>Select Class</option>
                                           <?php 
                    $qr = $oDb->query("select * from class");
                    while ($result = $oDb->fetch($qr)) {
                        ?>
                        <option value="<?php echo $result['class']; ?>"><?php echo $result['class']; ?></option>
                        <?php
                    }
                ?>
                                       </select>
                                   </div>
                                   <div class="row">
                                       <select name="exam" id="" class="form-control">
                                           <option value="" default>Select Exam</option>
                                           <option value="1">First Term</option>
                                           <option value="2">Second Term</option>
                                           <option value="3">Final</option>
                                       </select>
                                   </div>
                                    <div class="row"><input type="text" name="stuid" class="form-control" placeholder="Student ID"></div>
                                    <div class="row">
                                        <input type="submit" value="Search" class="btn btn-block btn-info"  onclick="search_res(this, event)">
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <h2 class="text-center">Student Login</h2>
                            <div class="col-sm-8 col-sm-offset-2">
                                <div class="row">
                                    <form action="func/form_submit.php" method="post">
                                        <input type="hidden" name="OP" value="STULOGIN"/>
                                        <input type="text" placeholder="Student ID" class="form-control" name="stuid">
                                        <input type="password" placeholder="Password" class="form-control" name="pass">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <input type="checkbox" id="check">
                                                <label for="check"> Remember Me </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row text-right">
                                                <a href="#" class="text-danger">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <input type="submit" value="Login" class="btn btn-block btn-primary" onclick="submitMyForm(this, event)">
                                    </form>
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
