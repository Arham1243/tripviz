setTimeout(() => {
    if (window.Echo) {
        window.Echo.channel("notifications").listen("ReviewAdded", (event) => {
            // Access nested data properties
            let message = event.data.message || "No message";
            let link = event.data.link || "#";

            // Construct the notification item HTML
            let notificationItem = `<li>
            <a href="/notification/${
                event.data.id
            }/mark-as-read" class="notification">
                <div class="content">
                    <div class="title">
                        ${message}
                    </div>
                    <div class="time">
                        ${moment(event.data.created_at).fromNow()}
                    </div>
                </div>
            </a>
        </li>`;

            // Append the new notification to the list
            const notificationsList = document.getElementById("notifications");
            if (notificationsList) {
                notificationsList.insertAdjacentHTML(
                    "afterbegin",
                    notificationItem
                );
            } else {
                console.error("Notifications list element not found");
            }

            // Update the notification count
            const notificationCount =
                document.getElementById("notification-count");
            const notificationIconClass = document.getElementById(
                "notification-icon-class"
            );

            let currentCount = parseInt(notificationCount.textContent, 10);
            let newCount = currentCount + 1;

            notificationCount.textContent = newCount;

            // Show or hide the count and add the animation class if there are new notifications
            if (newCount > 0) {
                notificationCount.classList.add("show"); // Show count
                notificationIconClass.classList.add("bx-tada"); // Add animation class
            } else {
                notificationCount.classList.remove("show"); // Hide count
                notificationIconClass.classList.remove("bx-tada"); // Remove animation class
            }
        });
    } else {
        console.error("Echo is not defined");
    }
}, 200);
