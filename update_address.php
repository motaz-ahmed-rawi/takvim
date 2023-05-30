<?php
  session_start();

  // Kullanıcının oturum açıp açmadığını kontrol edin
  if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
  }

  // Kullanıcı girişi alın
  $new_address = $_POST['address'];

  include 'config.php';


  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $user_id = $_SESSION['user_id'];
  $sql = "UPDATE users SET adress = '$new_address' WHERE id = '$user_id'";

  if ($conn->query($sql) === TRUE) {
    $_SESSION['message'] = "The Adress Has Updated.";
  } else {
    $_SESSION['message'] = "Error: Try Again.";
  }

  $conn->close();

  // Profil sayfasına yönlendir
  header("Location: myprofile.php?user_id=$user_id");

  exit();
?>