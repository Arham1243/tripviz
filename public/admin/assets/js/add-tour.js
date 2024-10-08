function populateTimeDropdown() {
    const dropdown = document.getElementById("time-dropdown");
    if (dropdown) {
        dropdown.innerHTML = "";

        const startTime = 15; // Start from 15 minutes
        const endTime = 240; // 4 hours in minutes
        const interval = 15; // Gap of 15 minutes

        for (let minutes = startTime; minutes <= endTime; minutes += interval) {
            const time = moment()
                .startOf("day")
                .add(minutes, "minutes")
                .format("HH:mm");
            const option = document.createElement("option");
            option.value = minutes;
            option.textContent = `${time} (${minutes} mins)`;
            dropdown.appendChild(option);
        }
    }
}

populateTimeDropdown();

const sortableTableBody = document.querySelector("[data-sortable-body]");
if (sortableTableBody) {
    const sortable = new Sortable(sortableTableBody, {
        animation: 300,
        handle: ".order-menu",
        onEnd: function (/**Event*/ evt) {
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
            'input[name="itinerary[stops][title][]"]',
        ),
    ).some((input) => input.value.trim() !== "");

    if (stops.length > 0 && hasValue) {
        addStopBtn.classList.remove("d-none");
    } else {
        addStopBtn.classList.add("d-none");
    }
}

function updateOrderFields() {
    // Update order for all rows (vehicles and stops) in unified order
    const rows = document.querySelectorAll("#itinerary-table-body tr");
    rows.forEach((row, index) => {
        const orderField = row.querySelector(
            "input[name='itinerary[order][]']",
        );
        if (orderField) {
            orderField.value = index + 1; // Update the order number
        }
    });
    toggleAddStopButton();
}

const itineraryTableBody = document.getElementById("itinerary-table-body");
const subStopsSection = document.getElementById(
    "itinerary_experience_sub_stops",
);
const subStopsCheckbox = document.getElementById(
    "itinerary_experience_enabled_sub_stops",
);

if (itineraryTableBody && subStopsSection && subStopsCheckbox) {
    // Toggle Sub Stops visibility on checkbox change
    subStopsCheckbox.addEventListener("change", function () {
        if (this.checked) {
            subStopsSection.classList.remove("d-none");
            populateMainStopDropdown(); // Repopulate when checkbox is checked
        } else {
            subStopsSection.classList.add("d-none");
        }
    });

    function createRow(type) {
        let row = null;
        const order = itineraryTableBody.children.length + 1; // Calculate current order
        if (type === "vehicle") {
            row = `
        <tr data-item-type="vehicle" draggable="true">
            <td><div class="order-menu"><i class='bx-sm bx bx-menu'></i></div>
            <input type="hidden" name="itinerary[order][]["type]" value="vehicle">
            <input type="hidden" name="itinerary[order][][index]" value="${order}"></td>
            <td><div class="d-flex align-items-center gap-1"><i class='bx bxs-car'></i>Vehicle</div></td>
            <td><input name="itinerary[vehicles][name][]" type="text" class="field" placeholder="Name"></td>
            <td><input name="itinerary[vehicles][time][]" type="number" class="field" placeholder="Time (mins)"></td>
            <td><button type="button" class="delete-btn ms-auto delete-btn--static"><i class='bx bxs-trash-alt'></i></button></td>
        </tr>`;
        } else if (type === "stop") {
            row = `
        <tr data-item-type="stop" draggable="true">
            <td><div class="order-menu"><i class='bx-sm bx bx-menu'></i></div>
            <input type="hidden" name="itinerary[order][][type]" value="stop">
            <input type="hidden" name="itinerary[order][][index]" value="${order}"></td>
            <td><div class="d-flex align-items-center gap-1"><i class="bx bx-star"></i>Stop</div></td>
            <td><input name="itinerary[stops][title][]" type="text" class="field" placeholder="Title"></td>
            <td><input name="itinerary[stops][activities][]" type="text" class="field" placeholder="Activities"></td>
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
            updateOrderFields(); // Ensure order is updated after adding rows
            closeSubStopsSection(); // Close sub stops section after adding new rows
        });
    });

    // Update the order whenever a row is removed
    itineraryTableBody.addEventListener("click", function (e) {
        if (e.target.closest(".delete-btn")) {
            const row = e.target.closest("tr");
            row.remove();
            updateOrderFields(); // Update order after row removal
            populateMainStopDropdown(); // Repopulate dropdown when stops are removed
            closeSubStopsSection(); // Close sub stops section after row removal
        }
    });

    // Close sub stops section
    function closeSubStopsSection() {
        subStopsCheckbox.checked = false;
        subStopsSection.classList.add("d-none");
    }
    // Handle input field changes for dynamic updates
    itineraryTableBody.addEventListener("input", function (e) {
        if (e.target.name === "itinerary[stops][title][]") {
            closeSubStopsSection(); // Close sub stops section if stop name changes
            toggleAddStopButton();
        }
    });

    // Populate the main stop dropdown with the latest stop names
    function populateMainStopDropdown() {
        const stopNames = document.querySelectorAll(
            "input[name='itinerary[stops][title][]']",
        );
        const mainStopDropdowns = document.querySelectorAll(
            "select[name='itinerary[stops][sub_stops][main_stop][]']",
        );

        mainStopDropdowns.forEach((dropdown) => {
            dropdown.innerHTML =
                '<option value="" selected disabled>Select</option>';
        });

        stopNames.forEach((stopInput) => {
            const stopTitle = stopInput.value.trim();
            if (stopTitle) {
                mainStopDropdowns.forEach((dropdown) => {
                    const option = document.createElement("option");
                    option.value = stopTitle;
                    option.textContent = stopTitle;
                    dropdown.appendChild(option);
                });
            }
        });
    }

    // Initialize default order on page load
    updateOrderFields();
}