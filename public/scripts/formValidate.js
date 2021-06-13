function voidCheck(v) {
    if(v == undefined || v == '' || v == null) {
        return true
    }
    else {
        return false
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

function changePlaceholder(obj) {
    let name
    switch(obj.name) {
        case "name":
            name = "nome"
            break
        case "email":
            name = "email"
            break
        case "password":
            name = "senha"
            break
        case "confirmPassword":
            name = "Confirmar senha"
            break
    }
    obj.placeholder = name
    obj.classList = 'normal'
}