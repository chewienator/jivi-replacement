$(document).ready(
    ()=>{
        $('#bachelor').on('submit', (event) =>{
            event.preventDefault();
            //create spinner image
            const spinner =`<img class="spinner" src="../images/spinner-loading.png">`;
            $('#save-btn').append(spinner);
            
            //send the data via ajax request to handler /ajax/bachelor.ajax.php
            $.ajax({
                url: '/ajax/bachelor.ajax.php',
                method: 'post',
                dataType: 'json',
                data: $( this ).serialize()
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