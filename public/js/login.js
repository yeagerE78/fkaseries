function login() {
    var username = $('#user').val()
    var password = $('#password').val()
    var formdata = 'username=' + username + '&password=' + password;
    if (username == '') {
        $('#warning').text('Please enter username')
        $('#warning').fadeIn('100')
    } else if (password == '') {
        $('#warning').text('Please enter password')
        $('#warning').fadeIn('100')
    } else {
        $.ajax({
            type: "POST",
            url: "../action/login.php",
            data: formdata,
            cache: false,
            success: function (html) {

                if (html == 'match') {
                    $('#warning').removeClass('text-danger')
                    $('#warning').addClass('text-success')
                    $('#warning').text('Login Successfully')
                    $('#warning').fadeIn('100')
                    setTimeout(function () {
                        window.location.href = "dashboard.php"
                    }, 1500)
                } else {
                    $('#warning').text(html)
                    $('#warning').fadeIn('100')
                }

            },
        });
    }
    return false;
}

