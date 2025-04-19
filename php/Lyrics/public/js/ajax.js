class BellsAjax {
    static call(controller, action, data = {}, method = 'POST') {
        return $.ajax({
            url: 'index.php?url=ajax/call',
            type: method,
            data: {
                controller: controller,
                action: action,
                data: data
            },
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
    }

    static form(formElement, successCallback, errorCallback) {
        // const formData = $(formElement).serializeArray();
        // const action = $(formElement).attr('action');
        // console.log(action)
        // const [controller, method] = action.split('/').filter(Boolean);
        
        // const data = {};
        // formData.forEach(item => {
        //     data[item.name] = item.value;
        // });

        return this.call('Lyrics', 'test', 'data')
            .done(successCallback)
            .fail(errorCallback);
    }
}

// Exemplo de uso:
// BellsAjax.call('user', 'login', {email: 'test@test.com', password: '123'})
//   .then(response => console.log(response))
//   .catch(error => console.error(error));