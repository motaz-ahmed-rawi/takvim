<?php
session_start();
include 'config.php';
include 'validation.php';

// Kullanıcının oturum açıp açmadığını kontrol edin
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$event_id = $_GET['event_id'];
$user_id = $_SESSION['user_id'];

// Olayın oturum açan kullanıcıya ait olup olmadığını kontrol edin
$sql = "SELECT * FROM events WHERE event_id = $event_id AND user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    // Etkinlik Kimliği geçerli değil veya kullanıcıya ait değil, login.php'ye yönlendir
    header("Location: login.php");
    exit();
}

$row = $result->fetch_assoc();

$conn->close();
?>


<!DOCTYPE html>
<html>

<head>
    <title>Edit Event</title>

    <!-- CSS ve JS dosyalarını dahil et -->
    <link rel="stylesheet" href="createventstyle.css" />
    <link rel="stylesheet" href="events.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.print.min.css"
        media="print" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=0.8, user-scalable=no">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/128/3652/3652191.png" type="image/x-icon">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale-all.min.js"></script>

    <script>
        // Bitiş zamanını başlangıç ​​zamanından sonra olacak şekilde doğrula
        function validateEndTime() {
            var startTime = document.getElementById("start_time").value;
            var endTime = document.getElementById("end_time").value;

            if (endTime < startTime) {
                alert("End time cannot be before start time.");
                return false;
            }

            return true;
        }
    </script>

</head>

<body>
    <?php include 'navbar.php'; ?>
    <br>

    <div style="background-color:#ecf6f7;" class="events-container">
        <h1 style=" text-align: center;">Edit Event</h1>
        <form action="update_event.php" method="post" onsubmit="return validateEndTime()">

            <input type="hidden" name="event_id" value="<?php echo $row['event_id']; ?>">

            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo $row['title']; ?>" required>
            <br>

            <label for="description">Description:</label>
            <textarea id="description" name="description"><?php echo $row['description']; ?></textarea>
            <br>

            <label for="start_time">Start Time:</label>
            <input type="datetime-local" id="start_time" name="start_time"
                value="<?php echo date('Y-m-d\TH:i', strtotime($row['start_time'])); ?>" required>
            <br>

            <label for="end_time">End Time:</label>
            <input type="datetime-local" id="end_time" name="end_time"
                value="<?php echo date('Y-m-d\TH:i', strtotime($row['end_time'])); ?>" required>
            <br>

            <input type="submit" value="Save">
        </form>
    </div>
</body>

</html>