$(document).ready(
    ()=>{
        $('#signin-form').on('submit', (event) =>{
            event.preventDefault();
            //get form data
            let eml = $("#email").val();
            let pwd = $("#password").val();
            //create a data object
            let loginData = {email:eml, password:pwd };
            //send the data via ajax request to handler /ajax/login.ajax.php
            $.ajax({
                url: '/ajax/login.ajax.php',
                method: 'post',
                dataType: 'json',
                data: loginData
            }).done( (response) => {
                if(response.success == false){
                    msgHandler(response.success, response.msg);
                }
                if(response.redirect != 'none'){
                    setTimeout(function(){window.location.href = response.redirect; }, 3000);
                }
            });
        })
    }
);