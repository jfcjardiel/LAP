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

    <!-- somente para essa pagina -->
    <link rel="stylesheet" type="text/css" href="style_dispositivo.css">

    <script>
      //Function that calls input.php and embedded the code into the page
      function form_maker(str){
          var xhttp;
          //if non is select
          if (str == "") {
              document.getElementById("input_form").innerHTML = "<h2 class='blog_title'>Microwave Tools created in LAP</h2><p class='blog_summary'>LAP has created many microwave tools along the years. Here you can see the results of all these years of work. Just select which one you want to see.</p>";
              return;
          }
          //if some is, then we will embedded the code of input.php
          //it is important to say, the only data we are going to send is the id by url
          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("input_form").innerHTML = this.responseText;
            }
          };
          xhttp.open("GET", "disp_form/input.php?id="+str, true);
          xhttp.send();
      }

      //sending data to another page
      function sendForm(id_dispositivo_select){
        //stablihing new XMLHttpRequest
        var xhttp;
        xhttp = new XMLHttpRequest();
        //vendo o tamanho da form
        var form_length = document.forms["form_dispositivo"].length;
        var aux_send = 0;
        //building the URL that will be send
        $url_send_form = "disp_form/answer.php?id_dispositivo="+id_dispositivo_select;
        while(aux_send < form_length){
          $url_send_form = $url_send_form + "&valor" + aux_send + "=" + document.getElementById(aux_send).value;
          aux_send = aux_send + 1;
        }
        //inicializing the request
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("answer_form").innerHTML = this.responseText;
          }
        };
        //sending the data to answer.
        xhttp.open("GET", $url_send_form, true);
        xhttp.send();        
      }

      //function to know if the space is empty or not
      function validateForm(id_dispositivo_select){
        //o .length conta o botao tambem
        var form_length = document.forms["form_dispositivo"].length;
        //verifying if the form is ok
        var is_form_ok = true;
        //defining the variables for the loop
        var aux_id = 0;
        var conteudo = ''
        //.length counts the button, so we dont have to worry about it
        while(aux_id < form_length){
          conteudo = document.getElementById(aux_id).value;
          if (conteudo == ""){
            //just show once if there are multiples
            if(is_form_ok){
              is_form_ok = false;
              alert("Name must be filled out");
            }
          }
          aux_id++;
        }
        //Caso nao haja problemas de preenchimento
        if(is_form_ok){
          //stablihing new XMLHttpRequest
          var xhttp;
          xhttp = new XMLHttpRequest();
          //vendo o tamanho da form
          var form_length = document.forms["form_dispositivo"].length;
          var aux_send = 0;
          //building the URL that will be send
          url_send_form = "disp_form/answer.php?id_dispositivo="+id_dispositivo_select;
          while(aux_send < form_length){
            url_send_form = url_send_form + "&valor" + aux_send + "=" + document.getElementById(aux_send).value;
            aux_send = aux_send + 1;
          }
          //inicializing the request
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("answer_form").innerHTML = this.responseText;
            }
          };
          //sending the data to answer.
          xhttp.open("GET", url_send_form, true);
          xhttp.send();   
        }
      }

    </script>

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
              <a class="navbar-new" href="index.html"><img src="img/logo.png" alt="logo"></a>          
                     
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
                <li class="active"><a href="index.html">Home</a></li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Research<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="404.html">Research archive</a></li>
                      <li><a href="404.html">Projects</a></li>
                    </ul>
                  </li>
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">People<span class="caret"</span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="404.html">Students</a></li>
                      <li><a href="404.html">Research Staff</a></li>
                      <li><a href="404.html">Faculty/PIS</a></li>
                    </ul>
                  </li>
                <li><a href ="404.html">Microwave Tools</a></li>                
                <li><a href="404.html">News</a><li>           
                <li><a href="contact.html">Contact</a></li>
              </ul>           
            </div><!--/.nav-collapse -->
          </div>     
        </nav>  
      </div>
      <!-- END MENU -->    
    </header>
    <!--=========== END HEADER SECTION ================--> 

    <!--=========== BEGIN BANNER SECTION ================-->
    <section id="imgBanner">
      <h2>Microwave Tools</h2>
    </section>
    <!--=========== END BANNER SECTION ================-->
        
    <!--=========== BEGIN COURSE BANNER SECTION ================-->
    <section id="courseArchive">
      <div class="container">
        <div class="row">
          <!-- start course content -->
          <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="courseArchive_content">
              <!-- start blog archive  -->
              <div class="row">
                <div class="col-lg-12 col-12 col-sm-12">
                  <div class="single_blog_archive wow fadeInUp">
                  	<div id="input_form" class="input_form">
                      <h2 class="blog_title">Microwave Tools created in LAP</h2>
                      <p class="blog_summary">LAP has created many microwave tools along the years. Here you can see the results of all these years of work. Just select which one you want to see.</p>
                  	</div>
                  	<div id="answer_form">
                  	</div>
                  </div>
                </div>
              </div>
              <!-- end blog archive  -->
            </div>
          </div>
          <!-- End course content -->

          <!-- start tools  -->
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="courseArchive_sidebar">
              <!-- start single sidebar -->
              <div class="single_sidebar">
                <h2>Available Tools <span class="fa fa-angle-double-right"></span></h2>
                <select size="15" id="dispositivo_select" class="dispositivo_select" onchange="form_maker(this.value)">
                	<option value=""> -- Select a Microwave tool -- </option>
          					<?php
          					//Starting connection
          					$mysqli = new mysqli('localhost', 'root', 'input212', 'input');

          					//If there is any error, then show...
          					if ($mysqli->connect_errno) {
          					    // I do not know what to show yet
          					    echo "<option value=''>Connection Problem</option>";
          					    exit;
          					}

          					//If there isnt any error, then lets read the sql content
          					$sql = "SELECT * FROM dispositivo ORDER BY id_dispositivo";
          					if (!$result = $mysqli->query($sql)) {
          						// I do not know what to show yet
          						echo "<option value=''>Connection Problem</option>";
          					    exit;
          					}

          					// If there is no result
          					if ($result->num_rows === 0) {
          					    // I do not know what to show yet
          					    echo "<option value=''>Connection Problem</option>";
          					    exit;
          					}

          					//Show the results
          					while ($dispositivo = $result->fetch_assoc()) {
          						//it is exibitig the line.
          						echo "<option value='" . $dispositivo['id_dispositivo'] . "'>".$dispositivo['nome_dispositivo']."</option>";
          					}

          					//we should close the connection
          					$mysqli->close();
          					?>
                </select>
              </div>
              <!-- End single sidebar -->
              <!-- start single sidebar -->
              <div class="single_sidebar">
                <h2>Tags <span class="fa fa-angle-double-right"></span></h2>
                <ul class="tags_nav">
                  <li><a href="#"><i class="fa fa-tags"></i>Articles</a></li>
                  <li><a href="#"><i class="fa fa-tags"></i>Posters</a></li>
                  <li><a href="#"><i class="fa fa-tags"></i>Conference</a></li>
                </ul>
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