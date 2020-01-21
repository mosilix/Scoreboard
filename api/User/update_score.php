<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$user->username = isset($_GET['username']) ? $_GET['username'] : die();
$user->score = isset($_GET['score']) ? $_GET['score'] : die();
$stmt = $user->updateScore();
if ($stmt!=false) {
    // get updated row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $user_arr = array(
        "status" => true,
        "message" => "Successfully updated!",
        "id" => $row['id'],
        "username" => $row['username'],
        "score" => $row['score']
    );
} else {
    $user_arr = array(
        "status" => false,
        "message" => "Could not update score!",
    );
}
// make it json format
print_r(json_encode($user_arr));