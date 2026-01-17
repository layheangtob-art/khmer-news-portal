function fetchNotifications() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/notifications/fetch', true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                displayNotifications(response.notifications);
            } else {
                console.error('Failed to fetch notifications. Status:', xhr.status);
            }
        }
    };

    xhr.onerror = function() {
        console.error('Request failed');
    };

    xhr.send();
}

function displayNotifications(notifications) {
    var notificationsContainer = document.getElementById('notifications-container');

    if (notificationsContainer) {
        notificationsContainer.innerHTML = '';

        if (!notifications || notifications.length === 0) {
            var emptyState = document.createElement('div');
            emptyState.className = 'notif-empty';
            emptyState.innerHTML = '<i class="fa fa-bell-slash"></i><p>No notifications</p>';
            notificationsContainer.appendChild(emptyState);
            return;
        }

        notifications.forEach(function(notification, index) {
            var notificationElement = document.createElement('a');
            notificationElement.href = '#';
            notificationElement.className = notification.read_at ? '' : 'unread';
            notificationElement.style.animationDelay = (index * 0.05) + 's';
            notificationElement.onclick = function(e) {
                e.preventDefault();
                markNotificationAsRead(notification.id);
                return false;
            };

            var iconElement = document.createElement('div');
            iconElement.className = 'notif-icon notif-success';
            iconElement.innerHTML = '<i class="fa fa-comment"></i>';

            var contentElement = document.createElement('div');
            contentElement.className = 'notif-content';

            function timeAgo(timestamp) {
                const date = new Date(timestamp);
                const now = new Date();
                const seconds = Math.floor((now - date) / 1000);

                if (seconds < 60) {
                    return seconds <= 1 ? 'just now' : seconds + ' seconds ago';
                }

                const minutes = Math.floor(seconds / 60);
                if (minutes < 60) {
                    return minutes === 1 ? '1 minute ago' : minutes + ' minutes ago';
                }

                const hours = Math.floor(seconds / 3600);
                if (hours < 24) {
                    return hours === 1 ? '1 hour ago' : hours + ' hours ago';
                }

                const days = Math.floor(seconds / 86400);
                if (days < 30) {
                    return days === 1 ? '1 day ago' : days + ' days ago';
                }

                const months = Math.floor(seconds / 2592000);
                if (months < 12) {
                    return months === 1 ? '1 month ago' : months + ' months ago';
                }

                const years = Math.floor(seconds / 31536000);
                return years === 1 ? '1 year ago' : years + ' years ago';
            }

            var timeAgoString = timeAgo(notification.created_at);

            var notificationText = document.createElement('span');
            notificationText.className = 'block text-wrap';
            notificationText.textContent = notification.data || '';

            var timeElement = document.createElement('span');
            timeElement.className = 'time text-wrap';
            timeElement.textContent = timeAgoString;

            contentElement.appendChild(notificationText);
            contentElement.appendChild(timeElement);

            notificationElement.appendChild(iconElement);
            notificationElement.appendChild(contentElement);

            notificationsContainer.appendChild(notificationElement);
        });
    }
}

function markNotificationAsRead(notificationId) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/notifications/' + notificationId + '/read', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    console.log('Notification marked as read successfully');
                    fetchUnreadNotificationsCount();
                    fetchNotifications();
                } else {
                    console.error('Failed to mark notification as read:', response.message);
                }
            } else {
                console.error('Failed to mark notification as read. Status:', xhr.status);
            }
        }
    };

    xhr.onerror = function() {
        console.error('Request failed');
    };

    xhr.send();
}

function fetchUnreadNotificationsCount() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/notifications/count', true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                updateUnreadNotificationsCount(response.unreadCount);
            } else {
                console.error('Failed to fetch unread notifications count. Status:', xhr.status);
            }
        }
    };

    xhr.onerror = function() {
        console.error('Request failed');
    };

    xhr.send();
}

function updateUnreadNotificationsCount(count) {
    var unreadCountElement = document.getElementById('unread-notification-count');
    if (unreadCountElement) {
        if (count > 0) {
            unreadCountElement.textContent = count > 99 ? '99+' : count.toString();
            unreadCountElement.style.display = 'block';
        } else {
            unreadCountElement.style.display = 'none';
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    fetchUnreadNotificationsCount();
    fetchNotifications();
});
