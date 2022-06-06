<?php
require_once('../../../action/connection.php');
session_start();

if (isset($_POST['type'])) {
    if (empty($_POST['category'])) {
        $_SESSION['error'] = 'please enter category';
        header('location:../addtype.php');
    } else {
        $category = $_POST['category'];
        $sql = 'INSERT INTO type(category) VALUES (:category)';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':category',$category);
        if($stmt->execute()){
            $_SESSION['success'] = 'insert successfully';
            header('location:../addtype.php');
        } else{
            $_SESSION['success'] = 'cannot insert';
            header('location:../addtype.php');
        }
        
    }
} else {
    $_SESSION['error'] = 'non';
    header('location:../addtype.php');
}
