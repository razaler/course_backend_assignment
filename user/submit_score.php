<?php

SESSION_START();

include("../database.php"); // sertakan database.php untuk dapat menggunakan class database

$db = new Database(); // membuat objek baru dari class database agar dapat menggunakan fungsi didalamnya

$username = (isset($_SESSION['username'])) ? $_SESSION['username'] : "";

if ($username) {

    $result = $db->execute("SELECT * FROM user WHERE username = '" . $username . "' ");

    if (!$result) {

        // redirect ke halaman login, data tidak valid

        header("Location: http://localhost/course_backend_assignment/");
    }

    $userdata = $db->get("SELECT username FROM user");

    $userdata = mysqli_fetch_assoc($userdata);
} else {

    header("Location: http://localhost/course_backend_assignment/");
}

$notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";

if ($notification) {

    echo $notification;

    unset($_SESSION['notification']);
}

?>

PAGE : SUBMIT SCORE

<table border=1>

    <tr>

        <td>MENU</td>

        <td><a href="http://localhost/course_backend_assignment/user/">HOME</a></td>

        <td><a href="http://localhost/course_backend_assignment/user/submit_score.php">SUBMIT SCORE</a></td>

        <td><a href="http://localhost/course_backend_assignment/user/leaderboard.php">LEADERBOARD</a></td>

        <td><a href="http://localhost/course_backend_assignment/user/logout.php">LOGOUT</a></td>

    </tr>

</table>

<br>

<form action="http://localhost/course_backend_assignment/user/submit_score_process.php" method="POST">

    username: <input type="text" name="username"><br>
    id level: <input type="number" name="idlevel"><br>
    score:<input type="number" name="skor"><br>
    <input type="submit">

</form>