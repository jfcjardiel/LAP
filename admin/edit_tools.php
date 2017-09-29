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
      xhttp.open("GET", "disp_config.php?id="+str, true);
      xhttp.send();
    }

    //sending data to another page
    function sendForm(id_dispositivo_select){
        //stablihing new XMLHttpRequest
        var xhttp;
        xhttp = new XMLHttpRequest();
        //vendo o tamanho da form
        var form_length = document.forms["mod_disp"].length;
        //alert(form_length);
        var show = document.getElementsByName("show");
        if(show[0].checked == true){
            show_disp = show[0].value;
        }else{
            show_disp = show[1].value;
        }
        alert(show_disp);
        //building the URL that will be send
        url_send_form = "disp_answer.php?id_dispositivo="+id_dispositivo_select;
        for(var aux_send = 0; aux_send < form_length-3; aux_send++){
          url_send_form = url_send_form + "&valor" + aux_send + "=" + document.getElementById(aux_send).value;
        }
        //alert("Check if it is up-to-date");
        alert(url_send_form);
        //inicializing the request
        //xhttp.onreadystatechange = function() {
        //  if (this.readyState == 4 && this.status == 200) {
        //    document.getElementById("answer_form").innerHTML = this.responseText;
        //  }
        //};
        //sending the data to answer.
        //xhttp.open("GET", url_send_form, true);
        //xhttp.send();        
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
            $sql = "SELECT * FROM dispositivo ORDER BY id_dispositivo";
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
    </select>
    <div id="disp_config">
        <h1>Microwave Tools created in LAP</h1>
        <p>Here you can edit every tool created in LAP. Just select the tool you want to change the configuration.</p>
    </div>
    <div id="disp_result"> </div>
</body>
<?php else : ?>
<?php endif; ?>
<html>