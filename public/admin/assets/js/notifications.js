async function markAsRead(event) {
    event.preventDefault(); // Prevent the default action

    const target = event.target;
    const notificationId = target.dataset.id;
    const href = target.href; // Store the original href of the anchor

    try {
        const response = await fetch(
            `/admin/notifications/${notificationId}/read`,
            {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({}),
            }
        );

        const data = await response.json();

        if (data.status === "success") {
            target.classList.add("read"); // Add class to mark as read

            // Decrease the notification count
            const notificationCountElement =
                document.getElementById("notification-count");
            let currentCount =
                parseInt(notificationCountElement.textContent) || 0;
            if (currentCount > 0) {
                notificationCountElement.textContent = currentCount - 1;
            }

            // Remove the 'show' class if count is 0
            if (parseInt(notificationCountElement.textContent) === 0) {
                notificationCountElement.classList.remove("show");

                document.title = originalTitle;
            }
            if (parseInt(notificationCountElement.textContent) !== 0) {
                document.title = `${currentCount-1} new notification${
                    currentCount + 1 > 2 ? "s" : ""
                }`;
            }

            // Remove the 'bx-tada' class if no more notifications
            if (parseInt(notificationCountElement.textContent) === 0) {
                const notificationIcon = document.getElementById(
                    "notification-icon-class"
                );
                notificationIcon.classList.remove("bx-tada");
            }

            if (href) {
                window.location.href = href;
            }
        } else {
            console.error("Failed to mark notification as read");
        }
    } catch (error) {
        console.error("Error:", error);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    if (window.Echo) {
        window.Echo.channel("notifications").listen("ReviewAdded", (event) => {
            const notificationItem = document.createElement("li");
            notificationItem.innerHTML = `
                <div class="notification">
                    <div class="content">
                        <a onclick="markAsRead(event)" href="${
                            event.data.link
                        }" class="title" data-id="${
                event.data.notification_id
            }">
                            ${event.data.message}
                        </a>
                        <div class="time" data-timestamp="${new Date().toISOString()}">
                            Just now
                        </div>
                    </div>
                    <button
                        title="Mark as Read"
                        type="button"
                        class="mark-as-read"
                        data-id="${
                            event.data.notification_id
                        }" onclick="markAsRead(event)">
                        <i class='bx bx-check-circle'></i>
                    </button>
                </div>
            `;

            if (hasUserInteracted) {
                notificationSound.play().catch((error) => {
                    console.error("Audio playback failed:", error);
                });
            }

            // Add the new notification to the list
            const notificationsList = document.getElementById("notifications");
            notificationsList.insertBefore(
                notificationItem,
                notificationsList.firstChild
            );

            // Update the notification count
            const notificationCountElement =
                document.getElementById("notification-count");
            let currentCount =
                parseInt(notificationCountElement.textContent) || 0;
            notificationCountElement.textContent = currentCount + 1;
            document.title = `${currentCount + 1} new notification${
                currentCount + 1 > 2 ? "s" : ""
            }`;

            // Show the notification count and apply the class if it's not already visible
            notificationCountElement.classList.add("show");

            // Add the 'bx-tada' class to the notification icon
            const notificationIcon = document.getElementById(
                "notification-icon-class"
            );
            if (!notificationIcon.classList.contains("bx-tada")) {
                notificationIcon.classList.add("bx-tada");
            }
        });
    } else {
        console.error("Echo is not defined");
    }
});
