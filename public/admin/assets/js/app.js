function showImage(input, previewImgId, filenamePreviewId) {
    var file = input.files[0];
    var allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml', 'image/bmp', 'image/tiff'];

    if (file && allowedTypes.includes(file.type)) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#' + previewImgId).attr('src', e.target.result);
            $('#' + filenamePreviewId).text(file.name);
        };
        reader.readAsDataURL(file);
    } else if (file) {
        alert('Please select a valid image file. Supported formats: JPEG, PNG, GIF, WEBP, SVG, BMP, TIFF.');
        input.value = '';
    }
}
let table = new DataTable('.data-table');

$(".custom-dropdown__active").click(function () {
    $(this).parent().toggleClass("open");
});