function removeValidate() {
    document.getElementById('cleanfiles').checked = true; 
    document.getElementById('fileForm').submit();
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        window.document.getElementById('imagePreview').classList.remove('hidden')

        reader.onload = function (e) {
            $('#imagePreview')
                .attr('src', e.target.result)
        };

        reader.readAsDataURL(input.files[0]);
    }
}