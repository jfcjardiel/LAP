<?php
//comecando a conexao mysql

$mysqli = new mysqli('localhost', 'root', 'input212', 'input');

if ($mysqli->connect_errno) {
    echo "Sorry, this website is experiencing problems.";

    // Something you should not do on a public site, but this example will show you
    // anyways, is print out MySQL error related information -- you might log this
    echo "Error: Failed to make a MySQL connection, here is why: \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";

    // You might want to show them something nice, but we will simply exit
    exit;
}

?>

<html>
<head>
<title>Dynamically add input field using jquery</title>
<style>
.container1 input[type=text] {
padding:5px 0px;
margin:5px 5px 5px 0px;
}


.add_form_field
{
    background-color: #1c97f3;
    border: none;
    color: white;
    padding: 8px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border:1px solid #186dad;

}

.del_form_field
{
    background-color: #fd1200;
    border: none;
    color: white;
    padding: 8px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border:1px solid #186dad;

}


input{
    border: 1px solid #1c97f3;
    width: 260px;
    height: 40px;
    margin-bottom:14px;
}

.final{
    background-color: #1c97f3;
    border: none;
    color: white;
    padding: 5px 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;

}
</style>
<script src="jquery.min.js"></script>
<script>
$(document).ready(function() {
    var max_fields      = 10;
    var wrapper         = $(".container1"); 
    var add_button      = $(".add_form_field"); 
    var del_button      = $(".del_form_field");
    var elem_id;
    var member_now      = '';
    var x = 0;
    var input_pai       = $(".input_pai");
    var select_value    = '';

    $(add_button).click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ 
            x++;
            $(wrapper).append('<div class="member'+x+'"><input type="text" name="member'+x+'" id="member'+x+'"/></div>');
        }
	else{
		alert('You Reached the limits entrou aqui');
	}
    });
    $(del_button).click(function(e){
    	e.preventDefault();
    	if(x > 0){
                member_now = '.member'+x; //removendo a classe
                $(member_now).remove();
                x--;
	}
                else
                {
                alert('You Reached the limits')
                }
    });

});

function myFunction(){
    $('.input').remove();
    alert("achou!");
    $(input_pai).append('<div class="input"> Removeu </div>');
}

function validateForm(){
        var member_name = 'dispositivo';
        var input_form = document.forms["myform"][member_name];
	if (input_form.value == ""){
		alert("Name must be filled out");
		return false;
	}
        var aux_x = 0;
        total = document.forms["myform"].length - 5;
	while(aux_x < total){
                member_name = 'member'+aux_x;
                input_form = document.forms["myform"][member_name];
                if (input_form.value == ""){
                        alert("Name must be filled out");
                        input_form.focus();
                        return false;
                }
                aux_x++;
        }
        return true;
}

</script>
</head>
<body>
<form method="post" attribute="post" action="disp_form.php" name="myform" enctype="multipart/form-data" onsubmit="return validateForm()">
<div class="nome_dispositivo">
	<div><input type="text" name="dispositivo"></div>
</div>
<div class="container1">
	<select id="dispositivos_selecionar" name="dispositivos_selecionar" form="dispositivos_selecionar" onchange="myFunction()">
	<option disabled selected value> -- selecione um dispositivo -- </option>
<?php
$sql = "SELECT * FROM dispositivo ORDER BY id_dispositivo";
if (!$result = $mysqli->query($sql)) {
    // Oh no! The query failed.
    echo "Sorry, the website is experiencing problems.";

    // Again, do not do this on a public site, but we'll show you how
    // to get the error information
    echo "Error: Our query failed to execute and here is why: \n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}

// Phew, we made it. We know our MySQL connection and query 
// succeeded, but do we have a result?
if ($result->num_rows === 0) {
    // Oh, no rows! Sometimes that's expected and okay, sometimes
    // it is not. You decide. In this case, maybe actor_id was too
    // large?
    echo "We could not find a match for ID $aid, sorry about that. Please try again.";
    exit;
}

while ($dispositivo = $result->fetch_assoc()) {
	echo "<option value='" . $dispositivo['id_dispositivo'] . "'>".$dispositivo['nome_dispositivo']."</option>";
//    echo $dispositivo['nome_dispositivo'];

}
?>

	</select> 
</div>
<div class="input_pai">
<div class="input">
vamos ver se deleta
</div>
</div>

</form>
</body>
</html>
