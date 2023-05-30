<?php
session_start();

// Kullanıcının oturum açıp açmadığını kontrol edin
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

  include 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$event_id = $_POST['event_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];

$sql = "UPDATE events SET title='$title', description='$description', start_time='$start_time', end_time='$end_time' WHERE event_id=$event_id";

if ($conn->query($sql) === TRUE) {
  header("Location: events.php?user_id=".$_SESSION['user_id']);
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();
?>