require('./bootstrap');

window.Vue = require('vue');

Vue.prototype.$http = axios.create();
Vue.component('echo-listen', require('./components/EchoListen.vue'));
Vue.component('qr-scanner', require('./components/QrScanner.vue'));

const app = new Vue({
    el: '#app'
});

(function($) {
    $(function() {
        $(".button-collapse").sideNav();
        $('.chips').material_chip();
        // let mdTerms = new SimpleMDE({
        //     element: $('#markdown-terms')[0]
        // });
        $('select:not(.phpdebugbar-datasets-switcher)').material_select();

        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 10, // Creates a dropdown of 15 years to control year,
            today: 'Today',
            clear: 'Clear',
            close: 'Ok',
            closeOnSelect: false, // Close upon selecting a date,
            format: 'd mmmm, yyyy',
            formatSubmit: 'yyyy-mm-dd',
            hiddenName: true
        });

        $('.timepicker').pickatime({
            default: 'now', // Set default time: 'now', '1:30AM', '16:30'
            fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
            twelvehour: false, // Use AM/PM or 24-hour format
            donetext: 'OK', // text for done-button
            cleartext: 'Clear', // text for clear-button
            canceltext: 'Cancel', // Text for cancel-button
            autoclose: false, // automatic close timepicker
            ampmclickable: true // make AM PM clickable
        });
    });
})(jQuery);
