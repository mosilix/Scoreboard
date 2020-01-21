<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare user object
$user = new User($db);
// set ID property of user to be edited
//   $user->username = isset($_GET['username']) ? $_GET['username'] : die();
//   $user->password = isset($_GET['password']) ? $_GET['password'] : die();
// read the details of user to be edited
$stmt = $user->getScoreboard();
if ($stmt->rowCount() > 0) {
    // get retrieved row
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // create array
    $scoreboard_arr = array(
        "status" => true,
        "message" => "Scoreboard fetched successfully!",
        "scoreboard" => $row
    );

} else {
    $scoreboard_arr = array(
        "status" => false,
        "message" => "Invalid Username or Password!",
    );
}
// make it json format
print_r(json_encode($scoreboard_arr));