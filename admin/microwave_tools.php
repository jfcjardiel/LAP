<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>

<html>

<?php if (login_check($mysqli) == true) : ?>

<head>
<title>Add Microwave Tools</title>
<!-- somente para essa pagina -->
<link rel="stylesheet" type="text/css" href="style_dispositivo.css">
<script src="jquery.min.js"></script>
<script>
$(document).ready(function() {
    var max_fields      = 30;
    var wrapper         = $(".container_config"); 
    var add_button      = $(".add_form_field"); 
    var del_button      = $(".del_form_field");
    var elem_id;
    var member_now      = '';
    var x = 0; 

    $(add_button).click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ 
            x++;
            $(wrapper).append('<div class="member'+x+'"><div class="left">Atribute Name<br>(How they will see)<br><input type="text" name="nome'+x+'" id="nome'+x+'" maxlength="20"/></div><div class="right">Atribute Name<br>(as in Mathematica)<br><input type="text" name="variavel'+x+'" id="variavel'+x+'"/></div></div>');
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
        member_name = 'nome'+aux_x;
        input_form = document.forms["myform"][member_name];
        if (input_form.value == ""){
                alert("Name must be filled out");
                input_form.focus();
                return false;
        }
        member_name = 'variavel'+aux_x;
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
    <div class="container" align="center">
        <h1> Add New Microwave Tool </h1>
        <form method="post" attribute="post" action="disp_form.php" name="myform" enctype="multipart/form-data" onsubmit="return validateForm()">
        <p>Tool Name:</p><input type="text" name="dispositivo"><br><br>
        <button class="add_form_field"> + </button>
        <button class="del_form_field"> - </button> <br>
        <div class="container_config">
            <div class="member0">
                <div class="left">
                    Atribute Name<br>
                    (How they will see)<br>
                    <input type="text" name="nome0" id="nome0"/>
                </div>
                <div class="right">
                    Atribute Name<br>
                    (as in Mathematica)<br>
                    <input type="text" name="variavel0" id="variavel0"/>
                </div>
            </div>
        </div>
        Here is the File in .txt you are going to upload:
        <input type = "file" name="upfile" id = "upfile"><br><br>
        Here is the IMAGE you are going to upload (JUST JPG):
        <input type = "file" name="upimg" id = "upimg"><br><br>
        <button class="final" type="submit" name="answer" id="answer" value="answer">Submit Microwave Tool</br></button>
    </div>
</form>
</body>

<?php else : ?>

<head>
</head>

<body>

<h1> You are not Allowed </h1>

</body>

<?php endif; ?>

</html>
