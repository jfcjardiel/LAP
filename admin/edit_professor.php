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
    function prof_information(str){
      var xhttp;
      //if non is select
      document.getElementById("prof_config").innerHTML = "";
      if (str == "") {
          document.getElementById("prof_config").innerHTML = "<h1>Edit Professors</h1><p>Here you can edit every information about the professors in LAP.</p>";
          //document.getElementById("answer_form").innerHTML = "";
          return;
      }
      //if some is, then we will embedded the code of input.php
      //it is important to say, the only data we are going to send is the id by url
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("prof_config").innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "prof_config.php?id_prof="+str, true);
      xhttp.send();
    }
    </script>
</head>
<body>
    <div id="selection">
        <select id="dispositivo_select" onchange="prof_information(this.value)">
            <option value=""> -- Select the professor -- </option>
                <?php
                //conexao para listar os dispositivos
                $mysqli_prof = new mysqli('localhost', 'root', 'input212', 'information');

                //If there is any error, then show...
                if ($mysqli_prof->connect_errno) {
                    // I do not know what to show yet
                    echo "<option value=''>Connection Problem</option>";
                    exit;
                }

                //If there isnt any error, then lets read the sql content
                $sql = "SELECT * FROM professors ORDER BY id_prof";
                if (!$result = $mysqli_prof->query($sql)) {
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
                while ($professor = $result->fetch_assoc()) {
                    //it is exibitig the line.
                    echo "<option value='" . $professor['id_prof'] . "'>".$professor['name_prof']."</option>";
                }

                //we should close the connection
                $mysqli_prof->close();
                ?>
        </select>
    </div>
    <div id="prof_config">
      <h1>Edit Professors</h1>
      <p>Here you can edit every information about the professors in LAP.</p>
    </div>
</body>
<?php else : ?>
<?php endif; ?>
<html>