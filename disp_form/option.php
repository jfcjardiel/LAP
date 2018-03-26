<select size="15" id="dispositivo_select" class="dispositivo_select" onchange="form_maker(this.value)">
  <option value=""> -- Select a Microwave tool -- </option>
    <?php
    //Starting connection
    $mysqli = new mysqli('localhost', 'write_from_php', 'escrevendo_dados', 'input');

    //If there is any error, then show...
    if ($mysqli->connect_errno) {
        // I do not know what to show yet
        echo "<option value=''>Connection Problem</option>";
        exit;
    }

    //If there isnt any error, then lets read the sql content
    $sql = "SELECT * FROM dispositivo WHERE mostrar_dispositivo=TRUE ORDER BY id_dispositivo";
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