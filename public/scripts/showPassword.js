function showPassword() {
    let btn = window.document.getElementById('icon')
    let passwordInput = window.document.getElementById('password')    

    btn.classList.toggle('visible')

    if (btn.classList.contains('visible')) {
        btn.src = '../images/eye.svg'
        passwordInput.type = 'text'
    }
    else {
        btn.src = '../images/eye-off.svg'
        passwordInput.type = 'password'
    }
}