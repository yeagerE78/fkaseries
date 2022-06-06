<?php
require_once('../../action/connection.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare('SELECT * FROM series WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    header('location:../dashboard.php');
}

if (isset($_POST['edittype'])) {
    $id = $_GET['id'];
    $category = $_POST['category'];
    $stmt = $conn->prepare('UPDATE series SET category=:category WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':category', $category);
    if ($stmt->execute()) {
        header('location:../dashboard.php');
    }
}
?>


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
        <form method="post" enctype="multipart/form-data">
            <select class="form-select" name="category">
                <option selected value="none"> not selected</option>
                <?php $stmt = $conn->prepare('SELECT * FROM type');
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $row['category'] ?>"><?php echo $row['category'] ?></option>
                <?php } ?>
            </select>
            <div class="submit mt-2">
                <button type="submit" name="edittype" class="btn btn-primary confirm ">Comfirm</button>
                <a class="btn btn-danger" href="../dashboard.php">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>