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
    if(voidCheck(nameValue) || nameValue.length > 128) {
        name.classList = 'error'
        valid = false 
    }
    else {
        name.classList = 'normal'
    }

    // Email
    if(voidCheck(emailValue) || emailValidate(emailValue) || emailValue.length > 128) {
        email.classList = 'error'
        valid = false 
    }
    else {
        email.classList = 'normal'
    }

    // Contador 

    const letterRegex = /^[A-Z]/;
    const numberRegex = /^[0-9]/;

    let letterCont = 0
    let numberCont = 0
    
    for(let i = 0; i < passwordValue.length; i++) {
        if(passwordValue[i].match(letterRegex)) {
            letterCont++
        }
        else if(passwordValue[i].match(numberRegex)) {
            numberCont++
        }
    }

    // Password
    if(voidCheck(passwordValue) || passwordValue.length > 128 || passwordValue.length < 6 ||
       letterCont < 1 || numberCont < 1) {
        password.classList = 'error'
        valid = false 
    }
    else {
        password.classList = 'normal'
    }

    // Confirm password 
    if(voidCheck(confirmPasswordValue) || confirmPasswordValue.length > 128) {
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

function passwordValidate() {
    let password = window.document.getElementById('password')
    let passwordValue = password.value.trim()
    let error = window.document.getElementById('password-error-box')

    // Contador 

    const letterRegex = /^[A-Z]/;
    const numberRegex = /^[0-9]/;

    let letterCont = 0
    let numberCont = 0
    
    for(let i = 0; i < passwordValue.length; i++) {
        if(passwordValue[i].match(letterRegex)) {
            letterCont++
        }
        else if(passwordValue[i].match(numberRegex)) {
            numberCont++
        }
    }

    //

    if(passwordValue.length > 0) {
        if(passwordValue.length < 6) {
            error.innerText = 'A senha deve conter ao menos 6 caracteres'
        }
        else if(letterCont < 1) {
            error.innerText = 'A senha deve conter ao menos um caractere maiúsculo'
        }
        else if(numberCont < 1){
            error.innerText = 'A senha deve conter ao menos um número'
        }
        else {
            error.innerText = ''
        }
    }
    else {
        error.innerText = ''
    }
}