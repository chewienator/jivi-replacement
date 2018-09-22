$(document).ready(
    ()=>{
        $('#main-form').on('submit', (event) =>{
            event.preventDefault();
            //create spinner image
            const spinner =`<img class="spinner" src="../images/spinner-loading.png">`;
            $('#save-btn').append(spinner);
            
            //send the data via ajax request to handler /ajax/bachelor.ajax.php
            $.ajax({
                url: '/admin/ajax/'+$('#main-form [name=h]').val()+'.ajax.php',
                method: 'post',
                dataType: 'json',
                data: $('#main-form').serialize()
            }).done( (response) => {
                $('.spinner').remove();
                if(response.success == true){
                    if(response.redirect != 'none'){
                        window.location.href = response.redirect;
                    }
                }else{
                    console.log('login failed');
                }
            });
        })
    }
);