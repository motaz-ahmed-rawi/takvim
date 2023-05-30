<?php
include 'validation.php';
include 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user_info = $result->fetch_assoc();
} else {
    echo "Error: User not found";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>


    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=0.8, user-scalable=no">

        <meta charset="UTF-8">
    <title>Profile Page</title>

    <!-- Custom Css -->

    <!-- FontAwesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
            <link rel="stylesheet" href="myprofilestyle.css"/>
            <link rel="icon" href="https://cdn-icons-png.flaticon.com/128/3652/3652191.png" type="image/x-icon">


                </head>

                <body>

                 <?php include 'navbar.php'; ?>



                <!-- Main -->
                <div class="main">
                    <h2>IDENTITY</h2>
                    <div class="card">
                        <div class="card-body">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Name Surname</td>
                                        <td>:</td>
                                        <td>
                                            <?php echo $user_info['name_surname']; ?>
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>User Name</td>
                                        <td>:</td>
                                        <td>
                                            <?php echo $user_info['user_name']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>
                                            <?php echo $user_info['mail']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>:</td>
                                        <td>
                                            <?php echo $user_info['adress']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tc</td>
                                        <td>:</td>
                                        <td>
                                            <?php echo $user_info['tc']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>:</td>
                                        <td>
                                            <?php echo $user_info['phone_number']; ?>
                                        </td>
                                    </tr>
                                   
                                    </tbody>
                            </table>
                        </div>
                    </div>
                
                    <!-- End -->


                    <?php
                    // Check if there is a message to display
                    if (isset($_SESSION['message'])) {
                        echo "<p>" . $_SESSION['message'] . "</p>";
                        unset($_SESSION['message']);
                    }
                    ?>
                  

                    <!-- Update Address -->
                    <button type="button" onclick="showForm('address_form')">Update Address</button>
                    <form method="post" action="update_address.php" style="display:none;" id="address_form">
                        <h2>Update Address</h2>
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" value="<?php echo $user_info['adress']; ?>">
                            <button type="submit">Update</button>
                    </form>

                   
                 


                    <!-- Update Password -->
                    <button type="button" onclick="showForm('password_form')">Update Password</button>
                    <form method="post" action="update_password.php" style="display:none;" id="password_form">
                        <h2>Update Password</h2>

                        <div class="form-group">
                            <label for="password">New Password:</label>
                            <input type="password" id="password" name="password" required>
                        </div>

                        <div class="button-container">
                            <button type="submit">Update Password</button>
                        </div>
                    </form>







                    <script>
                        // show form fun
                        function showForm(formId) {
                            var form = document.getElementById(formId);
                            form.style.display = "block";
                        }
                        //show password fun
                        function togglePasswordVisibility() {
                            var passwordInput = document.getElementById("password");
                            var passwordButton = document.querySelector("button[onclick='togglePasswordVisibility()']");

                            if (passwordInput.type === "password") {
                                passwordInput.type = "text";
                                passwordButton.textContent = "Hide";
                            } else {
                                passwordInput.type = "password";
                                passwordButton.textContent = "Show";
                            }
                        }
                    </script>






                    </body>

                    </html>