import * as $ from 'jquery';
import 'bootstrap-input-spinner';

export default (function() {
    $("input[type='number']").inputSpinner();
}())