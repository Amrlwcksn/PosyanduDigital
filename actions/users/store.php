<?php
session_start();
require_once '../../connections/conn.php';
require_once '../../includes/functions.php'; // For potential future use or included helpers

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = (int) $_POST['role'];

    $sql = "INSERT INTO users (username, password, role) VALUES ('$username','$password','$role')";

    if ($conn->query($sql) === TRUE){
        flash_message('msg_user', 'User berhasil ditambahkan.');
        header("location: ../../views/users/index.php");
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
