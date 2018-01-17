require('./bootstrap');

window.Vue = require('vue');

Vue.prototype.$http = axios.create();
Vue.component('echo-listen', require('./components/EchoListen.vue'));

const app = new Vue({
    el: '#app'
});

(function($) {
    $(function() {
        let mdDescription = new SimpleMDE({
            element: $('#markdown-description')[0]
        });

        let mdTerms = new SimpleMDE({
            element: $('#markdown-terms')[0]
        });
    });
})(jQuery);
