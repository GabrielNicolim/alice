const shadow = window.document.getElementById('shadow')
const create = window.document.getElementById('create')
const exclude = window.document.getElementById('exclude')
const edit = window.document.getElementById('edit')
const editInput = window.document.getElementById('editInput')
const excludeInput = window.document.getElementById('excludeInput')

// Edit 

const editName = window.document.getElementsById("editName")
const editQuantity = window.document.getElementsById("editQuantity")
const editPrice = window.document.getElementsById("editPrice")
const editType = window.document.getElementsById("editType")

// Exclude 

const excludeName = window.document.getElementsById("excludeName")
const excludeQuantity = window.document.getElementsById("excludeQuantity")
const excludePrice = window.document.getElementsById("excludePrice")
const excludeType = window.document.getElementsById("excludeType")

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

    editName.value = window.document.getElementById("name" + id)
    editQuantity.value = window.document.getElementById("qnt" + id)
    editType.value = window.document.getElementById("typ" + id)
    editValue.value = window.document.getElementById("val" + id)
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

    excludeName.value = window.document.getElementById("name" + id)
    excludeQuantity.value = window.document.getElementById("qnt" + id)
    excludeType.value = window.document.getElementById("typ" + id)
    excludeValue.value = window.document.getElementById("val" + id)
}
