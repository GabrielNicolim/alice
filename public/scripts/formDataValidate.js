function voidCheck(v) {
    if(v == undefined || v == '' || v == null) {
        return true
    }
    else {
        return false
    }
}

function loginValidate() {
    let email = window.document.getElementById('email')
    let password = window.document.getElementById('password')

    let passwordValue = password.value.trim()
    let emailValue = email.value.trim()

    if(voidCheck(passwordValue)) {
        password.classList = 'error'
        password.placeholder = "Esse campo não pode estar vazio"
    }
    else {
        password.classList = 'normal'
        password.placeholder = 'Senha'
    }

    if(voidCheck(emailValue)) {
        email.classList = 'error'
        email.placeholder = "Esse campo não pode estar vazio"
    }
    else if(emailValidate(emailValue)) {
        email.classList = 'error'
        email.placeholder = "Insira um email valido"
    }
    else {
        email.classList = 'normal'
        email.placeholder = 'Email'
    }
}

function emailValidate(e) {
    const validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

    if(!e.match(validRegex)) {
        return true;
    }
    else {
        return false;
    }
}

function RegisterValidate() {
    let name = window.document.getElementById('name')
    let email = window.document.getElementById('email')
    let password = window.document.getElementById('password')
    let secondPassword = window.document.getElementById('confirmPassword')

    let nameValue = name.value.trim()
    let emailValue = email.value.trim()
    let passwordValue = password.value.trim()
    let confirmPasswordValue = secondPassword.value.trim()

    // Name 
    if(voidCheck(nameValue)) {
        name.classList = 'error'
        name.placeholder = "Preencha este campo"
    }
    else {
        name.classList = 'normal'
        name.placeholder = 'Email'
    }

    // Email
    if(voidCheck(emailValue)) {
        email.classList = 'error'
        email.placeholder = "Preencha este campo"
    }
    else if(emailValidate(emailValue)) {
        email.classList = 'error'
        email.placeholder = "Insira um email valido"
    }
    else {
        email.classList = 'normal'
        email.placeholder = 'Email'
    }

    // Password
    if(voidCheck(passwordValue)) {
        password.classList = 'error'
        password.placeholder = "Preencha este campo"
    }
    else {
        password.classList = 'normal'
        password.placeholder = 'Senha'
    }

    // Confirm password 
    if(voidCheck(confirmPasswordValue)) {
        secondPassword.classList = 'error'
        secondPassword.placeholder = "Preencha este campo"
    }
    else if(confirmPasswordValue !== passwordValue) {
        secondPassword.classList = 'error'
        secondPassword.placeholder = "Este campo deve ser igual a senha"
    }
    else {
        secondPassword.classList = 'normal'
        secondPassword.placeholder = 'Confirmar senha'
    }
}