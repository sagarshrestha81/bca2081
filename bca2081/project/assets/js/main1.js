$(document).ready(function () {
    $("#register-account").submit(function (e) {
        e.preventDefault();
        let data = $(this).serialize();
        console.log(data);
        $.ajax({
            url: './UserController.php',
            type: 'POST',
            data: data,
            success: function (response) {
                console.log(response);
            }
        });

    });


})
