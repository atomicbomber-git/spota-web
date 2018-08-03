import * as $ from 'jquery';
import swal from 'sweetalert2';

export default (function() {
    $(document).on('click', "button#btn-delete", function(e) {
        var _btn_id = $(this).data('id');
        var _this = $("form#delete-" + _btn_id);
        e.preventDefault();
        swal({
            title: 'Anda Yakin?', // Opération Dangereuse
            text: 'Apakah anda yakin untuk melanjutkan ?', // Êtes-vous sûr de continuer ?
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'null',
            cancelButtonColor: 'null',
            confirmButtonClass: 'btn btn-danger',
            cancelButtonClass: 'btn btn-primary',
            confirmButtonText: 'Ya !', // Oui, sûr
            cancelButtonText: 'Tidak', // Annuler
        }).then(res => {
            if (res.value) {
                _this.submit();
            }
        });
    });

    $(document).on('click', "button#btn-activate", function(e) {
        var _btn_id = $(this).data('id');
        var _this = $("form#activate-" + _btn_id);
        e.preventDefault();
        swal({
            title: 'Anda Yakin?', // Opération Dangereuse
            text: 'Apakah anda yakin untuk melanjutkan ?', // Êtes-vous sûr de continuer ?
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'null',
            cancelButtonColor: 'null',
            confirmButtonClass: 'btn btn-danger',
            cancelButtonClass: 'btn btn-primary',
            confirmButtonText: 'Ya !', // Oui, sûr
            cancelButtonText: 'Tidak', // Annuler
        }).then(res => {
            if (res.value) {
                _this.submit();
            }
        });
    });

}())