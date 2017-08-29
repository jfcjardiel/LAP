//$(document).ready(function() {
    $('#dispositivo_select').change(function () {
        $("#input_form").html("");
        $.ajax({
            url: '/disp_form/input.php',
            method: 'POST',
            data: {id: this.value()},
            success : function(response){
                ('#input_form').manageConfirmResponseOnUpdateSuccess(response);
            },
            error: ('#input_form').manageResponseOnFailure.bind('#input_form');
        });
    });

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


//});

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