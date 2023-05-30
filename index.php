<?php
// Kullanıcı kimliğinin geçerli olup olmadığını kontrol etmek için validation.php'yi ekleyin
include 'validation.php';
include 'config.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Calendar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.print.min.css" media="print" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale-all.min.js"></script>

    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=0.8, user-scalable=no">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/128/3652/3652191.png" type="image/x-icon">


</head>

<body>
    <?php include 'navbar.php'; ?>


    <?php
    // Etkinlikleri sorgula
    // Veritabanı bağlantısı
    $servername = "sql302.epizy.com";
    $dbname = "epiz_34184714_xtakvim";
    $username = "epiz_34184714";
    $password = "yGRE876zzRclWos";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Etkinlikleri sorgula
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM events WHERE user_id = $user_id";
    $result = $conn->query($sql);
    $conn->close();
    ?>



            <div id="myModal" class="modal2">
        <!-- Modal content -->
        <div class="modal2-content">
            <span class="close" onclick="closeModal()">&times;</span>
          
                   <?php $row = $result->fetch_assoc() ?>

                            <h2 ><?php echo $row['title']; ?></h2>
                            <p><?php echo $row['description']; ?></p>
                            <p>Start Time:<?php echo $row['start_time']; ?></p>
                            <p>End Time: <?php echo $row['end_time']; ?></p>
                             <a href="delete_event.php?event_id=<?php echo $row['event_id']; ?>">
                                <i class="fas fa-trash"></i>
                            </a> 
                            <a href="edit_event.php?user_id=<?php echo $user_id;?>&event_id=<?php echo $row['event_id']; ?>">
                                <i class="fas fa-edit"></i>
                            </a>


        </div>
    </div>

    
    <div id="calendar"></div>

    <script>
        var events = [
            <?php foreach ($result as $row) : ?> {
                    event_id: '<?php echo $row['event_id']; ?>',
                    title: '<?php echo $row['title']; ?>',
                    start: '<?php echo $row['start_time']; ?>',
                    end: '<?php echo $row['end_time']; ?>',
                    description: '<?php echo $row['description']; ?>'
                },
            <?php endforeach; ?>
        ];

        //function Bir olayın devam edip etmediğini kontrol etme 
        function isEventOngoing(event) {
            var current_time = moment();
            var start_time = moment(event.start);
            var end_time = moment(event.end);
            return start_time <= current_time && end_time >= current_time;
        }

        //function ekranı/sesi duraklat  pop up box
        var alertSound = new Audio('alert_sonud.mp3');
        var isAlertPlaying = false;

        function toggleAlertSound() {
            if (!isAlertPlaying) {
                playAlertSound();
            } else {
                stopAlertSound();
            }
        }
        //function pop up boxu kapatmak için 
        function playAlertSound() {
            alertSound.play();
            isAlertPlaying = true;
        }

        function stopAlertSound() {
            alertSound.pause();
            alertSound.currentTime = 0;
            isAlertPlaying = false;
        }



        // Function devam eden olaylar için uyarı mesajı görüntülemek için
        function displayAlert(event) {
            var alertBox = document.createElement('div');
            alertBox.setAttribute('class', 'alert');
            alertBox.setAttribute('id', 'alert');
            alertBox.innerHTML = 'The event "' + event.title + '" is currently ongoing.';
            var closeButton = document.createElement('button');
            closeButton.setAttribute('class', 'close-button');
            closeButton.innerHTML = 'Close';
            closeButton.addEventListener('click', function() {
                alertBox.parentNode.removeChild(alertBox);
                toggleAlertSound();
            });

            alertBox.appendChild(closeButton);
            document.body.appendChild(alertBox);
        }






        // Takvimi başlat
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                defaultView: 'month',
                editable: true,
                eventLimit: true,
                selectable: true,
                selectHelper: true,
                events: events,
                eventRender: function(event, element) {
                    element.attr('title', event.title + '\n' + event.description);
                },
                eventClick: function(calEvent, jsEvent, view) {
                    var modal = document.getElementById("myModal");
                    modal.style.display = "block";
                    var eventTitle  = calEvent.title;
                    var eventDes  = calEvent.description;
                    var startTime  = calEvent.start.format('YYYY-MM-DD HH:mm:ss');
                    var endTime  = calEvent.end.format('YYYY-MM-DD HH:mm:ss');
                    var eventId = calEvent.event_id;
                    var element = document.getElementById("eventTitleElement");
                     element.innerHTML = eventTitle;
                     var element = document.getElementById("eventDesElement");
                     element.innerHTML = eventDes;
                     var element = document.getElementById("startTimeElement");
                     element.innerHTML = startTime;
                     var element = document.getElementById("endTimeElement");
                     element.innerHTML = endTime;
                     var element = document.getElementById("eventIdElement");
                     element.innerHTML = eventId;


                }
            });

            // Devam eden olaylar için uyarı göster
            events.forEach(function(event) {
                if (isEventOngoing(event)) {
                    displayAlert(event);
                    playAlertSound();

                }
            });
        });
        // Devam eden olaylar için uyarı göster
         function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>