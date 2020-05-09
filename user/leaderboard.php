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

PAGE : LEADERBOARD

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

<form action="http://localhost/course_backend_assignment/user/leaderboard.php" method='GET'>

    Pilih Game

    <select name="gameid">

        <?php

        $gamedata = $db->get("SELECT id_game,nama_game FROM game");

        while ($row = mysqli_fetch_assoc($gamedata)) {

        ?>

            <option value="<?php echo $row['id_game'] ?>"><?php echo $row['nama_game'] ?></option>

        <?php

        }

        ?>

    </select>

    <input type="submit" value="OK">

</form>

<?php
if (isset($_GET['gameid'])) {
?>

    <form method='GET'>
        </br>
        Pilih Level
        <select name="levelid">

            <?php

            $gamedata = $db->get("SELECT id_level, nama_level FROM level WHERE level.id_game=" . $_GET['gameid'] . "");

            while ($row = mysqli_fetch_assoc($gamedata)) {

            ?>

                <option value="<?php echo $row['id_level'] ?>"><?php echo $row['nama_level'] ?></option>

            <?php

            }

            ?>

        </select>

        <input type="submit" value="OK">

    </form>

<?php
}
?>

<?php
if (isset($_GET['levelid'])) {
?>
    <table border=1>

        <tr>
            <td>NO</td>
            <td>USERNAME</td>
            <td>SCORE</td>
        </tr>

        <?php

        $leaderboarddata = $db->get("SELECT user.username as username, max(score.user_score) as highscore FROM user, score WHERE user.username = score.username AND score.id_level = " . $_GET['levelid'] . " GROUP BY user.username ORDER BY highscore DESC");

        $no = 0;

        while ($row = mysqli_fetch_assoc($leaderboarddata)) {

            $no++;

        ?>

            <tr>

                <td><?php echo $no ?></td>

                <td><?php echo $row['username'] ?></td>

                <td><?php echo $row['highscore'] ?></td>

            </tr>

        <?php

        }

        ?>

    </table>


<?php
}
?>