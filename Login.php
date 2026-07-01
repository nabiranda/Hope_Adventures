<?php
ob_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: Login.html");
    exit;
}

$email = mysqli_real_escape_string($conn, trim($_POST["email"] ?? ''));
$password = mysqli_real_escape_string($conn, trim($_POST["password"] ?? ''));

if ($email === '' || $password === '') {
    header("Location: Login.html?error=1");
    exit;
}

$sql = "SELECT * FROM user WHERE email ='$email' AND password='$password'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if ($user) {
    header('Location: index.html');
    exit;
} else {
    header("Location: Login.html?error=1");
    exit;
}
?>