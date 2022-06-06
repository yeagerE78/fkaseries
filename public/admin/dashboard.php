<?php
require_once('delete/delete.php');
require_once('../action/connection.php');
session_start();
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->
    <link rel="stylesheet" href="../css/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dashboard.css?=<?php echo time() ?>">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">

    <!-- javascript -->

    <script src=" ../js/jquery-3.6.0.min.js"></script>
    <script src="../js/dashboard.js?=<?php echo time() ?>"></script>
    <script>
        $(document).ready(function() {
            $(".delete").click(function() {
                if (!confirm("Confirm To Delete!!")) {
                    return false;
                }
            });
        });
    </script>

    <title>Dashboard</title>
</head>

<body>
    <div class="container p-4">
        <a href="../action/logout.php">Logout</a>

        <div class="mt-3">
            <table id="myseries">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>TITLE</th>
                        <th>CATEGORY</th>
                        <th>IMDB</th>
                        <th>RESOLUTION</th>
                        <th>Tools</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $conn->prepare('SELECT * FROM series');
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['title'] ?></td>
                            <td><?php echo $row['category'] ?></td>
                            <td><?php echo $row['imdb'] ?></td>
                            <td><?php echo $row['resolution'] ?></td>
                            <td> <a href="edit/edittype.php?id=<?php echo $row['id'] ?>" class="btn btn-warning text-white">Edit type</a>
                                <a href="?delete_id=<?php echo $row['id'] ?>" class="delete btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a class="btn btn-primary" href="add/addseries.php">Add Series</a>
        </div>

        <div class="mt-3">
            <table id="mycategory">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>TYPE</th>
                        <th>TOOL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt_ct = $conn->prepare('SELECT * FROM type');
                    $stmt_ct->execute();
                    while ($row_ct = $stmt_ct->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $row_ct['id'] ?></td>
                            <td><?php echo $row_ct['category'] ?></td>
                            <td>
                                <a href="?deletetype_id=<?php echo $row_ct['id'] ?>" class="delete btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a class="btn btn-primary" href="add/addtype.php">Add Type</a>
        </div>




        <div class="mt-3">
            <table id="mypart">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>SERIESID</th>
                        <th>PART</th>
                        <th>PARTURL</th>
                        <th>TOOL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt_part = $conn->prepare('SELECT * FROM part');
                    $stmt_part->execute();
                    while ($row_part = $stmt_part->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $row_part['id'] ?></td>
                            <td class="text-capitalize"><?php echo $row_part['seriesid'] ?></td>
                            <td class="text-capitalize"><?php echo $row_part['part'] ?></td>
                            <td><?php echo $row_part['parturl'] ?></td>

                            <td>
                                <a href="edit/editpart.php?id=<?php echo $row_part['id'] ?>" class="btn btn-warning text-white">Edit Url</a>
                                <a href="?deletepart_id=<?php echo $row_part['id'] ?>" class="delete btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a class="btn btn-primary" href="add/addpart.php">Add Part</a>
        </div>
    </div>



    <script src="../js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myseries').DataTable();
            $('#mycategory').DataTable();
            $('#mypart').DataTable();
        });
    </script>
</body>

</html>