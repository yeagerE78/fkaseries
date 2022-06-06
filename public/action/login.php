<?php
require_once('connection.php');
session_start();
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username =:username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($stmt->rowcount() > 0) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin'] = $row['id'];
            echo "match";
        } else {
            echo  "username or password wrong";
        }
    } else {
        echo 'not found username';
    }
};
