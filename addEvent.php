<?php
session_start();
include 'config.php';

// Oturumdan kullanıcı kimliğini al
$user_id = $_SESSION['user_id'];

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {  
  die("Connection failed: " . $conn->connect_error);  
}  

// Kullanıcı girişlerini al 
$title = mysqli_real_escape_string($conn, $_POST['title']);  
$description = mysqli_real_escape_string($conn, $_POST['description']);  
$start_time = mysqli_real_escape_string($conn, $_POST['start_time']);  
$end_time = mysqli_real_escape_string($conn, $_POST['end_time']);  

// Olay verilerini veritabanına ekle
$sql = "INSERT INTO events (title, description, start_time, end_time, user_id)   
      VALUES ('$title', '$description', '$start_time', '$end_time', '$user_id')";  
if ($conn->query($sql) === TRUE) {  
  echo "success"; // kullanıcıya bir başarı mesajı gönder
} else {  
  echo "error: " . $conn->error; // kullanıcıya bir hata mesajı gönder
}  

$conn->close();  
?>