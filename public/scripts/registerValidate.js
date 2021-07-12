function registerValidate(event) {
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
    if(voidCheck(nameValue) || nameValue.lenght > 128) {
        name.classList = 'error'
        valid = false 
    }
    else {
        name.classList = 'normal'
    }

    // Email
    if(voidCheck(emailValue) || emailValidate(emailValue) || emailValue.lenght > 128) {
        email.classList = 'error'
        valid = false 
    }
    else {
        email.classList = 'normal'
    }

    // Password
    if(voidCheck(passwordValue) || passwordValue.lenght > 128) {
        password.classList = 'error'
        valid = false 
    }
    else {
        password.classList = 'normal'
    }

    // Confirm password 
    if(voidCheck(confirmPasswordValue) || confirmPasswordValue.lenght > 128) {
        secondPassword.classList = 'error'
        valid = false 
    }
    else if(confirmPasswordValue !== passwordValue) {
        secondPassword.classList = 'error'
        
        valid = false 
    }
    else {
        secondPassword.classList = 'normal'
    }

    return valid
}