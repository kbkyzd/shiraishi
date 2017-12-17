try {
    window._ = require('lodash');
    window.$ = window.jQuery = require('jquery');
    window.axios = require('axios');
    window.Echo = require('laravel-echo');

    require('materialize-css');
} catch (e) {
}

/* Init Axios */
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

/* Init Echo */
if (typeof io !== 'undefined') {
    console.log('Echo initialized');
    if (window.location.href.indexOf('localhost') > -1) {
        window.Echo = new Echo({
            broadcaster: 'socket.io',
            host: `${window.location.hostname}:6001`,
            namespace: 'shiraishi.Events'
        });
    } else {
        window.Echo = new Echo({
            broadcaster: 'socket.io',
            host: {path: '/socket.io'},
            namespace: 'shiraishi.Events'
        });
    }
}
