<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "sap";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("koenksi gagal: " . $conn->connect_error);
}