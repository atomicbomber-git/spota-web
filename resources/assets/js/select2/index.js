import * as $ from 'jquery';
import 'select2';
import 'select2/dist/css/select2.css';

export default (function() {
    $('select#create').select2({
        dropdownParent: $('#modal-create'),
        width: '100%'
    });

    $('select#edit').select2({
        dropdownParent: $('#modal-update'),
        width: '100%'
    });
    $('select#default').select2({
        width: '100%'
    });

}())