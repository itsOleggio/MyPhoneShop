export let clearErrors = function (form) {
    let errors = form.querySelectorAll('.error');

    for (let i = 0; i < errors.length; i++)
        errors[i].remove();
}

export let redirect = function(reference) {
    location.href = reference;
}

export let checkName = function (firstname, errors) {
    let nameErrors = [];

    if (firstname.value.length == 0) {
        nameErrors.push('Не указано имя');
    } else {
        let regExp = /^[А-Яа-яЁё" .(),-]+$/g;
        if (!regExp.exec(firstname.value)) {

            nameErrors.push('Имя может содержать только кириллицу, пробел и следующие символы: " , \( \) \. -');
        }
    }

    errors = changeColor(firstname, nameErrors, errors);

    return errors;
}


export let checklast_name = function (lastname, errors) {
    let lastnameErrors = [];

    if (lastname.value.length == 0) {
        lastnameErrors.push('Не указано фамилия');
    } else {
        let regExp = /^[А-Яа-яЁё" .(),-]+$/g;
        if (!regExp.exec(lastname.value)) {

            lastnameErrors.push('Фамилия может содержать только кириллицу, пробел и следующие символы: " , \( \) \. -');
        }
    }

    errors = changeColor(lastname, lastnameErrors, errors);

    return errors;
}


export let changeColor = function (element, elementErrors, errors) {
    if (elementErrors.length == 0) {
        element.style.borderColor = '#e3e3e3';
        element.style.backgroundColor = '#fcfcfc';
    } else {
        for (let i = 0; i < elementErrors.length; i++)
            errors.push(elementErrors[i]);
        element.style.borderColor = 'red';
        element.style.backgroundColor = '#FF000009';
    }

    return errors;
}

export let checkEmail = function (email, errors) {
    let emailErrors = [];

    if (email.value.length == 0) {
        emailErrors.push('Не указана электронная почта');
    }

    errors = changeColor(email, emailErrors, errors);

    return errors;
}



export let generateErrors = function (errorsBlock, errors) {
    errorsBlock.innerHTML = '';

    for (let i = 0; i < errors.length; i++)
    {
        errorsBlock.innerHTML += '<p style="color:red">' + errors[i] + '</p>';
    }
}

export let checkCaptcha = function (captcha, errors) {
    if (!captcha.length) {
        errors.push('Вы не прошли проверку "Я не робот"');
    } else{

    }

}

export let formEvent = function (form, errorsBlock, urlRequest, urlRedirect) {
    let captcha = grecaptcha.getResponse();

    if (errorsBlock.innerHTML == ''){
        let formData = new FormData(form);
        let request = new XMLHttpRequest();

        if (captcha.length) {
            formData.append('g-recaptcha-response', captcha);
        }

        request.open('POST', urlRequest);
        request.responseType = 'json';
        request.onload = () => {
            if (request.status !== 200) {
                return;
            }

            let response = request.response;

            if (response.status == 'ERROR') {
                grecaptcha.reset();
                errorsBlock.innerHTML += '<p class="errors_block_bad">' + response.message + '</p>';
            }
            else
            {

                errorsBlock.innerHTML += '<p class="errors_block_good">' + response.message + '</p>';

                setTimeout(redirect, 2000, urlRedirect);
            }

        }

        request.send(formData);
    }
}

export function hide_areas(areas, current_area) {
    for (let i = 0; i < areas.length; i++) {
        if (areas[i] != current_area) {
            if (!areas[i].hasClass('none')) {
                areas[i].addClass('none');
            }
        }
    }
}

export function checkDate(begin, end, errors) {
    let beginDateErrors = [];
    let endDateErrors = [];

    if (begin.value != '' && end.value != '') {
        if (begin.value > end.value) {
            endDateErrors.push('Конечная дата должна быть больше начальной');
            beginDateErrors.push('Начальная дата должна быть меньше конечной');
        }
    }


    errors = changeColor(begin, beginDateErrors, errors);
    errors = changeColor(end, endDateErrors, errors);

    return errors;
}

export function checkDateInputs(begin_date, end_date, showErrorsBlock) {
    let errors = [];

    checkDate(begin_date, end_date, errors);

    generateErrors(showErrorsBlock, errors);

}

export let checkPassword = function (password, confirmPassword, errors) {
    let passwordErrors = [];
    let confirmPasswordErrors = [];

    if (password.value.length == 0) {
        passwordErrors.push('Не указан пароль');
    } else if (password.value.length < 8) {
        passwordErrors.push('Пароль не должен быть короче 8 символов');
    } else {
        if (!/(?=.*[0-9])/g.exec(password.value)) {
            passwordErrors.push('Пароль должен содержать минимум одну цифру');
        }
        if (!/(?=.*[!@#$%^&*])/g.exec(password.value)) {
            passwordErrors.push('Пароль должен содержать один из следующих спецсимволов: !@#$%^&*');
        }
        if (!/(?=.*[a-z])(?=.*[A-Z])/g.exec(password.value)) {
            passwordErrors.push('Пароль должен содержать только латинские буквы');
        }
        if (!/(?=.*[a-z])/g.exec(password.value)) {
            passwordErrors.push('Пароль должен содержать как минимум одну строчную букву');
        }
        if (!/(?=.*[A-Z])/g.exec(password.value)) {
            passwordErrors.push('Пароль должен содержать как минимум одну прописную букву');
        }
    }

    if (password.value != confirmPassword.value || password.value == '' && confirmPassword.value == '') {
        confirmPasswordErrors.push('Повторный ввод пароля неверный');
    }

    errors = changeColor(password, passwordErrors, errors);
    errors = changeColor(confirmPassword, confirmPasswordErrors, errors);

    return errors;
}



export let check_patronymic_name = function (patronymicname, errors) {
    let patronymicnameErrors = [];

        let regExp = /^[А-Яа-яЁё" .(),-]+$/g;

        if (!regExp.exec(patronymicname.value) && !patronymicname.value.length == 0 ) {

            patronymicnameErrors.push('Отчество может содержать только кириллицу, пробел и следующие символы: " , \( \) \. -');
        }

    errors = changeColor(patronymicname, patronymicnameErrors, errors);

    return errors;
}




