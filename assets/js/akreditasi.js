function status(params) {
    if (params == 'tervalidasi')
        return `<div class="badge badge-info w-100">Tervalidasi</div>`;
    else if (params == 'terdata')
        return `<div class="badge badge-secondary w-100">Terdata</div>`;
    else if (params == 'revisi')
        return `<div class="badge badge-warning w-100">Revisi</div>`;
    else
        return `<div class="badge badge-light w-100">Belum ada</div>`;
}