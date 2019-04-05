window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {
}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

if (Notification) {
    if (Notification.permission !== "granted") {
        Notification.requestPermission().then(x => {
            console.log(x);
        });
    }
}

const desktopNotify = function (title, body) {
    const notification = new Notification(title, {
        body: body,
    });
};

import Echo from "laravel-echo"

window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

window.Echo.private('App.User.' + userId).notification(function (notification) {
    refreshNotifications();
    if (desktopNotify) {
        desktopNotify(notification.title, notification.message.join('\n'));
    }
});


const moment = require('moment');

// refresh the notifications
const refreshNotifications = function () {
    window.axios.get('api/notifications', {
        'headers': {
            Authorization: 'Bearer ' + apiToken,
        }
    }).then((response) => {
        const notifications = response.data;
        $("#notifications-counter").html(notifications.length ? notifications.length : '');
        for (let i in notifications) {

            console.log(notifications[i]);
            const row = $('<li>');

            const link = $('<a>');
            link.prop('href', 'notifications/' + notifications[i].id);
            row.append(link);

            const div = $('<div style="margin-bottom: 8px;">');
            link.append(div);

            const title = $('<strong>');
            title.html(notifications[i].data.title);
            div.append(title);

            const time = $('<span class="pull-right text-muted small">');
            time.html(moment(notifications[i].created_at, "YYYY-MM-DD HH:mm:ss").format("DD/MM/YYYY HH:mm"));
            div.append(time);

            for (let j in notifications[i].data.message) {
                const line = $('<p>');
                line.html(notifications[i].data.message[j]);
                link.append(line);
            }

            $("#notifications-list").append(row);

        }
    }).catch((error) => {
        console.log(error);
    });
};
refreshNotifications();



