const shadow = window.document.getElementById('shadow')
const create = window.document.getElementById('create')
const exclude = window.document.getElementById('exclude')
const edit = window.document.getElementById('edit')
const editInput = window.document.getElementById('editInput')
const excludeInput = window.document.getElementById('excludeInput')

// Edit 

const editName = window.document.getElementById("editName")
const editQuantity = window.document.getElementById("editQuantity")
const editPrice = window.document.getElementById("editPrice")
const editType = window.document.getElementById("editType")

// Exclude 

const excludeName = window.document.getElementById("excludeName")
const excludeQuantity = window.document.getElementById("excludeQuantity")
const excludePrice = window.document.getElementById("excludePrice")
const excludeType = window.document.getElementById("excludeType")

function openCreate() {
    shadow.classList = ''
    create.classList = ''
}

function closeCreate() {
    shadow.classList = 'hidden'
    create.classList = 'hidden'
}

function openEdit(id) {
    shadow.classList = ''
    edit.classList = ''
    editInput.value = id

    editName.value = window.document.getElementById("name" + id).innerText
    editQuantity.value = window.document.getElementById("qnt" + id).innerText
    editType.value = window.document.getElementById("typ" + id).innerText
    editPrice.value = window.document.getElementById("val" + id).innerText
}

function closeEdit() {
    shadow.classList = 'hidden'
    edit.classList = 'hidden'
}

function openExclude() {
    shadow.classList = ''
    exclude.classList = ''
}

function closeExclude() {
    shadow.classList = 'hidden'
    exclude.classList = 'hidden'
}

function openExclude(id) {
    shadow.classList = ''
    exclude.classList = ''
    excludeInput.value = id

    excludeName.placeholder = window.document.getElementById("name" + id).innerText
    excludeQuantity.placeholder = window.document.getElementById("qnt" + id).innerText
    excludeType.placeholder = window.document.getElementById("typ" + id).innerText
    excludePrice.placeholder = window.document.getElementById("val" + id).innerText
}
