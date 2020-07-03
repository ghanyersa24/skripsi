const requestGet = url => {
    return $.ajax({
        type: "GET",
        url: url,
        async: false,
        success: function(res) {
            if (res.error)
                swal('Gagal !', res.message, 'error')
        },
        done: function(res) {
            return res
        },
        error: function(xhr, ajaxOptions, thrownError) {
            swal('Gagal !', `(${xhr.status}) ${thrownError}`, 'error')
        }
    }).responseJSON
}

const message = (res) => {
    if (!res.error)
        swal('Berhasil !', res.message, 'success')
    else
        swal('Gagal !', res.message, 'error')
}

const requestPost = (url, data, file = false, alert = true) => {
    if (file)
        return $.ajax({
            type: "POST",
            url: url,
            data: data,
            async: false,
            processData: false,
            contentType: false,
            success: function(res) {
                if (alert)
                    message(res)
                if (res.error)
                    swal('Gagal !', res.message, 'error')
            },
            done: function(res) {
                return res
            },
            error: function(xhr, ajaxOptions, thrownError) {
                swal('Gagal !', `(${xhr.status}) ${thrownError}`, 'error')
            }
        }).responseJSON
    else
        return $.ajax({
            type: "POST",
            url: url,
            data: data,
            async: false,
            success: function(res) {
                if (alert)
                    message(res)
                if (res.error)
                    swal('Gagal !', res.message, 'error')
            },
            done: function(res) {
                return res
            },
            error: function(xhr, ajaxOptions, thrownError) {
                swal('Gagal !', `(${xhr.status}) ${thrownError}`, 'error')
            }
        }).responseJSON
}

const googleDrive = (url, data) => {
    return $.ajax({
        type: "POST",
        url: url,
        data: data,
        // async: false,
        processData: false,
        contentType: false,
        success: function(res) {
            if (!res.error)
                swal('Berhasil !', res.message, 'success')
            else if (res.error && res.message == 'silahkan melakukan autentikasi google drive')
                konfirm('menggunggah file ke google drive perlu autentikasi google.').then((yes) => {
                    if (yes)
                        window.open(res.data.url)
                })
            else
                swal('Gagal !', res.message, 'error')
        },
        done: function(res) {
            return res
        },
        error: function(xhr, ajaxOptions, thrownError) {
            swal('Gagal !', `(${xhr.status}) ${thrownError}`, 'error')
        }
    }).responseJSON
}

function konfirm(message) {
    return swal({
        title: "Apakah Kamu yakin?",
        text: message,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
}