<?php
require_once('../action/connection.php');
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $stmt = $conn->prepare('SELECT * FROM series WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $image = $row['image'];
    echo $row['image'];
    if (unlink("../image/" . $image)) {
        $stmt_d = $conn->prepare('DELETE FROM series WHERE id = :id');
        $stmt_d->bindParam(':id', $id);
        $stmt_d->execute();
        header('location:dashboard.php');
    } else {
        echo 'cannot delete';
    }
}
if (isset($_GET['deletetype_id'])) {
    $id = $_GET['deletetype_id'];
    $stmt = $conn->prepare('DELETE FROM type WHERE id = :id');
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        header('location:dashboard.php');
    } else {
        echo 'cannot delete';
    }
}
if (isset($_GET['deletepart_id'])) {
    $id = $_GET['deletepart_id'];
    $stmt = $conn->prepare('DELETE FROM part WHERE id = :id');
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        header('location:dashboard.php');
    } else {
        echo 'cannot delete';
    }
}
