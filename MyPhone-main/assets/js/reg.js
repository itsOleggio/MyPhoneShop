import {
    checkEmail,
    checkName,
    checklast_name,
    check_patronymic_name,
    checkPassword,
    generateErrors,
    checkCaptcha,
    formEvent,
    clearErrors
} from "./functions.js";

let regForm = document.querySelector('[name=reg_form]');
let regErrorsBlock = regForm.querySelector('.errors_block');



let checkRegInputs = function () {
    let errors = [];

    let firstname = regForm.querySelector('[name=first_name]');
    let lastname = regForm.querySelector('[name=last_name]');
    let patronymicname = regForm.querySelector('[name=patronymic_name]');
    let email = regForm.querySelector('[name=email]');
    let password = regForm.querySelector('[name=password]');
    let confirmPassword = regForm.querySelector('[name=password_2]');
    let captcha = grecaptcha.getResponse();

    checkName(firstname, errors);
    checklast_name(lastname,errors);
    check_patronymic_name(patronymicname, errors);
    checkEmail(email, errors);
    checkPassword(password, confirmPassword, errors);
    checkCaptcha(captcha, errors);

    generateErrors(regErrorsBlock, errors);

}



regForm.addEventListener('submit', (e) => {
    e.preventDefault();

    clearErrors(regForm);
    checkRegInputs();
    formEvent(regForm, regErrorsBlock, '../includes/register.php', 'signin.php');
});


