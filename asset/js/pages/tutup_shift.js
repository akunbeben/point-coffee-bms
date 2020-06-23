function submitConfirmation () {
    Swal.fire({
        title: 'Tutup Shift',
        text: 'Apakah anda ingin menutup shift?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
    }).then((result) => {
        if (result.value) {
            $('#form-tutup-shift').submit();
        }
    })
}