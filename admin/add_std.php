<?php

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>

<?php if (login_check($mysqli) == true) : ?>

<html>
    <meta charset="utf-8">
<head>
<script type="text/javascript">
    //function to know if the space is empty or not
    function validateForm(){
        //o .length conta o botao tambem
        var name_std = document.forms["new_std"]["name_std"];
        var about_std = document.forms["new_std"]["about_std"];
        if(name_std == ""){
          alert("Name must be filled out");
          return false;          
        }
        if(about_std == ""){
          alert("About must be filled out");
          return false;             
        }
    }
</script>
</head>

<body bgcolor="#FFFFFF">
<form method="post" attribute="post" onsubmit="return validateForm()" action="add_std_final.php" enctype="multipart/form-data" id="new_std" name="new_std">
    <p> Student Name: </p>
    <input type='text' name='name_std' placeholder='Student Name' maxlength='30'><br>
    <p>Students Degree in LAP:</p>
    <input type="checkbox" name="phd" value="true"> <a>Phd Student</a>
    <input type="text" name="year_phd" placeholder="Degree Year"><br>
    <input type="checkbox" name="master" value="true"> <a>Master Student</a>
    <input type="text" name="year_master" placeholder="Degree Year"><br>
    <input type="checkbox" name="grad" value="true"> <a>Undergraduate Student</a>
    <input type="text" name="year_grad" placeholder="Degree Year"><br>
    <input type="checkbox" name="std_active" value="true"> <a>Is the student working in LAP?</a>
    <p>About the student: </p>
    <textarea cols="60" rows="10" placeholder="place here information about the student" name="about_std"></textarea><br>
    <p>Here is the IMAGE you are going to upload (JUST JPG):</p>
    <input type = "file" name="std_img" id = "std_img"><br><br>
    <button type="submit" name="change_std" id="change_std" value="change_std">Change Information</br></button> 
</form>
</body>
</html>
<?php else : ?>
<?php endif; ?>