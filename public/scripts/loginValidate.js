function loginValidate(event) {
    let valid = true; 

    let email = event.target.email
    let password = event.target.password

    let passwordValue = password.value.trim()
    let emailValue = email.value.trim()

    // Email
    if(voidCheck(emailValue)) {
        email.classList = 'error'
        email.placeholder = "Esse campo não pode estar vazio"
        valid = false 
    }
    else if(emailValidate(emailValue)) {
        email.classList = 'error'
        email.placeholder = "Insira um email valido"
        valid = false 
    }
    else {
        email.classList = 'normal'
        email.placeholder = 'Email'
    }

    // Password
    if(voidCheck(passwordValue)) {
        password.classList = 'error'
        password.placeholder = "Esse campo não pode estar vazio"
        valid = false 
    }
    else {
        password.classList = 'normal'
        password.placeholder = 'Senha'
    }

    return valid
}

function showPassword() {
    let btn = window.document.getElementById('showPassword')
    let passwordInput = window.document.getElementById('password')

    if(btn.checked) {
        passwordInput.type = 'text'
    }
    else {
        passwordInput.type = 'password'
    }
}