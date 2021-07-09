const userEditModal = window.document.getElementById('editUser')
const userInput = window.document.getElementById('userInput')
const shadow = window.document.getElementById('shadow')

function closeEditUser() {
    shadow.classList.add('hidden')
    userEditModal.classList.add('hidden')
}

function openEditUser(id) {
    shadow.classList.remove('hidden')
    userEditModal.classList.remove('hidden')
    userInput.value = id

    closeMenu()
}