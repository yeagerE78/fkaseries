<?php
require_once('../../../action/connection.php');
session_start();

if (isset($_POST['addseries'])) {
    if (empty($_POST['title'])) {
        $_SESSION['error'] = 'please enter title';
        header('location:../addseries.php');
    } else if (($_FILES['image']['size'] == 0)) {
        $_SESSION['error'] = 'please enter image';
        header('location:../addseries.php');
    } else if (empty($_POST['imdb'])) {
        $_SESSION['error'] = 'please enter score imdb';
        header('location:../addseries.php');
    } else {
        $title = $_POST['title'];
        $image = $_FILES['image']['name'];
        $imdb = $_POST['imdb'];
        $category = $_POST['category'];
        $resolution = $_POST['resolution'];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "../../../image/" . $image;
        
        $sql = 'INSERT INTO series(title,image,category,imdb,resolution) 
        VALUES (:title, :image,:category,:imdb,:resolution)';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':imdb', $imdb);
        $stmt->bindParam(':resolution', $resolution);
        if ($stmt->execute()) {
            move_uploaded_file($tempname, $folder);
            $_SESSION['success'] = 'insert successfully';
            header('location:../addseries.php');
        } else {
            $_SESSION['error'] = 'cannot insert';
            header('location:../addseries.php');
        }
    }
} else {
    $_SESSION['error'] = 'non';
    header('location:../addseries.php');
}
