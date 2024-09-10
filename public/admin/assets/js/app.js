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
// $('.data-table').dataTable( {
//     "columnDefs": [ {
//       "targets": 'no-sort',
//       "orderable": false,
// }]
// } );

document.addEventListener('DOMContentLoaded', function() {
    // Get all dropdowns
    const dropdowns = document.querySelectorAll('.custom-dropdown__active');

    // Add click event listener to each dropdown trigger
    dropdowns.forEach(function(dropdown) {
        dropdown.addEventListener('click', function(e) {
            // Prevent default action for anchor tags
            e.preventDefault();

            // Toggle the 'open' class on the current dropdown
            const parentDropdown = this.parentElement;
            parentDropdown.classList.toggle('open');
            
            // If it has sub-dropdowns, toggle its children as well
            const subDropdown = parentDropdown.querySelector('.custom-dropdown__values');
            if (subDropdown) {
                subDropdown.classList.toggle('open');
            }
        });
    });
});
