function openCreate() {
    window.document.getElementById('shadow').classList = ''
    window.document.getElementById('create').classList = ''
}

function closeCreate() {
    window.document.getElementById('shadow').classList = 'hidden'
    window.document.getElementById('create').classList = 'hidden'
}

function openEdit() {
    window.document.getElementById('shadow').classList = ''
    window.document.getElementById('edit').classList = ''
}

function closeEdit() {
    window.document.getElementById('shadow').classList = 'hidden'
    window.document.getElementById('edit').classList = 'hidden'
}

function openExclude(id) {
    window.document.getElementById('shadow').classList = ''
    window.document.getElementById('exclude').classList = ''

    window.location.href += '?exclude=' + id
}

function closeExclude() {
    window.document.getElementById('shadow').classList = 'hidden'
    window.document.getElementById('exclude').classList = 'hidden'
}