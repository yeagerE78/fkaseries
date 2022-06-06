<?php

$password = "oi452100";
$password = password_hash($password, PASSWORD_DEFAULT);
echo $password;
?>