require('./bootstrap');

window.Vue = require('vue');

Vue.component('echo-listen', require('./components/EchoListen.vue'));

const app = new Vue({
    el: '#app'
});
