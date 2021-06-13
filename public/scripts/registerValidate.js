function RegisterValidate(event) {
    let valid = true; 

    let name = event.target.name
    let email = event.target.email
    let password = event.target.password
    let secondPassword = event.target.confirmPassword

    let nameValue = name.value.trim()
    let emailValue = email.value.trim()
    let passwordValue = password.value.trim()
    let confirmPasswordValue = secondPassword.value.trim()

    // Name 
    if(voidCheck(nameValue)) {
        name.classList = 'error'
        name.placeholder = "Preencha este campo"
        valid = false 
    }
    else {
        name.classList = 'normal'
        name.placeholder = 'Email'
    }

    // Email
    if(voidCheck(emailValue)) {
        email.classList = 'error'
        email.placeholder = "Preencha este campo"
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
        password.placeholder = "Preencha este campo"
        valid = false 
    }
    else {
        password.classList = 'normal'
        password.placeholder = 'Senha'
    }

    // Confirm password 
    if(voidCheck(confirmPasswordValue)) {
        secondPassword.classList = 'error'
        secondPassword.placeholder = "Preencha este campo"
        valid = false 
    }
    else if(confirmPasswordValue !== passwordValue) {
        secondPassword.classList = 'error'
        secondPassword.placeholder = "Este campo deve ser igual a senha"
        valid = false 
    }
    else {
        secondPassword.classList = 'normal'
        secondPassword.placeholder = 'Confirmar senha'
    }

    return valid 
}