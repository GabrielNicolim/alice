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