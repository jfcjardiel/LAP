<?php

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>
<html>
<!-- Verificando se esta logado... -->
<?php if (login_check($mysqli) == true) : ?>
<!-- ESTA LOGADO -->
<head>
    <script>
      //Function that calls input.php and embedded the code into the page
      function disp_information(str){
          var xhttp;
          //if non is select
          document.getElementById("disp_result").innerHTML = "";
          document.getElementById("disp_config").innerHTML = "";
          if (str == "") {
              document.getElementById("disp_config").innerHTML = "<h1>Microwave Tools created in LAP</h1><p>Here you can edit every tool created in LAP. Just select the tool you want to change the configuration.</p>";
              //document.getElementById("answer_form").innerHTML = "";
              return;
          }
          //if some is, then we will embedded the code of input.php
          //it is important to say, the only data we are going to send is the id by url
          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("disp_config").innerHTML = this.responseText;
            }
          };
          xhttp.open("GET", "change/disp_config.php?id="+str, true);
          xhttp.send();
      }

    </script>
</head>
<body>
<select id="dispositivo_select" onchange="disp_information(this.value)">
    <option value=""> -- Select a Microwave tool -- </option>
        <?php
        //conexao para listar os dispositivos
        $mysqli_disp = new mysqli('localhost', 'root', 'input212', 'input');

        //If there is any error, then show...
        if ($mysqli_disp->connect_errno) {
            // I do not know what to show yet
            echo "<option value=''>Connection Problem</option>";
            exit;
        }

        //If there isnt any error, then lets read the sql content
        $sql = "SELECT * FROM dispositivo WHERE mostrar_dispositivo=TRUE ORDER BY id_dispositivo";
        if (!$result = $mysqli_disp->query($sql)) {
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
        $mysqli_disp->close();
        ?>
    <div id="disp_config">
        <h1>Microwave Tools created in LAP</h1>
        <p>Here you can edit every tool created in LAP. Just select the tool you want to change the configuration.</p>
    </div>
    <div id="disp_result"> </div>


    <!-- initialize jQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Preloader js file -->
    <script src="../js/queryloader2.min.js" type="text/javascript"></script>
    <!-- For smooth animatin  -->
    <script src="../js/wow.min.js"></script>  
    <!-- Bootstrap js -->
    <script src="../s/bootstrap.min.js"></script>
    <!-- slick slider -->
    <script src="../js/slick.min.js"></script>
    <!-- superslides slider -->
    <script src="../js/jquery.easing.1.3.js"></script>
    <script src="../js/jquery.animate-enhanced.min.js"></script>
    <script src="../js/jquery.superslides.min.js" type="text/javascript" charset="utf-8"></script>   
    <!-- for circle counter -->
    <script src='https://cdn.rawgit.com/pguso/jquery-plugin-circliful/master/js/jquery.circliful.min.js'></script>
    <!-- Gallery slider -->
    <script type="text/javascript" language="javascript" src="js/jquery.tosrus.min.all.js"></script>   
   
    <!-- Custom js-->
    <script src="../js/custom.js"></script>
</body>
<?php else : ?>
<?php endif; ?>
<html>