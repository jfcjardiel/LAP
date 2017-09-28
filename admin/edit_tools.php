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
              document.getElementById("input_form").innerHTML = "<h1>Microwave Tools created in LAP</h1><p>Here you can edit every tool created in LAP. Just select the tool you want to change the configuration.</p>";
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
        var form_length = document.forms["form_dispositivo"].length-2;
        //building the URL that will be send
        url_send_form = "disp_form/answer.php?id_dispositivo="+id_dispositivo_select;
        url_send_form = url_send_form + "&email=" + document.getElementById('email').value;
        for(var aux_send = 0; aux_send < form_length; aux_send++){
          url_send_form = url_send_form + "&valor" + aux_send + "=" + document.getElementById(aux_send).value;
        }
        alert("Your calculation may take a time. Is it take too long, we are going to send the answer by Email.");
        //alert(url_send_form);
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

      //function to know if the space is empty or not
      function validateForm(id_dispositivo_select){
        //o .length conta o botao tambem
        var form_length = document.forms["form_dispositivo"].length-2;
        //verifying if the form is ok
        var is_form_ok = true;
        //defining the variables for the loop
        var conteudo = '';
        //verifying email
        conteudo = document.getElementById('email').value;
        if(conteudo == ""){
          alert("Name must be filled out");
          is_form_ok = false;          
        }
        //.length counts the button, so we dont have to worry about it
        for(var aux_id = 0; aux_id < form_length; aux_id++){
          conteudo = document.getElementById(aux_id).value;
          if (conteudo == ""){
            if(is_form_ok){
              alert("Name must be filled out");
              is_form_ok = false;
            }
          }
        }
        if(is_form_ok){
          sendForm(id_dispositivo_select);
        }
      }

    </script>
</head>
<body>
<select size="15" id="dispositivo_select" onchange="disp_information(this.value)">
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
    <div id="disp_config"> </div>
    <div id="disp_result"> </div>
</body>
<?php else : ?>
<?php endif; ?>
<html>