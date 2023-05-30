<?php
// Devam eden tüm olayları veritabanından al
$current_time = date('Y-m-d H:i:s');
$query = "SELECT * FROM events WHERE start_time <= '$current_time' AND end_time >= '$current_time'";
$result = $mysqli->query($query);

// Sonuç kümesini bir JSON nesnesine dönüştürün
$events = array();
while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}
echo json_encode($events);
?>