<?php

SESSION_START();

include("../database.php"); // sertakan database.php untuk dapat menggunakan class database

$db = new Database(); // membuat objek baru dari class database agar dapat menggunakan fungsi didalamnya   

$username = $_POST['username'];

$password = md5($_POST['password']);

$password2 = md5($_POST['password2']);

if ($password == $password2) {

    if ($password) {

        $result = $db->execute("INSERT INTO user(username, password) VALUES(
                                '" . $username . "', '" . $password . "'
                                )");

        if ($result) {
            $_SESSION["notification"] = "Register User Berhasil";
        } else {
            $_SESSION["notification"] = "Register gagal coba gunakan username lain";
        }
    }
}

header("Location: http://localhost/course_backend_assignment/");
