function userEditValidate(event) {
    let valid = true; 

    let name = event.target.name
    let email = event.target.email
    let secondPassword = event.target.confirmPassword

    let nameValue = name.value.trim()
    let emailValue = email.value.trim()
    let confirmPasswordValue = secondPassword.value.trim()

    // Name 
    if(voidCheck(nameValue)) {
        name.classList = 'error'
        valid = false 
    }
    else {
        name.classList = 'normal'
    }

    // Email
    if(voidCheck(emailValue) || emailValidate(emailValue)) {
        email.classList = 'error'
        valid = false 
    }
    else {
        email.classList = 'normal'
    }

    // Confirm password 
    if(voidCheck(confirmPasswordValue)) {
        secondPassword.classList = 'error'
        valid = false 
    }
    else {
        secondPassword.classList = 'normal'
    }

    return valid
}