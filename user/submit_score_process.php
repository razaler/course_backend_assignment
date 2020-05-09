<?php

SESSION_START();

include("../database.php"); // sertakan database.php untuk dapat menggunakan class database

$db = new Database(); // membuat objek baru dari class database agar dapat menggunakan fungsi didalamnya   

$username = $_POST['username'];

$id_level = $_POST['idlevel'];

$score = $_POST['skor'];

$result = $db->execute("INSERT INTO score(username, id_level, user_score) VALUES('" . $username . "', " . $id_level . ", " . $score . ")");

if ($result) {
    $_SESSION["notification"] = "Submit score Berhasil";
} else {
    $_SESSION["notification"] = "Submit score gagal ";
}


header("Location: http://localhost/course_backend_assignment/");
