<?php

SESSION_START();

include("../database.php"); // sertakan database.php untuk dapat menggunakan class database

$db = new Database(); // membuat objek baru dari class database agar dapat menggunakan fungsi didalamnya   

$username = $_POST['username'];

$password = md5($_POST['password']);

$result = $db->get("SELECT username FROM user WHERE username= '" . $username . "' AND password='" . $password . "' ");

if ($result) {

    $_SESSION['notification'] = "Berhasil Login, Selamat Datang";
    $_SESSION['username'] = $username;

    header("Location: http://localhost/course_backend_assignment/user/");
}

$_SESSION['notification'] = "Gagal Login, Coba lagi";

header("Location: http://localhost/course_backend_assignment/");
