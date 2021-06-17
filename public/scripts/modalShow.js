function openCreate() {
    window.document.getElementById('shadow').classList = ''
    window.document.getElementById('create').classList = ''
}

function closeCreate() {
    window.document.getElementById('shadow').classList = 'hidden'
    window.document.getElementById('create').classList = 'hidden'
}

function openEdit(id) {
    window.document.getElementById('shadow').classList = ''
    window.document.getElementById('edit').classList = ''
    window.document.getElementById('editInput').value = id
}

function closeEdit() {
    window.document.getElementById('shadow').classList = 'hidden'
    window.document.getElementById('edit').classList = 'hidden'

}

function openExclude() {
    window.document.getElementById('shadow').classList = ''
    window.document.getElementById('exclude').classList = ''
}

function closeExclude() {
    window.document.getElementById('shadow').classList = 'hidden'
    window.document.getElementById('exclude').classList = 'hidden'
}

function openExclude(id) {
    window.document.getElementById('shadow').classList = ''
    window.document.getElementById('exclude').classList = ''
    window.document.getElementById('excludeInput').value = id
}