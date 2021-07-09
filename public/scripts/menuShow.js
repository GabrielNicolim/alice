function openMenu() {
    window.document.getElementById('user').classList.add('hidden')
    window.document.getElementById('menu').classList.remove('hidden')

    window.document.getElementById('bgMenu').classList.remove('hidden')
}

function closeMenu() {
    window.document.getElementById('user').classList.remove('hidden')
    window.document.getElementById('menu').classList.add('hidden')

    window.document.getElementById('bgMenu').classList.add('hidden')
}