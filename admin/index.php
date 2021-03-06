<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>LAP: Laboratório de Antenas e Propagação</title>

    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <!-- <link rel="shortcut icon" type="image/icon" href="img/wpf-favicon.png"/> -->

    <!-- CSS
    ================================================== -->       
    <!-- Bootstrap css file-->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Font awesome css file-->
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <!-- Superslide css file-->
    <link rel="stylesheet" href="../css/superslides.css">
    <!-- Slick slider css file -->
    <link href="../css/slick.css" rel="stylesheet"> 
    <!-- Circle counter cdn css file -->
    <link rel='stylesheet prefetch' href='https://cdn.rawgit.com/pguso/jquery-plugin-circliful/master/css/jquery.circliful.css'>  
    <!-- smooth animate css file -->
    <link rel="stylesheet" href="../css/animate.css"> 
    <!-- preloader -->
    <link rel="stylesheet" href="../css/queryLoader.css" type="text/css" />
    <!-- gallery slider css -->
    <link type="text/css" media="all" rel="stylesheet" href="../css/jquery.tosrus.all.css" />    
    <!-- Default Theme css file -->
    <link id="switcher" href="../css/themes/default-theme.css" rel="stylesheet">
    <!-- Main structure css file -->
    <link href="../style.css" rel="stylesheet">
   
    <!-- Google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>   
    <link href='http://fonts.googleapis.com/css?family=Varela' rel='stylesheet' type='text/css'>    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
 
  </head>
  <body>    

    <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"></a>
    <!-- END SCROLL TOP BUTTON -->

    <!--=========== BEGIN HEADER SECTION ================-->
    <header id="header">
      <!-- BEGIN MENU -->
      <div class="menu_area">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">  <div class="container">
            <div class="navbar-header">
              <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <!-- LOGO -->
              <!-- TEXT BASED LOGO -->
              <!-- <a class="navbar-brand" href="index.html">LAP <span></span></a> -->              
              <!-- IMG BASED LOGO  -->
              <a class="navbar-new" href="../index.html"><img src="../img/logo.png" alt="logo" height="80"></a>          
                     
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
                <li class="active"><a href="../index.html">Home</a></li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Research<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="../research_archive.html">Research archive</a></li>
                      <li><a href="../projects.html">Projects</a></li>
                    </ul>
                  </li>
                              <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">People<span class="caret"</span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="../students.html">Students</a></li>
                      <li><a href="../research_staff.html">Research Staff</a></li>
                    </ul>
                  </li>
                <li><a href ="../microwave_tools.html">Microwave Tools</a></li>                       
                <li><a href="../contact.html">Contact</a></li>
              </ul>           
            </div><!--/.nav-collapse -->
          </div>     
        </nav>  
      </div>
      <!-- END MENU -->    
    </header>
    <!--=========== END HEADER SECTION ================-->

    <!--=========== BEGIN LOGIN BANNER SECTION ================-->
    <section id="imgBanner">
      <h2> Administrator </h2>
    </section>
    <!--=========== END LOGIN BANNER SECTION ================-->

    <?php if (login_check($mysqli) == true) : ?>
    
    <!--=========== BEGIN IF YOU ARE ALREADY LOGEED IN SECTION ================-->
    <section id="admin_page">
      <div class="container">
       <div class="row">
          <div class="col-lg-12 col-md-12"> 
            <div class="title_area">
              <h2 class="title_two"><?php echo 'Logged ' . $logged . ' as ' . htmlentities($_SESSION['username']); ?> </h2>
              <span></span> 
              <?php
                if (isset($_GET['error'])) {
                    echo '<p class="error">Error Logging In!</p>';
                }
              ?> 
            </div>
          </div>
       </div>
       <div class="row">
         <div class="col-lg-4 col-md-4 col-sm-4">
           <div class="sign_info wow fadeInRight">
             <h3>Information</h3>
             <div class="sign_content">
              <?php
                echo '<p>If you want to go to administrator page, <a href="log.php">CLICK HERE</a>.</p>';
                echo '<p>Currently logged ' . $logged . ' as ' . htmlentities($_SESSION['username']) . '.</p>';
                echo '<p>Do you want to change user? <a href="includes/logout.php">Log out</a>.</p>';
              ?>
             </div>
           </div>
         </div>
       </div>
      </div>
    </section>
    <!--=========== END BEGIN IF YOU ARE ALREADY LOGEED IN SECTION ================-->

    <?php else : ?>

    <!--=========== BEGIN IF YOU ARE LOGEED OUT SECTION ================-->
    <section id="admin_page">
      <div class="container">
       <div class="row">
          <div class="col-lg-12 col-md-12"> 
            <div class="title_area">
              <h2 class="title_two"><?php echo 'Logged ' . $logged; ?></h2>
              <span></span> 
              <?php
                if (isset($_GET['error'])) {
                    echo '<p class="error">Error Logging In!</p>';
                }
              ?> 
            </div>
          </div>
       </div>
       <div class="row">
         <div class="col-lg-8 col-md-8 col-sm-8">
           <div class="sign_form wow fadeInLeft">

              <form class="submitphoto_form" action="includes/process_login.php" method="post" name="login_form">
                <input type="text" class="wp-form-control wpcf7-text" placeholder="Email" name="email">          
                <input type="password" class="wp-form-control wpcf7-text" placeholder="Password" name="password" id="password">
                <input type="button" value="Login" class="wpcf7-submit" onclick="formhash(this.form, this.form.password);">
              </form>
           </div>
         </div>
         <div class="col-lg-4 col-md-4 col-sm-4">
           <div class="sign_info wow fadeInRight">
             <h3>Information</h3>
             <div class="sign_content">
              <?php
                echo '<p>Currently logged ' . $logged . '.</p>';
                echo "<p>If you don't have a login, please ask for registration to the administrator";
              ?>
             </div>
           </div>
         </div>
       </div>
      </div>
    </section>
    <!--=========== END BEGIN IF YOU ARE LOGEED OUT SECTION ================-->

    <?php endif; ?>

    <!--=========== BEGIN GOOGLE MAP SECTION ================-->
    <section id="googleMap">
      <br>
    </section>
    <!--=========== END GOOGLE MAP SECTION ================-->
    
    <!--=========== BEGIN FOOTER SECTION ================-->
    <footer id="footer">
      <!-- Start footer top area -->
      <div class="footer_top">
        <div class="container">
          <div class="row">
            <div class="col-ld-3  col-md-3 col-sm-3">
              <div class="single_footer_widget">
                <h3>LAP</h3>
                <p>Laboratory of Antenna e Propagation.</p>
              </div>
            </div>
            <div class="col-ld-3  col-md-3 col-sm-3">
              <div class="single_footer_widget">
                <h3>Community</h3>
                <ul class="footer_widget_nav">
                  <li><a href="#ourTutors">Professors</a></li>
                  <li><a href="#studentsTestimonial">Students</a></li>
                  <li><a href="#">Team</a></li>
                </ul>
              </div>
            </div>
            <div class="col-ld-3  col-md-3 col-sm-3">
              <div class="single_footer_widget">
                <h3>Others</h3>
                <ul class="footer_widget_nav">
                  <li><a href="http://www.ita.br">ITA</a></li>
                </ul>
              </div>
 
            </div>
          </div>
        </div>
      </div>
      <!-- End footer top area -->

      <!-- Start footer bottom area -->
      <div class="footer_bottom">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="footer_bootomLeft">
                <p> Copyright &copy; All Rights Reserved</p>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="footer_bootomRight">
                <p>Designed by <a href="http://wpfreeware.com/" rel="nofollow">Wpfreeware.com</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End footer bottom area -->
    </footer>
    <!--=========== END FOOTER SECTION ================--> 

  

    <!-- Javascript Files
    ================================================== -->

    <!-- files for autentication -->
    <script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script> 

    <!-- initialize jQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Preloader js file -->
    <script src="../js/queryloader2.min.js" type="text/javascript"></script>
    <!-- For smooth animatin  -->
    <script src="../js/wow.min.js"></script>  
    <!-- Bootstrap js -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- slick slider -->
    <script src="../js/slick.min.js"></script>
    <!-- superslides slider -->
    <script src="../js/jquery.easing.1.3.js"></script>
    <script src="../js/jquery.animate-enhanced.min.js"></script>
    <script src="../js/jquery.superslides.min.js" type="text/javascript" charset="utf-8"></script>   
    <!-- for circle counter -->
    <script src='https://cdn.rawgit.com/pguso/jquery-plugin-circliful/master/js/jquery.circliful.min.js'></script>
    <!-- Gallery slider -->
    <script type="text/javascript" language="javascript" src="../js/jquery.tosrus.min.all.js"></script>   
   
    <!-- Custom js-->
    <script src="../js/custom.js"></script>
  <!--=============================================== 
    Template Design By WpFreeware Team.
    Author URI : http://www.wpfreeware.com/
  ====================================================-->

  </body>
</html>
