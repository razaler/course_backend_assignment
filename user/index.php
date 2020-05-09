<?php

SESSION_START();

include("../database.php"); // sertakan database.php untuk dapat menggunakan class database

$db = new Database(); // membuat objek baru dari class database agar dapat menggunakan fungsi didalamnya

$username = (isset($_SESSION['username'])) ? $_SESSION['username'] : "";

if ($username) {

    $result = $db->execute("SELECT * FROM user WHERE username = '" . $username . "'  ");

    if (!$result) {

        // redirect ke halaman login, data tidak valid

        header("Location: http://localhost/course_backend_assignment/");
    }
} else {

    header("Location: http://localhost/course_backend_assignment/");
}

$notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";

if ($notification) {

    echo $notification;

    unset($_SESSION['notification']);
}

?>

PAGE : HOME

<table border=1>

    <tr>

        <td>MENU</td>

        <td><a href="http://localhost/course_backend_assignment/user/">HOME</a></td>

        <td><a href="http://localhost/course_backend_assignment/user/submit_score.php">SUBMIT SCORE</a></td>

        <td><a href="http://localhost/course_backend_assignment/user/leaderboard.php">LEADERBOARD</a></td>

        <td><a href="http://localhost/course_backend_assignment/user/logout.php">LOGOUT</a></td>

    </tr>

    <tr>
        <td align="center" colspan=5>Profile</td>
    </tr>

    <tr>
        <td>USERNAME</td>
        <td colspan=4><?php echo $username; ?></td>
    </tr>

</table>