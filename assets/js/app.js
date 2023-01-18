// Radio Button
$(document).ready(function () {

    $('.btn-group-toggle label#original-data').click(function () {
        $('.dataLoad #original').css('display', 'block');
        $('.dataLoad #standardized').css('display', 'none');

    });
    $('.btn-group-toggle label#standardized-data').click(function () {
        $('.dataLoad #original').css('display', 'none');
        $('.dataLoad #standardized').css('display', 'block');

    });
});
// Modal show
$('#addressModal').modal("show");

// submit button validate
function validate() {
    var addressA = document.getElementById("address1").value;
    var addressB = document.getElementById("address2").value;
    if (addressA == '' || addressB == '') {
        alert("Please fill all fields!");
        return;
    }

}
// input empty filed
$(document).ready(function () {
    $('#address_form input[type="text"]').blur(function () {
        if (!$(this).val()) {
            $(this).addClass("error");
        } else {
            $(this).removeClass("error");
        }
    });
});
