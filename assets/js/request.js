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

const requestPost = (url, data, alert = true, image = false) => {
    if (image)
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

function konfirm(message) {
    return swal({
        title: "Apakah Kamu yakin?",
        text: message,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
}