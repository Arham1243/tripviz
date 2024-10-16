$(function () {
    if ($(".date-picker").length) {
        $(".date-picker")
            .daterangepicker({
                singleDatePicker: true,
                showCalendar: false,
                autoUpdateInput: false,
                sameDate: true,
                autoApply: true,
                disabledPast: true,
                enableLoading: true,
                showEventTooltip: true,
                classNotAvailable: ["disabled", "off"],
                disableHightLight: true,
                locale: { format: "YYYY-MM-DD" },
            })
            .on("apply.daterangepicker", function (event, picker) {
                $(this).val(picker.startDate.format("YYYY-MM-DD"));
            });
    }
});

// Function to update the label text based on the switch state
function updateLabel(container) {
    const checkbox = container.querySelector("input[data-toggle-switch]");
    const label = container.querySelector("label");

    const enabledText =
        container.getAttribute("data-enabled-text") || "Enabled"; // Fallback to default
    const disabledText =
        container.getAttribute("data-disabled-text") || "Disabled"; // Fallback to default

    if (checkbox.checked) {
        label.textContent = enabledText;
    } else {
        label.textContent = disabledText;
    }
}

const switches = document.querySelectorAll("input[data-toggle-switch]");
switches?.forEach((switchElement) => {
    const container = switchElement.closest(
        "[data-enabled-text], [data-disabled-text]",
    );

    if (container) {
        updateLabel(container);

        switchElement.addEventListener("change", () => updateLabel(container));
    }
});

document
    .querySelector(".permalink-input")
    ?.addEventListener("click", function () {
        if (this.type === "button") {
            this.type = "text";
            this.focus();
        }
    });

document
    .querySelector(".permalink-input")
    ?.addEventListener("blur", function () {
        const hiddenField = document.getElementById(this.dataset.fieldId);
        if (this.type === "text") {
            // Update the hidden input field with the value from the permalink input
            hiddenField.value = this.value;
            this.type = "button";
        }
    });

function showIcon(iconField) {
    iconField.parentElement
        .querySelector("[data-preview-icon]")
        .setAttribute("class", `${iconField.value} bx-md`);
}

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
                     <input type="text" name="gallery_alt_texts[]" value="gallery" class="field" placeholder="Enter alt text" required>
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

// Editor
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("validation-form");
    if (form) {
        const editors = initializeEditors(form);

        form.addEventListener("submit", function (event) {
            const requiredEditors = editors.filter((editor) => {
                return editor.sourceElement.dataset.required !== undefined;
            });
            const isValid = validateForm(form, requiredEditors);

            if (!isValid) {
                event.preventDefault();
            }
        });
    }
});

// Tiny Editor
// function initializeEditors(form) {
//     const editors = [];
//     const editorElements = form.querySelectorAll(".editor");

//     editorElements.forEach((editorElement) => {
//         tinymce.init({
//             target: editorElement,
//             plugins:
//                 "advlist autolink link image lists charmap print preview anchor \
//                       searchreplace visualblocks code fullscreen insertdatetime media table \
//                       paste code wordcount emoticons hr pagebreak save directionality \
//                       template toc textpattern imagetools visualchars nonbreaking codesample",
//             toolbar:
//                 "undo redo | formatselect | bold italic underline strikethrough forecolor backcolor | \
//                       alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | \
//                       link image media | preview fullscreen | emoticons codesample blockquote hr pagebreak | \
//                       removeformat",
//             height: 300, // Adjust the height for the editor
//             menubar: true, // Show the menubar
//             branding: false, // Remove TinyMCE branding
//             image_advtab: true, // Advanced image options
//             media_live_embeds: true, // Auto-embed media
//             paste_data_images: true, // Allow pasting images
//             automatic_uploads: true, // Auto-upload images while editing
//             file_picker_types: "image media", // Enable file picker for image/media
//             content_style:
//                 "body { font-family:Helvetica,Arial,sans-serif; font-size:14px }",
//             setup: function (editor) {
//                 editor.on("init", function () {
//                     editors.push(editor);
//                 });
//             },
//         });
//     });

//     return editors;
// }

// Ck Editor
function initializeEditors(form) {
    const editors = [];
    const editorElements = form.querySelectorAll(".editor");

    editorElements.forEach((editorElement) => {
        ClassicEditor.create(editorElement, {
            toolbar: [
                "undo",
                "redo",
                "|",
                "heading",
                "|",
                "bold",
                "italic",
                "underline",
                "strikethrough",
                "fontColor",
                "highlight",
                "|",
                "alignment",
                "|",
                "bulletedList",
                "numberedList",
                "outdent",
                "indent",
                "|",
                "link",
                "imageUpload",
                "blockQuote",
                "insertTable",
                "|",
                "mediaEmbed",
                "horizontalLine",
                "pageBreak",
                "|",
                "removeFormat",
                "codeBlock",
                "|",
                "specialCharacters",
                "|",
                "fullScreen",
                "|",
                "preview",
            ],
            // You can set additional configurations here
            height: "300px",
            // Add custom styles here if needed
            // Note: CKEditor 5 does not support `content_style` like TinyMCE
        })
            .then((editor) => {
                editors.push(editor);
            })
            .catch((error) => {
                console.error(
                    "There was a problem initializing the editor:",
                    error,
                );
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

// Function to validate TinyMCE editor fields
function validateEditor(editorInstance) {
    const editorData = tinymce
        .get(editorInstance.id)
        .getContent({ format: "text" });
    const editorElement = editorInstance.targetElm;

    if (!editorData.trim()) {
        showErrorToast(
            `${editorElement.dataset.error || editorElement.name} is Required!`,
        );
        return false;
    }
    return true;
}

// Ck editor
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

function previewImage(selectElement, imgElementId) {
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var imgUrl = selectedOption.getAttribute("data-image");

    // Update image src and href
    var imgElement = document.getElementById(imgElementId);
    imgElement.src = imgUrl;
    imgElement.parentElement.href = imgUrl;
}

// Bulk Action
document.addEventListener("DOMContentLoaded", function () {
    const selectAllCheckbox = document.getElementById("select-all");

    function initializeBulkActionCheckboxes() {
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

            // Attach event listeners to checkboxes
            selectAllCheckbox.addEventListener("change", toggleSelectAll);
            itemCheckboxes.forEach(function (checkbox) {
                checkbox.addEventListener("change", handleItemCheckboxChange);
            });
        }
    }

    // Initialize the checkboxes for the first time
    initializeBulkActionCheckboxes();

    // If you're using DataTables, listen for the draw event and reinitialize the checkboxes
    $(".data-table").on("draw.dt", function () {
        initializeBulkActionCheckboxes();
    });
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

function initializeUploadComponent(uploadComponent) {
    const fileInput = uploadComponent.querySelector("[data-file-input]");
    const uploadBox = uploadComponent.querySelector("[data-upload-box]");
    const uploadImgBox = uploadComponent.querySelector("[data-upload-img]");
    const uploadPreview = uploadComponent.querySelector(
        "[data-upload-preview]",
    );
    const deleteBtn = uploadComponent.querySelector("[data-delete-btn]");
    const errorMessage = uploadComponent.querySelector("[data-error-message]");

    fileInput.addEventListener("change", function (event) {
        const file = event.target.files[0];

        if (file && file.type.startsWith("image/")) {
            const reader = new FileReader();

            reader.onload = function (e) {
                uploadPreview.src = e.target.result;
                uploadImgBox.querySelector(".mask").href = e.target.result;
            };

            reader.readAsDataURL(file);

            uploadBox.classList.remove("show");
            uploadImgBox.classList.add("show");
            errorMessage.classList.add("d-none");
        } else {
            errorMessage.classList.remove("d-none");
            fileInput.value = "";
        }
    });

    deleteBtn?.addEventListener("click", function () {
        fileInput.value = "";
        uploadBox.classList.add("show");
        uploadImgBox.classList.remove("show");
    });
}
document.addEventListener("DOMContentLoaded", function () {
    let itemCount = 0;

    function updateDeleteButtonState(container) {
        const items = container.querySelectorAll("[data-repeater-item]");
        items.forEach((item, index) => {
            const deleteBtn = item.querySelector("[data-repeater-remove]");
            deleteBtn.disabled = index === 0;
        });
    }

    function updateUploadBox(newItem) {
        const uploads = newItem.querySelectorAll("[data-upload]");
        uploads.forEach((upload) => {
            itemCount++;
            const uniqueId = `upload-${itemCount}`;
            const uploadImgBox = upload.querySelector("[data-upload-img]");
            const uploadBox = upload.querySelector("[data-upload-box]");
            const uploadMask = upload.querySelector(".mask");
            const imagePreview = upload.querySelector("[data-upload-preview]");
            const fileInput = upload.querySelector("[data-file-input]");
            const prevId = fileInput.id;
            const label = newItem.querySelector(`label[for="${prevId}"]`);

            fileInput.id = uniqueId;
            fileInput.value = "";
            uploadMask.href = "javascript:void(0)";
            imagePreview.src = imagePreview.dataset.placeholder;
            uploadBox.classList.add("show");
            uploadImgBox.classList.remove("show");
            if (label) {
                label.setAttribute("for", uniqueId);
            }
            initializeUploadComponent(upload);
        });
    }

    function updateCheckboxes(newItem) {
        const checkboxes = newItem.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach((checkbox) => {
            itemCount++;
            const uniqueId = `checkbox-${itemCount}`;
            const prevId = checkbox.id;
            const label = newItem.querySelector(`label[for="${prevId}"]`);

            checkbox.id = uniqueId;
            if (label) {
                label.setAttribute("for", uniqueId);
            }
        });
    }

    function addSubItem(container) {
        const list = container.querySelector("[data-sub-repeater-list]");
        const firstItem = list.querySelector("[data-sub-repeater-item]");
        const newItem = firstItem.cloneNode(true);

        const inputs = newItem.querySelectorAll("input, textarea");
        inputs.forEach((input) => {
            input.value = "";
        });

        updateUploadBox(newItem);
        updateCheckboxes(newItem);
        list.appendChild(newItem);
        updateSubDeleteButtonState(container);
        updateIndices(container);
    }

    function updateIndices(container) {
        const items = container.querySelectorAll("[data-repeater-item]");
        items.forEach((item, index) => {
            const pricingFields = ["name", "price", "type", "is_per_person"];

            pricingFields.forEach((field) => {
                const input = item.querySelector(
                    `input[name*='[${field}]'], select[name*='[${field}]']`,
                );
                if (input) {
                    input.name = input.name.replace(/\[\d+\]/, `[${index}]`);
                }
            });

            const itemInputs = item.querySelectorAll(
                "input[name*='[items][]']",
            );
            itemInputs.forEach((input) => {
                input.name = input.name.replace(/\[\d+\]/, `[${index}]`);
            });
        });
    }

    function updateSubDeleteButtonState(container) {
        const items = container.querySelectorAll("[data-sub-repeater-item]");
        items.forEach((item, index) => {
            const deleteBtn = item.querySelector("[data-sub-repeater-remove]");
            deleteBtn.disabled = index === 0;
        });
    }

    function addItem(container) {
        const list = container.querySelector("[data-repeater-list]");
        const firstItem = list.querySelector("[data-repeater-item]");
        const newItem = firstItem.cloneNode(true);

        const inputs = newItem.querySelectorAll("input, textarea");
        inputs.forEach((input) => {
            if (input.type !== "checkbox") {
                input.value = "";
            }
            else if (input.type == "checkbox") {
                input.checked = false;
            }
        });
        const selects = newItem.querySelectorAll("select");
        selects.forEach((select) => {
            select.selectedIndex = 0;
        });

        updateUploadBox(newItem);
        updateCheckboxes(newItem);
        list.appendChild(newItem);
        updateDeleteButtonState(container);
        updateIndices(container);
        initializeSubRepeater(newItem);
    }

    function removeItem(button) {
        const container = button.closest("[data-repeater]");
        const item = button.closest("[data-repeater-item]");
        item.remove();
        updateDeleteButtonState(container);
        updateIndices(container);
    }

    function initializeSubRepeater(parentItem) {
        const subContainer = parentItem.querySelector("[data-sub-repeater]");
        if (subContainer) {
            const addBtn = subContainer.querySelector(
                "[data-sub-repeater-create]",
            );
            addBtn.addEventListener("click", function () {
                addSubItem(subContainer);
            });

            subContainer.addEventListener("click", function (e) {
                if (e.target.closest("[data-sub-repeater-remove]")) {
                    removeSubItem(
                        e.target.closest("[data-sub-repeater-remove]"),
                    );
                }
            });

            updateSubDeleteButtonState(subContainer);
        }
    }

    function removeSubItem(button) {
        const container = button.closest("[data-sub-repeater]");
        const item = button.closest("[data-sub-repeater-item]");
        item.remove();
        updateSubDeleteButtonState(container);
    }
    let repeaters = document.querySelectorAll("[data-repeater]");
    if (repeaters.length > 0) {
        repeaters.forEach((container) => {
            const addBtn = container.querySelector("[data-repeater-create]");
            addBtn.addEventListener("click", function () {
                addItem(container);
            });

            container.addEventListener("click", function (e) {
                if (e.target.closest("[data-repeater-remove]")) {
                    removeItem(e.target.closest("[data-repeater-remove]"));
                }
            });

            updateDeleteButtonState(container);
            const initialUploadComponents =
                container.querySelectorAll("[data-upload]");
            initialUploadComponents.forEach((uploadComponent) => {
                initializeUploadComponent(uploadComponent);
            });

            container
                .querySelectorAll("[data-repeater-item]")
                .forEach((item) => {
                    initializeSubRepeater(item);
                });
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const uploadComponents = document.querySelectorAll("[data-upload]");
    uploadComponents.forEach((uploadComponent) => {
        initializeUploadComponent(uploadComponent);
    });
});

$(document).ready(function () {
    $('[data-flag-input-wrapper]').each(function () {
        var $wrapper = $(this);
        var input = $wrapper.find('[data-flag-input]');

        if (input.length > 0) {
            input.intlTelInput({
                initialCountry: "ae",
                separateDialCode: true,
            });

            function updateCountryCode() {
                var countryData = input.intlTelInput("getSelectedCountryData");
                if (countryData && countryData.dialCode) {
                    $wrapper.find('[data-flag-input-country-code]').val(countryData.iso2);
                    $wrapper.find('[data-flag-input-dial-code]').val(countryData.dialCode);
                }
            }

            input.on("countrychange", function (e) {
                updateCountryCode();
            });


            var countryCode = $wrapper.find('[data-flag-input-country-code]').val();
            if (countryCode) {
                input.intlTelInput("setCountry", countryCode);
            }
        }
    });
});
