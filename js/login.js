$(document).ready(
    ()=>{
        $('#signin-form').on('submit', (event) =>{
            event.preventDefault();
            //create spinner image
            const spinner =`<img class="spinner" src="images/spinner-loading.png">`;
            $('#signin-btn').append(spinner);
            
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
                $('.spinner').remove();
                if(response.success == true){
                    window.location.href = response.redirect;
                }else{
                    console.log('login failed');
                }
            });
        })
    }
);