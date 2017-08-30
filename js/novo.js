//function form_maker(str){
//        var xhttp;
//        if (str == "") {
//            document.getElementById("input_form").innerHTML = "";
//            return;
//        }
//        xhttp = new XMLHttpRequest();
//        xhttp.onreadystatechange = function() {
//            if (this.readyState == 4 && this.status == 200) {
//                document.getElementById("input_form").innerHTML = this.responseText;
//            }
//        };
//        xhttp.open("GET", "disp_form/input.php?id="+str, true);
//        xhttp.send();
//}

function form_maker(str){
    alert(str);
}

$('#button_submit').click(function(){
    var Serialized =  $("#form_dispositivo").serialize();
        $.ajax({
           type: "POST",
            url: "/disp_form/answer.php",
            data: Serialized,
            success: function(data) {
                ('#answer_form').manageConfirmResponseOnUpdateSuccess(response);
            },
       error: function(){
            alert('error handing here');
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