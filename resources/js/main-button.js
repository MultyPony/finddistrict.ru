document.addEventListener('DOMContentLoaded', function () {
    // alert('Hi!');
    let mainForm  = document.querySelector('#main-form');
    let mainBtn = document.querySelector('#main-button');

    mainForm.addEventListener('submit', async function (evt) {
        evt.preventDefault();

        let mainResponse = document.getElementById('main-response');
        mainResponse.innerText = '';

        let mainInput = document.querySelector('#main-input');

        if (mainInput.value.length === 0) {
            mainForm.classList.add('was-validated');
            return;
        }

        const formData = new FormData();
        formData.append('_token', document.querySelector("[name='_token']").value);
        formData.append('address', document.querySelector("[name='address']").value);

        let response = await fetch('/main-request', {
            method: 'POST',
            body: formData
        });

        if (response.ok) {
            console.log('ОК');
            let result = await response.json();

            result.forEach(el => {
                let respAlert = document.createElement('div');
                mainResponse.appendChild(respAlert);
                respAlert.classList.add('alert');
                respAlert.classList.add('alert-success');
                respAlert.innerText= el;
            });

            // resp.innerText = result;
            // resp.classList.remove('d-none');
        } else {
            console.log('Ошибка ' + response);
        }

    });
});

