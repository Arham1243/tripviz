const sortableTableBody = document.querySelector("[data-sortable-body]");
if (sortableTableBody) {
    const sortable = new Sortable(sortableTableBody, {
        animation: 300,
        handle: ".order-menu",
        onEnd: function (evt) {
            console.log(
                "Dragged item index: ",
                evt.oldIndex,
                " -> ",
                evt.newIndex,
            );
            updateOrderFields();
        },
    });
}

function toggleAddStopButton() {
    const stops = itineraryTableBody.querySelectorAll(
        'tr[data-item-type="stop"]',
    );
    const addStopBtn = document.getElementById("add-stop-btn");
    const hasValue = Array.from(
        itineraryTableBody.querySelectorAll(
            'input[name^="itinerary_experience[stops]"][name$="[title]"]',
        ),
    ).some((input) => input.value.trim() !== "");
    if (stops.length > 0 && hasValue) {
        addStopBtn.classList.remove("d-none");
    } else {
        addStopBtn.classList.add("d-none");
    }
}

function updateOrderFields() {
    const rows = document.querySelectorAll("#itinerary-table-body tr");
    rows.forEach((row, index) => {
        const orderField = row.querySelector("input[name$='[order]']");
        if (orderField) {
            orderField.value = index + 1; // Update the order number
        }
    });
    toggleAddStopButton();
}

const itineraryTableBody = document.getElementById("itinerary-table-body");
const subStopsSection = document.getElementById("itinerary_experience_sub_stops");
const subStopsCheckbox = document.getElementById("itinerary_experience_enabled_sub_stops");

if (itineraryTableBody && subStopsSection && subStopsCheckbox) {
    subStopsCheckbox.addEventListener("change", function () {
        if (this.checked) {
            subStopsSection.classList.remove("d-none");
            populateMainStopDropdown();
        } else {
            subStopsSection.classList.add("d-none");
        }
    });

    function createRow(type) {
        let row = null;
        const order = itineraryTableBody.children.length; // Calculate current order
        if (type === "vehicle") {
            row = `
            <tr data-item-type="vehicle" draggable="true">
                <td><div class="order-menu"><i class='bx-sm bx bx-menu'></i></div>
                <input type="hidden" name="itinerary_experience[vehicles][${order}][order]" value="${order}">
                <input type="hidden" name="itinerary_experience[vehicles][${order}][type]" value="vehicle"></td>
                <td><div class="d-flex align-items-center gap-1"><i class='bx bxs-car'></i>Vehicle</div></td>
                <td><input name="itinerary_experience[vehicles][${order}][name]" type="text" class="field" placeholder="Name"></td>
                <td><input name="itinerary_experience[vehicles][${order}][time]" type="number" class="field" placeholder="Time (mins)"></td>
                <td><button type="button" class="delete-btn ms-auto delete-btn--static"><i class='bx bxs-trash-alt'></i></button></td>
            </tr>`;
        } else if (type === "stop") {
            row = `
            <tr data-item-type="stop" draggable="true">
                <td><div class="order-menu"><i class='bx-sm bx bx-menu'></i></div>
                <input type="hidden" name="itinerary_experience[stops][${order}][order]" value="${order}">
                <input type="hidden" name="itinerary_experience[stops][${order}][type]" value="stop"></td>
                <td><div class="d-flex align-items-center gap-1"><i class="bx bx-star"></i>Stop</div></td>
                <td><input name="itinerary_experience[stops][${order}][title]" type="text" class="field" placeholder="Title"></td>
                <td><input name="itinerary_experience[stops][${order}][activities]" type="text" class="field" placeholder="Activities"></td>
                <td><button type="button" class="delete-btn ms-auto delete-btn--static"><i class='bx bxs-trash-alt'></i></button></td>
            </tr>`;
        }
        return row;
    }

    document.querySelectorAll("[data-itinerary-action]").forEach((item) => {
        item.addEventListener("click", function () {
            const action = this.getAttribute("data-itinerary-action");
            if (action === "add-vehicle") {
                itineraryTableBody.insertAdjacentHTML(
                    "beforeend",
                    createRow("vehicle"),
                );
            } else if (action === "add-stop") {
                itineraryTableBody.insertAdjacentHTML(
                    "beforeend",
                    createRow("stop"),
                );
            }
            updateOrderFields();
            closeSubStopsSection();
        });
    });

    itineraryTableBody.addEventListener("click", function (e) {
        if (e.target.closest(".delete-btn")) {
            const row = e.target.closest("tr");
            row.remove();
            updateOrderFields();
            populateMainStopDropdown();
            closeSubStopsSection();
        }
    });

    function closeSubStopsSection() {
        subStopsCheckbox.checked = false;
        subStopsSection.classList.add("d-none");
    }

    itineraryTableBody.addEventListener("input", function (e) {
        if (e.target.name.includes("itinerary_experience[stops][") && e.target.name.endsWith("[title]")) {
            closeSubStopsSection();
            toggleAddStopButton();
        }
    });

    function populateMainStopDropdown() {
        const stopNames = document.querySelectorAll("input[name^='itinerary_experience[stops]'][name$='[title]']");
        const mainStopDropdowns = document.querySelectorAll(".main-stop-dropdown");
    
        // Store currently selected values for each dropdown
        const selectedValues = Array.from(mainStopDropdowns).map(dropdown => dropdown.value);
    
        // Add options from stop title inputs
        stopNames.forEach(stopInput => {
            const stopTitle = stopInput.value.trim();
            if (stopTitle) {
                mainStopDropdowns.forEach(dropdown => {
                    // Check if the option already exists
                    if (![...dropdown.options].some(option => option.value === stopTitle)) {
                        const option = document.createElement("option");
                        option.value = stopTitle;
                        option.textContent = stopTitle;
                        dropdown.appendChild(option);
                    }
                });
            }
        });
    
        // Restore previously selected values in the dropdowns
        mainStopDropdowns.forEach(dropdown => {
            const currentValue = selectedValues.find(value => value === dropdown.value);
            if (currentValue) {
                dropdown.value = currentValue;
            }
        });
    }    
    

    updateOrderFields();
}
