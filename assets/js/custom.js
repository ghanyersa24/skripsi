/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

"use strict";


$.fn.dataTable.ext.errMode = 'none';
$('#table tfoot .table_search').each(function() {
    var title = $(this).text();
    $(this).html('<input type="text" class="form-control-sm" placeholder="Search ' + title + '" />');
});

$(document).ready(function() {
    $("input[data-type='currency']").on({
        keyup: function() {
            this.value = formatRupiah(this.value, 'Rp. ');
        },

    });
    $("input[data-type='without-currency']").on({
        keyup: function() {
            this.value = formatRupiah(this.value);
        },

    });
})

function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}