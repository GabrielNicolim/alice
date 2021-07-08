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
    shadow.classList.remove('hidden')
    create.classList.remove('hidden')
    closeMenu()
}

function closeCreate() {
    shadow.classList.add('hidden')
    create.classList.add('hidden')
}

function openEdit(id) {
    shadow.classList.remove('hidden')
    edit.classList.remove('hidden')
    editInput.value = id

    editName.value = window.document.getElementById("name" + id).innerText
    editQuantity.value = window.document.getElementById("qnt" + id).innerText
    editType.value = window.document.getElementById("typ" + id).innerText
    editPrice.value = window.document.getElementById("val" + id).innerText.replace("R$ ","")    
    closeMenu()
}

function closeEdit() {
    shadow.classList.add('hidden')
    edit.classList.add('hidden')
}

function closeExclude() {
    shadow.classList.add('hidden')
    exclude.classList.add('hidden')
}

function openExclude(id) {
    shadow.classList.remove('hidden')
    exclude.classList.remove('hidden')
    excludeInput.value = id

    excludeName.placeholder = window.document.getElementById("name" + id).innerText
    excludeQuantity.placeholder = window.document.getElementById("qnt" + id).innerText
    excludeType.placeholder = window.document.getElementById("typ" + id).innerText
    excludePrice.placeholder = window.document.getElementById("val" + id).innerText
    closeMenu()
}