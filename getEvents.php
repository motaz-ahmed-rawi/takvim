<?php
// Veritabanına bağlan
  include 'config.php';



$conn = new mysqli($servername, $username, $password, $dbname);
// Bağlantıyı kontrol et
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Olayları veritabanından al
$sql = "SELECT id, title, description, start_time, end_time FROM events";
$result = $conn->query($sql);

// FullCalendar için olayları biçimlendir
$events = array();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $event = array();
    $event['id'] = $row['id'];
    $event['title'] = $row['title'];
    $event['description'] = $row['description'];
    $event['start'] = $row['start_time'];
    $event['end'] = $row['end_time'];
    array_push($events, $event);
  }
}


$conn->close();
?>