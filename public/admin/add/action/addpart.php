<?php
require_once('../../../action/connection.php');
session_start();

if (isset($_POST['addpart'])) {
    if (empty($_POST['seriesid'])) {
        $_SESSION['error'] = 'please enter seriesid';
        header('location:../addpart.php');
    } else if (empty($_POST['part'])) {
        $_SESSION['error'] = 'please enter score part';
        header('location:../addpart.php');
    } else if (empty($_POST['url'])) {
        $_SESSION['error'] = 'please enter score url';
        header('location:../addpart.php');
    } else {
        $seriesid = $_POST['seriesid'];
        $part = $_POST['part'];
        $url = $_POST['url'];

        $sql = 'INSERT INTO part(seriesid,part,parturl) VALUES (:seriesid, :part,:url)';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':seriesid', $seriesid);
        $stmt->bindParam(':part', $part);
        $stmt->bindParam(':url', $url);
        if ($stmt->execute()) {
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
