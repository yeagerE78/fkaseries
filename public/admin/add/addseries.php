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
    <title>Add Series</title>
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
        <form action="action/addseries.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image cover</label>
                <input class="form-control" type="file" name="image">
            </div>
            <div class="mb-3">
                <label for="imdb">Score imdb</label>
                <input type="text" class="form-control" name="imdb" value="5.5">
            </div>
            <div class="mb-3">
                <select class="form-select" name="category">
                    <option selected value="none"> not selected</option>
                    <?php $stmt = $conn->prepare('SELECT * FROM type');
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $row['category'] ?>"><?php echo $row['category'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <select class="form-select" name="resolution">
                <option selected value="hd">HD</option>
                <option value="ZM">ZOOM</option>
            </select>

            <div class="submit mt-2">
                <button type="submit" name="addseries" class="btn btn-primary confirm ">Comfirm</button>
                <a class="btn btn-danger" href="../dashboard.php">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>