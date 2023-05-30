<?php
// Kullanıcı kimliğinin geçerli olup olmadığını kontrol etmek için include 'config.php';
include 'config.php';
include 'validation.php';
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

<!DOCTYPE html>


<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=0.8, user-scalable=no">
    <meta charset="UTF-8">
    <title>Calendar</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale-all.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.print.min.css"
        media="print" />
    <link rel="stylesheet" href="createventstyle.css">
    <link rel="stylesheet" href="inputstyle.css">
    <link rel="stylesheet" href="nav.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/128/3652/3652191.png" type="image/x-icon">

</head>

<body>

    <?php include 'navbar.php'; ?>

    <script>
        $(document).ready(function () {
            // takvimi başlat
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                defaultView: 'month',
                editable: true,
                eventLimit: true, // çok fazla etkinlik olduğunda "daha fazla" bağlantıya izin ver
                selectable: true,
                selectHelper: true,
                select: function (start, end) {
                    // Bir kullanıcı bir tarih/zaman dilimini tıkladığında etkinlik oluşturma formunu açar
                    $('#createEventModal').modal('show');
                    $('#eventTitle').val('');
                    $('#eventStart').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                    $('#eventEnd').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                },
                eventRender: function (event, element) {
                    // Her olaya, olay başlığını ve açıklamasını gösteren bir araç ipucu ekleyin
                    element.attr('title', event.title + '\n' + event.description);
                },
                events: 'getEvents.php' // olayları sunucu tarafı komut dosyasından alın
            });

            // Etkinlik oluşturma formunu AJAX aracılığıyla gönderin
            $('#createEventForm').submit(function (e) {
                e.preventDefault();

                var start = $('#eventStart').val();
                var end = $('#eventEnd').val();

                // Bitiş zamanının başlangıç ​​zamanından önce olup olmadığını kontrol edin
                if (moment(end).isBefore(start)) {
                    alert("End time cannot be before start time!");
                    return;
                }

                $.ajax({
                    method: 'POST',
                    url: 'addEvent.php',
                    data: $('#createEventForm').serialize(),
                    success: function (response) {
                        $('#createEventModal').modal('hide');
                        $('#calendar').fullCalendar('refetchEvents');
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText); // hataları konsola kaydedin
                    }
                });
            });
        });
    </script>

    <!-- Etkinlik oluşturma formu -->
    <div class="modal fade" id="createEventModal" tabindex="-1" role="dialog" aria-labelledby="createEventModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"></div>
                <div class="modal-body">
                    <form id="createEventForm" method="post">
                        <div class="form-group">
                            <label for="eventTitle">Title</label>
                            <input type="text" class="form-control" id="eventTitle" name="title"
                                placeholder="Event title" required>
                        </div>
                        <div class="form-group">
                            <label for="eventDescription">Description</label>
                            <textarea class="form-control" id="eventDescription" name="description"
                                placeholder="Event description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="eventStart">Start Time</label>
                            <input type="datetime-local" class="form-control" id="eventStart" name="start_time"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="eventEnd">End Time</label>
                            <input type="datetime-local" class="form-control" id="eventEnd" name="end_time" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" onclick="refreshPage()">Create</button>
                            <script>
                                function refreshPage() {
                                    location.reload();
                                }
                            </script>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>