
$("#login-button").on("click", ()=> {
    let email = $("#login-email").val();
    let password = $("#login-password").val().trim();

    if(email.length == 0 || password.length == 0){
        $("#login-error").text("Данные были введены некорректно!")
        return;
    } 

    $.ajax({
        url: "api/auth/signin.php",
        type: "POST",
        cache: false,
        dataType: "html",
        data: {"email": email, "password": password },
        success: (data) =>{
            data = JSON.parse(data); 
            if(data["error"] && data["error"] == 1){
                $("#login-error").text('Такой пользователь незарегистрирован!');
            } else if(data['error'] && data['error'] == 2){
                $("#login-error").text('Email или пароль неверный!');
            }
            else if(data['success']){
                window.location.reload();
                // window.location.href = "http://localhost/project_php/profile.php";
            }
        }
    });
});