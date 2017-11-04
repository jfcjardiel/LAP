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
    <meta charset="utf-8">
    <script>
      //Function that calls input.php and embedded the code into the page
    function std_information(str){
      var xhttp;
      //if non is select
      document.getElementById("std_config").innerHTML = "";
      if (str == "") {
          document.getElementById("std_config").innerHTML = "      <h1>Edit Students</h1><p>Here you can edit every information about the students in LAP.</p>";
          //document.getElementById("answer_form").innerHTML = "";
          return;
      }
      //if some is, then we will embedded the code of input.php
      //it is important to say, the only data we are going to send is the id by url
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("std_config").innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "std_config.php?id_std="+str, true);
      xhttp.send();
    }
    </script>
</head>
<body>
    <div id="selection">
        <select id="dispositivo_select" onchange="std_information(this.value)">
            <option value=""> -- Select the student -- </option>
                <?php
                //conexao para listar os dispositivos
                $mysqli_std = new mysqli('localhost', 'root', 'input212', 'information');

                //If there is any error, then show...
                if ($mysqli_std->connect_errno) {
                    // I do not know what to show yet
                    echo "<option value=''>Connection Problem</option>";
                    exit;
                }

                //If there isnt any error, then lets read the sql content
                $sql = "SELECT * FROM students ORDER BY id_std";
                if (!$result = $mysqli_std->query($sql)) {
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
                while ($std_row = $result->fetch_assoc()) {
                    //it is exibitig the line.
                    echo "<option value='" . $std_row['id_std'] . "'>".$std_row['name_std']."</option>";
                }

                //we should close the connection
                $mysqli_std->close();
                ?>
        </select>
    </div>
    <div id="std_config">
      <h1>Edit Students</h1>
      <p>Here you can edit every information about the students in LAP.</p>
    </div>
</body>
<?php else : ?>
<?php endif; ?>
<html>