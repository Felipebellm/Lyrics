
 // const email = document.getElementById('email').value;l

 $('#test').on('click', function(e){
    e.preventDefault();
        console.log('aqui foi')
     // Reset messages
     $('.error-message').text('');
     $('#login-message').removeClass('alert-danger alert-success').text('');
     
     // Mostra loading
     BellsAjax.form(this, 
        response => {
            if (response.success) {
                console.log('testou')
            } else {
                alert(response.message);
            }
        },
        error => {
            console.error('Erro:', error);
            alert('Erro na comunicação com o servidor');
        }
    );
   });


