<?php
session_start();
include 'config.php';

// Kullanıcının oturum açıp açmadığını kontrol edin
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Olay kimliğini URL parametresinden alın
$event_id = $_GET['event_id'];

// Olayı silmek için SQL deyimini hazırlayın
$user_id = $_SESSION['user_id'];
$sql = "DELETE FROM events WHERE event_id = $event_id AND user_id = $user_id";

// SQL deyimini çalıştır
if ($conn->query($sql) === TRUE) {
  header("Location: {$_SERVER['HTTP_REFERER']}");
} else {
  echo "Error deleting event: " . $conn->error;
}


$conn->close();