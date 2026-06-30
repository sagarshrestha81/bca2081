$(document).ready(function () {
    $("#register-account").submit(function (e) {
        e.preventDefault();
        let data = $(this).serialize();
        console.log(data);
        let action = $(':submit').val();
        data = data + '&action=' + action;
        console.log(data);

        $.ajax({
            url: './UserController.php',
            type: 'POST',
            data: data,
            dataType:"json",
            success: function (response) {
                console.log(response);
                // check datatype
                console.log(typeof response);
                // console.log(JSON.parse(response));
                // console.log(typeof JSON.parse(response));
                if(response && response.responseCode == 200){
                     if(response.status == "success"){
                        $("#register-account")[0].reset();
                    }
                    Swal.fire({
                        title: response.status,
                        text: response.message,
                        icon: response.status,
                        showConfirmButton: false,
                        timer: 1500

                    });
                   
                }
                
            }
        });

    });
       $("#login-account").submit(function (e) {
        e.preventDefault();
        let data = $(this).serialize();
        console.log(data);
        let action = $(':submit').val();
        data = data + '&action=' + action;
        console.log(data);

        $.ajax({
            url: './UserController.php',
            type: 'POST',
            data: data,
            dataType:"json",
            success: function (response) {
                console.log(response);
                // check datatype
                console.log(typeof response);
                // console.log(JSON.parse(response));
                // console.log(typeof JSON.parse(response));
                if(response && response.responseCode == 200){

                     if(response.status == "success"){
                        $("#login-account")[0].reset();
                    }
                    Swal.fire({
                        title: response.status,
                        text: response.message,
                        icon: response.status,
                        showConfirmButton: false,
                        timer: 1500

                    });


                    if(response.status == "success"){
                        window.location.href = "/bca2081/project/index.php";
                    }
                   
                }
                
            }
        });

    });


})
