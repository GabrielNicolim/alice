function voidCheck(v) {
    return v == undefined || v == '' || v == null ? true : false;
}

function emailValidate(e) {

    const validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/; 
    
    return e.match(validRegex) ? true : false;
}