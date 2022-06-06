<?php
require_once('../../action/connection.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script src="../../js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".confirm").click(function() {
                if (!confirm("Confirm!!")) {
                    return false;
                }
            });
        });
    </script>
    <title>Add Category</title>
</head>

<body>
    <div class="container p-5">
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger text-capitalize" role="alert">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php } ?>
        <?php if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success text-capitalize" role="alert">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php } ?>

        <form action="action/addtype.php" method="post">
            <div class="mb-3">
                <label for="category">Add Category</label>
                <input type="text" class="form-control" name="category">
            </div>
            <button type="submit" name="type" class="btn btn-primary confirm ">Comfirm</button>
            <a class="btn btn-danger" href="../dashboard.php">Cancel</a>
        </form>
    </div>
</body>

</html>