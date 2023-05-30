<?php
session_start(); // Yeni bir oturum başlat

include 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_name = $_POST['user_name'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE user_name = '$user_name' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Kullanıcı kimliğini veritabanından al
    $row = $result->fetch_assoc();
    $user_id = $row['id'];

    // Kullanıcı kimliğini bir oturum değişkeni olarak ayarla
    $_SESSION['user_id'] = $user_id;

    // URL'de parametre olarak kullanıcı kimliğinin bulunduğu takvim sayfasına yönlendir
    header("Location: index.php?user_id=$user_id");
    
    exit();
} else {
    // URL'de bir parametre olarak bir hata mesajıyla oturum açma sayfasına yönlendir
    header("Location: login.php?error=1");
    exit();
}

$conn->close();
?>
