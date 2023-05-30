<?php
// gerekli 'config.php' ve 'validation.php' dosyalarını dahil edin

include 'config.php';
include 'validation.php';


// Script, sağlanan kimlik bilgilerini kullanarak bir veritabanı bağlantısı kurar.
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM events WHERE user_id = $user_id ORDER BY start_time";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>

<head>
    <title>Events</title>
    <link rel="stylesheet" href="events.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=0.8, user-scalable=no">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/128/3652/3652191.png" type="image/x-icon">



</head>

<body>
    <?php include 'navbar.php'; ?>
    <br>

    <div class="events-container">
        <h1>My Events</h1>
        <ul>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li>
                    <h2>
                        <?php echo $row['title']; ?>
                    </h2> <!-- Olay başlığı -->
                    <p>
                        <?php echo $row['description']; ?>
                    </p> <!-- Etkinlik Açıklaması -->
                    <p><strong>Start Time:</strong>
                        <?php echo $row['start_time']; ?>
                    </p> <!-- Başlangıç ​​saati -->
                    <p><strong>End Time:</strong>
                        <?php echo $row['end_time']; ?>
                    </p> <!-- Bitiş zamanı -->
                    <a href="delete_event.php?event_id=<?php echo $row['event_id']; ?>">
                        <i class="fas fa-trash"></i> <!-- Olayı sil düğmesi -->
                    </a>
                    <a href="edit_event.php?user_id=<?php echo $user_id; ?>&event_id=<?php echo $row['event_id']; ?>">
                        <i class="fas fa-edit"></i> <!-- Etkinliği düzenle düğmesi -->
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>


</body>

</html>