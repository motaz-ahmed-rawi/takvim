<?php

include 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Kullanıcı girişlerini al
$name_surname = $_POST['name_surname'];
$user_name = $_POST['user_name'];
$password = $_POST['password'];
$mail = $_POST['mail'];
$tc = $_POST['tc'];
$phone_number = $_POST['phone_number'];
$adress = $_POST['adress'];

// Kullanıcı adının mevcut olup olmadığını kontrol edin
$sql = "SELECT * FROM users WHERE user_name = '$user_name'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
        // URL'de bir parametre olarak bir hata mesajıyla oturum açma sayfasına yönlendir
    header("Location: signUp.php?error=1");
    exit();
    exit;
}


// E-posta olup olmadığını kontrol edin
$sql = "SELECT * FROM users WHERE TRIM(mail) = TRIM('$mail')";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
header("Location: signUp.php?error=2");
    exit;
}

// Telefon numarasının var olup olmadığını kontrol edin
$sql = "SELECT * FROM users WHERE phone_number = '$phone_number'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
header("Location: signUp.php?error=3");
    exit;
}


// Telefon numarasının var olup olmadığını kontrol edin
$sql = "SELECT * FROM users WHERE tc = '$tc'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
header("Location: signUp.php?error=4");
    exit;
}



// Kullanıcıyı veritabanına ekle
$sql = "INSERT INTO users (name_surname,user_name, password, mail, tc, phone_number, adress) 
        VALUES ('$name_surname','$user_name', '$password', '$mail', '$tc', '$phone_number', '$adress')";
if ($conn->query($sql) === TRUE) {
    header("Location: login.php");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>