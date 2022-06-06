<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/login.css?=<?php echo time() ?>">
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('body').fadeIn('slow')
            $('#warning').hide()
        });

        $(document).on('keypress', function(e) {
            if (e.which == 13) {
                login();
            }
        });
    </script>
    <script src="../js/login.js?=<?php echo time() ?>"></script>
    <title>Login</title>
</head>

<body>

    <div class="login-box">
        <h2>Login</h2>
        <form>
            <div class="user-box">
                <input id="user" type="text" required>
                <label>Username</label>
            </div>
            <div class="user-box">
                <input id="password" type="password" required>
                <label>Password</label>
            </div>
            <p id="warning" class="text-danger fw-bold text-center text-capitalize m-0"></p> <br>
            <a class="py-2" href="#" onclick="login()">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Submit
            </a>
        </form>
    </div>
</body>

</html>