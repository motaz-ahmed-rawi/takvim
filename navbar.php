<!DOCTYPE html>

<head>
    <title>Örnek Sayfa</title>
    <link rel="stylesheet" href="navbar.css"/>
      <link rel="icon" href="https://cdn-icons-png.flaticon.com/128/3652/3652191.png" type="image/x-icon">

</head>
<body>

<!-- Navbar top -->
<div class="navbar-top">
    <!-- Navbar -->
    <ul>
        <li>
            <a href="index.php?user_id=<?php echo $user_id; ?>">
                <i class="fa fa-home fa-2x"></i>
            </a>
        </li>
        <li>
            <a href="events.php?user_id=<?php echo $user_id; ?>">
                <i class="fa fa-bell fa-2x"></i>
            </a>
        </li>
        <li>
            <a href="creatEvent.php?user_id=<?php echo $user_id; ?>">
                <i class="fa fa-plus fa-2x"></i>
            </a>
        </li>
        <li>
            <a href="myprofile.php?user_id=<?php echo $user_id; ?>">
                <i class="fa fa-user fa-2x"></i>
            </a>
        </li>
        <li>
            <a href="logout.php?user_id=<?php echo $user_id; ?>">
                <i class="fa fa-sign-out-alt fa-2x"></i>
            </a>
        </li>
    </ul>
    <!-- End -->
</div>
<!-- End -->




</body>
</html>
