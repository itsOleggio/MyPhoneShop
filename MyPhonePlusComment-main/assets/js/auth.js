import {checkEmail, clearErrors, generateErrors, changeColor, redirect, checkCaptcha, formEvent} from "./functions.js";

let authForm = document.querySelector('[name=auth_form]'); // внутри находи по имени форму в документе (в документе где используется скрипт, записывает в переменную)
let authErrorsBlock = authForm.querySelector('.errors_block'); // в форме находим блок ошибок по классу 

let checkPassword = function (password, errors) {
    let passwordErrors = [];

    if (password.value.length == 0) {
        passwordErrors.push('Не указан пароль'); //push добавляет в массив passwordErrors строку не указан пароль 
    }

    errors = changeColor(password, passwordErrors, errors); 

    return errors;
}

let checkAuthInputs = function () {
    let errors = [];

    let email = authForm.querySelector('[name=email]'); // внутри находим внутри документа для майла по имени 
    let password = authForm.querySelector('[name=password]'); // внутри находим внутри документа для пароля по имени 
    let captcha = grecaptcha.getResponse(); // капча 

    checkEmail(email, errors); // проверка 
    checkPassword(password, errors);// проверка 
    checkCaptcha(captcha, errors);// проверка 

    generateErrors(authErrorsBlock, errors);

}

authForm.addEventListener('submit', (e) => {
    e.preventDefault();

    clearErrors(authForm);
    checkAuthInputs();
    formEvent(authForm, authErrorsBlock, '../includes/auth.php', '/'); // редиктор (перенаправление хуй знает куда)

});