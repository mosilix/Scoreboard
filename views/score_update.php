<h1>Score Update</h1>
<?php
session_start();
if (!isset($_SESSION["username"]))
    header("Location: /login");
else {
    if (isset($_GET['score'])) {
        $username = $_SESSION['username'];
        $score = $_GET['score'];
        $url = 'http://localhost/scoreboard/api/user/update_score.php?username=' . $username . '&score=' . $score;
        $contents = file_get_contents($url);
        if ($contents !== false) {
            $result = json_decode($contents);
            header("Location: /board");
            echo $contents;
        }
    }
}
?>

<form action="" method="GET">
    <input name="score" type="text">
    <input type="submit" value="submit">
</form>