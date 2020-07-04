function status(params) {
    if (params == 'tervalidasi')
        return `<div class="badge badge-info w-100">Tervalidasi</div>`;
    else if (params == 'terdata')
        return `<div class="badge badge-default w-100">Terdata</div>`;
    else if (params == 'diajukan')
        return `<div class="badge badge-secondary w-100">Diajukan</div>`;
    else if (params == 'revisi')
        return `<div class="badge badge-warning w-100">Revisi</div>`;
    else
        return `<div class="badge badge-light w-100">Tidak sesuai kondisi</div>`;
}

const statusDocument = (status) => {
    $('#btn-save').prop('disabled', true)
    $('#terdata, #diajukan, #tervalidasi, #revisi, #formStatus').hide()
    if (status == 'diajukan') {
        $('#formStatus, #diajukan').show()
        $('#form-view input').prop("disabled", true)
    } else if (status == 'tervalidasi') {
        $('#form-view input').prop("disabled", true)
        $('#tervalidasi').show()
    } else if (status == 'revisi') {
        $('#btn-save, #form-view input').prop('disabled', false)
        $('#revisi').show()
    } else {
        $('#btn-save, #form-view input').prop('disabled', false)
        $('#terdata').show()
    }

}
