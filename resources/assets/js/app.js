/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });


$(document).ready(function() {
    $('#datatable').dataTable({
        ordering: true,
        scrollY: 400,
        'language': {
            "sProcessing": "Sedang proses...",
            "sLengthMenu": "Tampilan _MENU_ entri",
            "sZeroRecords": "Tidak ditemukan data yang sesuai",
            "sInfo": "Tampilan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty": "Tampilan 0 hingga 0 dari 0 entri",
            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix": "",
            "sSearch": "Cari:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Awal",
                "sPrevious": "Kembali",
                "sNext": "Lanjut",
                "sLast": "Akhir"
            }
        }
    });
});


$(document).ready(function() {
    var odds = 1;
    $('button#password-show').click(function() {
        odds++;
        if (odds % 2 == 0) {
            $('input#password').attr('type', 'text');
        } else {
            $('input#password').attr('type', 'password');
        }
    })
})