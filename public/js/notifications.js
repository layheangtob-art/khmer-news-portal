function fetchNotifications() {
    fetch('/notifications/fetch', {
        credentials: 'same-origin',
        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
    })
        .then(function(response) {
            if (!response.ok) throw new Error('Failed to fetch notifications');
            return response.json();
        })
        .then(function(data) {
            displayNotifications(data.notifications);
        })
        .catch(function(err) {
            console.error(err);
        });
}

function displayNotifications(notifications) {
    var notificationsContainer = document.getElementById('notifications-container');

    if (!notificationsContainer) return;

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
            markNotificationAsRead(notification.id, notificationElement);
            return false;
        };

        var iconElement = document.createElement('div');
        iconElement.className = 'notif-icon notif-success';
        iconElement.innerHTML = '<i class="fa fa-comment"></i>';

        var contentElement = document.createElement('div');
        contentElement.className = 'notif-content';

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

function timeAgo(timestamp) {
    var date = new Date(timestamp);
    var now = new Date();
    var seconds = Math.floor((now - date) / 1000);

    if (seconds < 60) {
        return seconds <= 1 ? 'just now' : seconds + ' seconds ago';
    }

    var minutes = Math.floor(seconds / 60);
    if (minutes < 60) {
        return minutes === 1 ? '1 minute ago' : minutes + ' minutes ago';
    }

    var hours = Math.floor(seconds / 3600);
    if (hours < 24) {
        return hours === 1 ? '1 hour ago' : hours + ' hours ago';
    }

    var days = Math.floor(seconds / 86400);
    if (days < 30) {
        return days === 1 ? '1 day ago' : days + ' days ago';
    }

    var months = Math.floor(seconds / 2592000);
    if (months < 12) {
        return months === 1 ? '1 month ago' : months + ' months ago';
    }

    var years = Math.floor(seconds / 31536000);
    return years === 1 ? '1 year ago' : years + ' years ago';
}

function getCurrentUnreadCount() {
    var el = document.getElementById('unread-notification-count');
    if (!el || el.style.display === 'none') return 0;
    var text = el.textContent.trim();
    if (text === '99+') return 99;
    var n = parseInt(text, 10);
    return isNaN(n) ? 0 : n;
}

function markNotificationAsRead(notificationId, notificationElement) {
    var wasUnread = notificationElement && notificationElement.classList.contains('unread');

    if (wasUnread) {
        notificationElement.classList.remove('unread');
        updateUnreadNotificationsCount(Math.max(0, getCurrentUnreadCount() - 1));
    }

    var csrfToken = getCsrfToken();
    if (!csrfToken) return;

    fetch('/notifications/' + notificationId + '/read', {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest',
        },
    })
        .then(function(response) {
            if (!response.ok) throw new Error('Failed to mark notification as read');
            return response.json();
        })
        .then(function(data) {
            if (data.success) {
                fetchUnreadNotificationsCount();
            } else if (wasUnread) {
                notificationElement.classList.add('unread');
                fetchUnreadNotificationsCount();
            }
        })
        .catch(function(err) {
            console.error(err);
            if (wasUnread) {
                notificationElement.classList.add('unread');
                fetchUnreadNotificationsCount();
            }
        });
}

function getCsrfToken() {
    var meta = document.head.querySelector('meta[name="csrf-token"]');
    return meta ? meta.content : '';
}

function markAllNotificationsAsRead() {
    var csrfToken = getCsrfToken();
    if (!csrfToken) {
        return Promise.reject(new Error('CSRF token not found'));
    }

    return fetch('/notifications/read-all', {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest',
        },
    })
        .then(function(response) {
            if (!response.ok) throw new Error('Failed to mark all notifications as read');
            return response.json();
        })
        .then(function(data) {
            if (data.success) {
                updateUnreadNotificationsCount(0);
                document.querySelectorAll('.notif-center a.unread').forEach(function(el) {
                    el.classList.remove('unread');
                });
            }
            return data;
        })
        .catch(function(err) {
            console.error('Mark all read failed:', err);
            throw err;
        });
}

function fetchUnreadNotificationsCount() {
    fetch('/notifications/count', {
        credentials: 'same-origin',
        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
    })
        .then(function(response) {
            if (!response.ok) throw new Error('Failed to fetch unread count');
            return response.json();
        })
        .then(function(data) {
            updateUnreadNotificationsCount(data.unreadCount);
        })
        .catch(function(err) {
            console.error(err);
        });
}

function updateUnreadNotificationsCount(count) {
    var unreadCountElement = document.getElementById('unread-notification-count');
    if (!unreadCountElement) return;

    if (count > 0) {
        unreadCountElement.textContent = count > 99 ? '99+' : count.toString();
        unreadCountElement.style.display = 'block';
    } else {
        unreadCountElement.textContent = '0';
        unreadCountElement.style.display = 'none';
    }
}

function initNotifications() {
    fetchUnreadNotificationsCount();
    fetchNotifications();

    var markAllBtn = document.getElementById('mark-all-notifications-read');
    if (markAllBtn && !markAllBtn.dataset.bound) {
        markAllBtn.dataset.bound = '1';
        markAllBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (markAllBtn.disabled) return;

            markAllBtn.disabled = true;
            markAllNotificationsAsRead()
                .then(function() {
                    fetchNotifications();
                    fetchUnreadNotificationsCount();
                })
                .finally(function() {
                    markAllBtn.disabled = false;
                });
        });
    }
}

document.addEventListener('DOMContentLoaded', initNotifications);
document.addEventListener('turbo:load', initNotifications);
