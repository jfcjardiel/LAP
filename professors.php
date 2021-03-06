<?php

//getting professor
if(isset($_REQUEST["id_prof"])){
  $id_prof = $_REQUEST["id_prof"];
}else{
  echo "<h1> Connection Problem1 </h1>";
  exit;
}

//*******************************//
//***** READING DATABSE *********//
//*******************************//

//Starting connection
$mysqli_information = new mysqli('localhost', 'root', 'input212', 'information');

//If there is any error, then show...
if ($mysqli_information->connect_errno) {
    // I do not know what to show yet
    echo "<p>Connection Problem2 </p>";
    exit;
}

//If there isnt any error, then lets read the sql content
$sql = "SELECT * FROM professors WHERE id_prof=" . $id_prof;
if (!$result = $mysqli_information->query($sql)) {
    // I do not know what to show yet
    echo "<p>Connection Problem3 </p>";
    exit;
}

// If there is no result (don't apply in this case)
if ($result->num_rows === 0) {
    // I do not know what to show yet
    echo "<p>Connection Problem4 </p>";
    exit;
}

//pegando o nome do professor
$prof_row = $result->fetch_assoc();
$name_prof = $prof_row['name_prof'];
$show_prof = $prof_row['show_professor'];
$email_prof = $prof_row['email'];
$about_prof = $prof_row['about_prof'];

?>



<html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>Laboratory of Antennas and Propagation</title>

    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/icon" href="img/logolap2.png"/>

    <!-- CSS
    ================================================== -->       
    <!-- Bootstrap css file-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Font awesome css file-->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Superslide css file-->
    <link rel="stylesheet" href="css/superslides.css">
    <!-- Slick slider css file -->
    <link href="css/slick.css" rel="stylesheet"> 
    <!-- Circle counter cdn css file -->
    <link rel='stylesheet prefetch' href='https://cdn.rawgit.com/pguso/jquery-plugin-circliful/master/css/jquery.circliful.css'>  
    <!-- smooth animate css file -->
    <link rel="stylesheet" href="css/animate.css"> 
    <!-- preloader -->
    <link rel="stylesheet" href="css/queryLoader.css" type="text/css" />
    <!-- gallery slider css -->
    <link type="text/css" media="all" rel="stylesheet" href="css/jquery.tosrus.all.css" />    
    <!-- Default Theme css file -->
    <link id="switcher" href="css/themes/default-theme.css" rel="stylesheet">
    <!-- Main structure css file -->
    <link href="style.css" rel="stylesheet">
   
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
              <a class="navbar-new" href="index.html"><img src="img/logo.png" alt="logo" height="80"></a>          
                     
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
                <li class="active"><a href="index.html">Home</a></li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Research<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="research_archive.html">Research archive</a></li>
                      <li><a href="projects.html">Projects</a></li>
                      <li><a href="gallery_research.html">Gallery</a></li>
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">People<span class="caret"</span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="research_staff.html">Research Staff</a></li>
					  <li><a href="students.html">Students</a></li>
					  <li><a href="std_awards.html">Awards</a></li>
                      <li><a href="gallery_people.html">Gallery</a></li>
                    </ul>
                  </li>
                <li><a href ="microwave_tools.html">Microwave Tools</a></li>
				<li><a href ="course-archive.html">Education</a></li>				
                <li><a href="contact.html">Contact</a></li>
              </ul>           
            </div><!--/.nav-collapse -->
          </div>     
        </nav>  
      </div>
      <!-- END MENU -->    
    </header>
    <!--=========== END HEADER SECTION ================-->

    <!--=========== BEGIN COURSE BANNER SECTION ================-->
    <section id="imgBanner">
      <h2>Research Staff</h2>
    </section>
    <!--=========== END COURSE BANNER SECTION ================-->

    
    <!--=========== BEGIN COURSE BANNER SECTION ================-->
    <section id="courseArchive">
      <div class="container">
        <div class="row">
          <!-- start course content -->
          <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="courseArchive_content">              
				<div class="single_course_content">
			
			
				<!-- Foto, nome e resumo do professor -->
				<h2 class="titile"> <?php echo $name_prof; ?> </h2>	
				<table border="0" width="95%">
					<tr>
						<td width="25%" valign="top">
						<p align="center"><img border="0" src=<?php echo "'"; echo "../img/professor/".$id_prof.".jpg"; echo "'"; ?> width="150" height="180"></td>
						<td width="75%" valign="top">
						<p align="justify">
						<span style="font-size:13.0pt;font-family:&quot;Times New Roman&quot;;mso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:PT-BR;mso-fareast-language:PT-BR;mso-bidi-language:AR-SA"> <?php echo $about_prof; ?> </span></p>
					</tr>
				</table>
				<!-- ------------------------------- -->
								
				
			<!-- Publicações do Professor -->

			<h2> &nbsp </h2>
			<h2> Publications </h2>

			<table class="table table-striped course_table">
					<thead>
						<tr>          
							<th>Magazines</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
				<tbody>

			<?php
				//********************************//
				//***** READING ARTICLES *********//
				//********************************//

				//If there isnt any error, then lets read the sql content
				$sql = "SELECT * FROM articles WHERE id_prof=" . $id_prof . " AND art_magazine=TRUE ORDER BY year DESC";
				if (!$result = $mysqli_information->query($sql)) {
					// I do not know what to show yet
					echo "<p>Connection Problem </p>";
				exit;
}

				//getting the number of articles
				$num_articles = $result->num_rows;
				$art_year = 0;

				if ($num_articles > 0) {
				//Writing the form options
					while ($config_dispositivo = $result->fetch_assoc()) {
					//it is exibitig the line.
						echo '<tr><td>';
						if($art_year != $config_dispositivo['year']){
							echo $config_dispositivo['year'];
							$art_year = $config_dispositivo['year'];
						}
						echo "</td>";
						echo '<td>['.$num_articles.']</td><td>';
						echo $config_dispositivo['reference'];
						echo  '</td></tr>';
						$num_articles = $num_articles - 1;
					}
				}

			?>
			</table>
				
				
			<table class="table table-striped course_table">
					<thead>
						<tr>          
							<th>Books</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
				<tbody>

			<?php
				//********************************//
				//***** READING ARTICLES *********//
				//********************************//

				//If there isnt any error, then lets read the sql content
				$sql = "SELECT * FROM articles WHERE id_prof=" . $id_prof . " AND art_book=TRUE ORDER BY year DESC";
				if (!$result = $mysqli_information->query($sql)) {
					// I do not know what to show yet
					echo "<p>Connection Problem </p>";
				exit;
}

				//getting the number of articles
				$num_articles = $result->num_rows;
				$art_year = 0;

				if ($num_articles > 0) {
				//Writing the form options
					while ($config_dispositivo = $result->fetch_assoc()) {
					//it is exibitig the line.
						echo '<tr><td>';
						if($art_year != $config_dispositivo['year']){
							echo $config_dispositivo['year'];
							$art_year = $config_dispositivo['year'];
						}
						echo "</td>";
						echo '<td>['.$num_articles.']</td><td>';
						echo $config_dispositivo['reference'];
						echo  '</td></tr>';
						$num_articles = $num_articles - 1;
					}
				}

			?>
			</table>
			
			
			
			<table class="table table-striped course_table">
					<thead>
						<tr>          
							<th>Conferences</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
				<tbody>

			<?php
				//********************************//
				//***** READING ARTICLES *********//
				//********************************//

				//If there isnt any error, then lets read the sql content
				$sql = "SELECT * FROM articles WHERE id_prof=" . $id_prof . " AND art_conference=TRUE ORDER BY year DESC";
				if (!$result = $mysqli_information->query($sql)) {
					// I do not know what to show yet
					echo "<p>Connection Problem </p>";
				exit;
}

				//getting the number of articles
				$num_articles = $result->num_rows;
				$art_year = 0;

				if ($num_articles > 0) {
				//Writing the form options
					while ($config_dispositivo = $result->fetch_assoc()) {
					//it is exibitig the line.
						echo '<tr><td>';
						if($art_year != $config_dispositivo['year']){
							echo $config_dispositivo['year'];
							$art_year = $config_dispositivo['year'];
						}
						echo "</td>";
						echo '<td>['.$num_articles.']</td><td>';
						echo $config_dispositivo['reference'];
						echo  '</td></tr>';
						$num_articles = $num_articles - 1;
					}
				}

			?>
			</table>	
		
			<!-- --------------------------------- -->
				
             </div>
            </div>
          </div>
          <!-- End course content -->

          <!-- start course archive sidebar -->
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="courseArchive_sidebar">
              <!-- start single sidebar -->
              <div class="single_sidebar">
                <h2>More About Us <span class="fa fa-angle-double-right"></span></h2>
                <ul class="news_tab">
                  <li>
                    <div class="media">
                      <div class="media-left">
                        <a href="#" class="news_img">
                          <img alt="img" src="img/news.jpg" class="media-object">
                        </a>
                      </div>
                      <div class="media-body">
                       <a href="std_awards.html">See our students and staff awards.</a>
                       <span class="feed_date">Since 2000</span>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="media">
                      <div class="media-left">
                        <a href="#" class="news_img">
                          <img alt="img" src="img/news.jpg" class="media-object">
                        </a>
                      </div>
                      <div class="media-body">
                       <a href="projects.html">See our projects.</a>
                       <span class="feed_date">Since 2000</span>                
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="media">
                      <div class="media-left">
                        <a href="#" class="news_img">
                          <img alt="img" src="img/news.jpg" class="media-object">
                        </a>
                      </div>
                      <div class="media-body">
                       <a href="research_archive.html">See our publications</a>
                       <span class="feed_date">Since 1980</span>                
                      </div>
                    </div>
                  </li>                  
                </ul>
              </div>
              <!-- End single sidebar -->
              <!-- start single sidebar -->
              <div class="single_sidebar">
                <h2>Quick Links <span class="fa fa-angle-double-right"></span></h2>
                <ul>
                  <li><a href="http://www.jmoe.org/">JMOe - Journal of Microwaves, Optoelectronics and Electromagnetic Applications</a></li>
                  <li><a href="http://www.sbmo.org.br/">SBMO - Brazilian Microwave and Optoelectronics Society</a></li>
                  <li><a href="http://sbmag.org.br/">SBMAG - Brazilian Society of Electromagnetism</a></li>
                  <li><a href="https://www.ieeeaps.org/">APS - IEEE Antennas and Propagation Society</a></li>
				  <li><a href="https://www.ita.br/">ITA - Technological Institute of Aeronautics</a></li>
                </ul>
              </div>
              <!-- End single sidebar -->
              <!-- start single sidebar
              
			  <div class="single_sidebar">
                <h2>ITA <span class="fa fa-angle-double-right"></span></h2>
                <a class="side_add" href="http://www.ita.br"><img src="img/ita.png" alt="img" height="100%" width="100%"></a>
              </div>
              
			  <!-- End single sidebar -->
            </div>
          </div>
          <!-- start course archive sidebar -->
        </div>
      </div>
    </section>
    <!--=========== END COURSE BANNER SECTION ================-->
    
<!--=========== BEGIN FOOTER SECTION ================-->
    <footer id="footer">
      <!-- Start footer top area -->
      <div class="footer_top">
        <div class="container">
          <div class="row">
            <div class="col-ld-3  col-md-3 col-sm-3">
              <div class="single_footer_widget">
                <h3>LAP</h3>
                <p>Laboratory of Antennas and Propagation</p>
              </div>
            </div>
            <div class="col-ld-3  col-md-3 col-sm-3">
              <div class="single_footer_widget">
                <h3>Community</h3>
                <ul class="footer_widget_nav">
                  <li><a href="research_staff.html">Research Staff</a></li>
                  <li><a href="students.html">Students</a></li>
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
                <p>Designed by LAP</p>
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

    <!-- initialize jQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Preloader js file -->
    <script src="js/queryloader2.min.js" type="text/javascript"></script>
    <!-- For smooth animatin  -->
    <script src="js/wow.min.js"></script>  
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- slick slider -->
    <script src="js/slick.min.js"></script>
    <!-- superslides slider -->
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.animate-enhanced.min.js"></script>
    <script src="js/jquery.superslides.min.js" type="text/javascript" charset="utf-8"></script>   
    <!-- for circle counter -->
    <script src='https://cdn.rawgit.com/pguso/jquery-plugin-circliful/master/js/jquery.circliful.min.js'></script>
    <!-- Gallery slider -->
    <script type="text/javascript" language="javascript" src="js/jquery.tosrus.min.all.js"></script>   
   
    <!-- Custom js-->
    <script src="js/custom.js"></script>
  <!--=============================================== 
    Template Design By WpFreeware Team.
    Author URI : http://www.wpfreeware.com/
  ====================================================-->

  </body>
</html>