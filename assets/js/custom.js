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

let editorList = [];

function editor(id) {
    return ClassicEditor.create(document.getElementById(id), {
        removePlugins: ['Heading', 'Link'],
        toolbar: ['bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote']
    }).then(editor => {
        let key = '#' + id
        editorList.push({
            id,
            editor
        })
    }).catch(error => {
        console.error(error)
    })
}

function setEditor(id, data) {
    const index = getEditorIndex(id);
    editorList[index].editor.setData(data)
}

function getEditorIndex(key) {
    const dataIndex = editorList.findIndex((data) => data.id === key);
    return dataIndex;
}

function triggerEditor(id) {
    let editorId = $(id + ' textarea');
    for (let index = 0; index < editorId.length; index++) {
        editor(editorId[index].id)
    }
}

function triggerSetEditor(id, data) {
    let editorId = $(id + ' textarea');
    for (let index = 0; index < editorId.length; index++) {
        setEditor(editorId[index].id, data)
    }
}

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