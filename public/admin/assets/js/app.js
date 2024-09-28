window.addEventListener("load", function () {
    const loader = document.getElementById("loader");
    loader.style.display = "none";
});

// Single File Upload
function showImage(input, previewImgId, filenamePreviewId) {
    var file = input.files[0];
    var allowedTypes = [
        "image/jpeg",
        "image/png",
        "image/gif",
        "image/webp",
        "image/svg+xml",
        "image/bmp",
        "image/tiff",
    ];

    if (file && allowedTypes.includes(file.type)) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#" + previewImgId).attr("src", e.target.result);
            $("#" + filenamePreviewId).text(file.name);
        };
        reader.readAsDataURL(file);
    } else if (file) {
        alert(
            "Please select a valid image file. Supported formats: JPEG, PNG, GIF, WEBP, SVG, BMP, TIFF.",
        );
        input.value = "";
    }
}

// DataTable
let table = new DataTable(".data-table", {
    columnDefs: [
        { orderable: false, targets: 0 }, // Disable sorting for the first column (index 0)
    ],
});

// SideBar Dropdown
document.addEventListener("DOMContentLoaded", function () {
    // Get all dropdowns
    const dropdowns = document.querySelectorAll(".custom-dropdown__active");

    // Add click event listener to each dropdown trigger
    dropdowns.forEach(function (dropdown) {
        dropdown.addEventListener("click", function (e) {
            // Prevent default action for anchor tags
            e.preventDefault();

            // Toggle the 'open' class on the current dropdown
            const parentDropdown = this.parentElement;
            parentDropdown.classList.toggle("open");

            // If it has sub-dropdowns, toggle its children as well
            const subDropdown = parentDropdown.querySelector(
                ".custom-dropdown__values",
            );
            if (subDropdown) {
                subDropdown.classList.toggle("open");
            }
        });
    });
});

// Choices Select
document.addEventListener("DOMContentLoaded", function () {
    const choiceSelects = document.querySelectorAll(".choice-select");
    choiceSelects.forEach((select) => {
        const maxItems = select.hasAttribute("data-max-items")
            ? parseInt(select.getAttribute("data-max-items"))
            : -1;

        new Choices(select, {
            searchEnabled: true,
            itemSelectText: "",
            placeholder: true,
            placeholderValue: select.getAttribute("placeholder"),
            addItems: true,
            delimiter: ", ",
            maxItemCount: maxItems,
            removeItemButton: true,
            duplicateItemsAllowed: false,
        });
    });
});

// SinglE File Upload
document.addEventListener("DOMContentLoaded", function () {
    const uploadComponents = document.querySelectorAll("[data-upload]");

    uploadComponents.forEach((uploadComponent) => {
        const fileInput = uploadComponent.querySelector("[data-file-input]");
        const uploadBox = uploadComponent.querySelector("[data-upload-box]");
        const uploadImgBox = uploadComponent.querySelector("[data-upload-img]");
        const uploadPreview = uploadComponent.querySelector(
            "[data-upload-preview]",
        );
        const deleteBtn = uploadComponent.querySelector("[data-delete-btn]");
        const errorMessage = uploadComponent.querySelector(
            "[data-error-message]",
        );
        // Handle file upload
        fileInput.addEventListener("change", function (event) {
            const file = event.target.files[0];

            if (file && file.type.startsWith("image/")) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // Set the uploaded image preview
                    uploadPreview.src = e.target.result;
                    uploadImgBox.querySelector(".mask").href = e.target.result;
                };

                reader.readAsDataURL(file);

                // Hide upload box and show image box
                uploadBox.classList.remove("show");
                uploadImgBox.classList.add("show");

                errorMessage.classList.add("d-none");
            } else {
                // Show error message if file type doesn't match
                errorMessage.classList.remove("d-none");
                fileInput.value = "";
            }
        });

        // Handle delete button click
        deleteBtn?.addEventListener("click", function () {
            fileInput.value = "";
            uploadBox.classList.add("show");
            uploadImgBox.classList.remove("show");
        });
    });
});

// Multple File Upload
document.addEventListener("DOMContentLoaded", () => {
    const uploadComponents = document.querySelectorAll(
        "[data-upload-multiple]",
    );

    uploadComponents.forEach((uploadComponent) => {
        const fileInput = uploadComponent.querySelector(
            "[data-upload-multiple-input]",
        );
        const imageContainer = uploadComponent.querySelector(
            "[data-upload-multiple-images]",
        );
        const errorMessage = uploadComponent.querySelector(
            "[data-upload-multiple-error]",
        );

        fileInput.addEventListener("change", (event) => {
            const fileList = event.target.files;

            imageContainer.innerHTML = "";
            errorMessage.classList.add("d-none");

            let hasInvalidFiles = false;

            // Check for invalid files
            Array.from(fileList).forEach((file) => {
                if (!file.type.startsWith("image/")) {
                    hasInvalidFiles = true;
                }
            });

            if (hasInvalidFiles) {
                errorMessage.textContent = "Please upload a valid image file";
                errorMessage.classList.remove("d-none");
                return;
            }

            // Process valid image files
            Array.from(fileList).forEach((file) => {
                const reader = new FileReader();

                reader.onload = (e) => {
                    // Create a list item for each image
                    const li = document.createElement("li");
                    li.className = "single-image";

                    li.innerHTML = `
                    <div class="delete-btn">
                        <i class='bx bxs-trash-alt'></i>
                    </div>
                    <a class="mask" href="${e.target.result}" data-fancybox="gallery"><img src="${e.target.result}" class="imgFluid" /></a>
                     <input type="text" name="gallery_alt_texts[]" value="gallery" class="field" placeholder="Enter Alt Text" required>
                `;

                    // Append the list item to the image container
                    imageContainer.appendChild(li);

                    // Add delete functionality
                    li.querySelector(".delete-btn").addEventListener(
                        "click",
                        () => {
                            imageContainer.removeChild(li);
                        },
                    );
                };

                reader.readAsDataURL(file);
            });
        });
    });
});

// Ck Editor
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("validation-form");
    if (form) {
        const editors = initializeEditors(form);

        form.addEventListener("submit", function (event) {
            const isValid = validateForm(form, editors);

            if (!isValid) {
                event.preventDefault();
            }
        });
    }
});

// Function to initialize CKEditor instances
function initializeEditors(form) {
    const editors = [];
    const editorElements = form.querySelectorAll(".editor");

    editorElements?.forEach((editorElement) => {
        ClassicEditor.create(editorElement)
            .then((instance) => {
                editors.push(instance);
            })
            .catch((error) => {
                console.error(error);
            });
    });

    return editors;
}

// Function to validate the form
function validateForm(form, editors) {
    let isValid = true;
    const requiredFields = form.querySelectorAll("[data-required]");

    requiredFields.forEach((field) => {
        if (field.classList.contains("editor")) {
            return; // Skip editor fields
        }
        isValid = validateField(field) && isValid;
    });

    editors.forEach((editorInstance) => {
        isValid = validateEditor(editorInstance) && isValid;
    });

    return isValid;
}

// Function to validate standard fields
function validateField(field) {
    if (
        (!field.value.trim() &&
            !(field.type === "file" && field.classList.contains("d-none"))) ||
        (field.type === "file" && field.files.length === 0)
    ) {
        showErrorToast(`${field.dataset.error || field.name} is Required!`);
        return false;
    }
    return true;
}

// Function to validate CKEditor fields
function validateEditor(editorInstance) {
    const editorData = editorInstance.getData();
    const editorElement = editorInstance.sourceElement;

    if (!editorData.trim()) {
        showErrorToast(
            `${editorElement.dataset.error || editorElement.name} is Required!`,
        );
        return false;
    }
    return true;
}

// Function to show toast messages
function showErrorToast(message) {
    $.toast({
        heading: "Error!",
        position: "bottom-right",
        text: message,
        loaderBg: "#ff6849",
        icon: "error",
        hideAfter: 2000,
        stack: 6,
    });
}

// Bulk Action
document.addEventListener("DOMContentLoaded", function () {
    const selectAllCheckbox = document.getElementById("select-all");
    const itemCheckboxes = document.querySelectorAll(".bulk-item");

    if (itemCheckboxes && selectAllCheckbox) {
        function toggleSelectAll() {
            const isChecked = selectAllCheckbox.checked;
            itemCheckboxes.forEach(function (checkbox) {
                checkbox.checked = isChecked;
            });
        }
        function handleItemCheckboxChange() {
            const allChecked = Array.from(itemCheckboxes).every(
                (checkbox) => checkbox.checked,
            );
            selectAllCheckbox.checked = allChecked;
        }
        selectAllCheckbox.addEventListener("change", toggleSelectAll);
        itemCheckboxes.forEach(function (checkbox) {
            checkbox.addEventListener("change", handleItemCheckboxChange);
        });
    }
});

function confirmBulkAction(event) {
    const selectedAction = document.getElementById("bulkActions").value;

    if (selectedAction === "delete") {
        const confirmation = confirm(
            "Are you sure you want to delete the selected items?",
        );
        if (!confirmation) {
            event.preventDefault();
        }
    }

    if (selectedAction === "permanent_delete") {
        const message =
            "This action will permanently delete the selected items and all related fields. Do you want to proceed?";
        const confirmation = confirm(message);
        if (!confirmation) {
            event.preventDefault();
        }
    }
}
