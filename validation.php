<?php 

session_start();

// Retrieve the user ID from the URL parameter
$user_id = $_GET['user_id'];

// Redirect to login.html if user_id is not set or is equal to 0
if (!isset($user_id) || $user_id === 0) {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        // Do nothing, user is already logged in
    } else {
        header("Location: login.php");
        exit();
    }
}

include 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); 
}

$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    // User ID is not valid, redirect to login.html
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['last_user_id']) && $user_id != $_SESSION['last_user_id']) {
    // User has changed the user ID in the URL, redirect to login.html
    header("Location: login.php");
    exit();
}


$_SESSION['last_user_id'] = $user_id;

$conn->close();
?>