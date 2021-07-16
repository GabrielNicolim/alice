function RecoverValidate(event) {
    let valid = true; 

    let email = event.target.email
    
    let emailValue = email.value.trim()

    // Email
    if(voidCheck(emailValue) || emailValidate(emailValue) || emailValue.length > 128) {
        email.classList = 'error'
        valid = false 
    }
    else {
        email.classList = 'normal'
    }

    return valid
}