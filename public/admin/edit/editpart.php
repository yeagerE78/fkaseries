<?php
require_once('../../action/connection.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare('SELECT * FROM part WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    header('location:../dashboard.php');
}

if (isset($_POST['editurl'])) {
    $id = $_GET['id'];
    $url = $_POST['url'];
    $stmt = $conn->prepare('UPDATE part SET parturl=:url WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':url', $url);
    if ($stmt->execute()) {
        header('location:../dashboard.php');
    }
}
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
    <title>Edit Url</title>
</head>

<body>
    <div class="container p-5">
        <form method="post">
            <div class="mb-3">
                <label for="url">Url</label>
                <input type="text" class="form-control" name="url" value="<?php echo $row['parturl'] ?>">
            </div>

            <div class="submit mt-2">
                <button type="submit" name="editurl" class="btn btn-primary confirm ">Comfirm</button>
                <a class="btn btn-danger" href="../dashboard.php">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>