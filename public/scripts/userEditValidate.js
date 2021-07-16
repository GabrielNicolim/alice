function userEditValidate(event) {
    let valid = true;

    let name = event.target.name
    let email = event.target.email
    let password = event.target.password

    let nameValue = name.value.trim()
    let emailValue = email.value.trim()
    let passwordValue = password.value.trim()

    // Name 
    if (voidCheck(nameValue)) {
        name.classList = 'error'
        valid = false
    }
    else {
        name.classList = 'normal'
    }

    // Email
    if (voidCheck(emailValue) || emailValidate(emailValue)) {
        email.classList = 'error'
        valid = false
    }
    else {
        email.classList = 'normal'
    }

    // Confirm password 
    if(voidCheck(passwordValue)) {
        password.classList = 'error'
        valid = false
    }
    else {
        password.classList = 'normal'
    }

    return valid
}