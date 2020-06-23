$(document).ready(function() {
    $('#idtoko, #username').select2({
        theme: 'bootstrap4'
    });

    var message = $('#pesan'),
        type    = $('#typePesan');

        if (message.html() != '') {
            Swal.fire({
            title: message.html(),
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            type: type.html()
        });
    };
});

function checkPassword() {
    var oldPassword = $('#password_lama').val();
    var newPassword = $('#password_baru').val();

    if (oldPassword == newPassword) {

        Swal.fire({
            toast: true,
            title: 'Password baru tidak boleh sama dengan password lama.',
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            type: 'error'
        });

    } else {
        $('#user-form').submit();
        // console.log($('#user-form').serialize());
    }
};