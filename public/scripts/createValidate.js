function createValidate(event) {
    let valid = true; 

    let name = event.target.name
    let quantity = event.target.quantity
    let price = event.target.price
    let type = event.target.type

    let nameValue = name.value.trim()
    let quantityValue = quantity.value.trim()
    let priceValue = price.value.trim()
    let typeValue = type.value.trim()

    // Name 
    if(voidCheck(nameValue)) {
        name.classList = 'error'
        valid = false 
    }
    else {
        name.classList = 'normal'
    }

    // Quantity
    if(voidCheck(quantityValue) || quantityValue < 0) {
        quantity.classList = 'error'
        valid = false 
    }
    else {
        quantity.classList = 'normal'
    }

    // PriceValue
    if(voidCheck(priceValue) || priceValue < 0) {
        price.classList = 'error'
        valid = false 
    }
    else {
        price.classList = 'normal'
    }

    // Confirm password 
    if(voidCheck(typeValue)) {
        type.classList = 'error'
        valid = false 
    }
    else {
        type.classList = 'normal'
    }

    return valid 
}