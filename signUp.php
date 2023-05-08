<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
    crossorigin="anonymous">
         <link rel="stylesheet" href="login_signupStyle.css">

    <title>signUp</title>
      <link rel="icon" href="https://cdn-icons-png.flaticon.com/128/3652/3652191.png" type="image/x-icon">


</head>
<body>
  
 <?php
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<div class="alert">
  <span class="closebtn">&times;</span>
user name exist </div>';
    }

  if (isset($_GET['error']) && $_GET['error'] == 2) {
        echo '<div class="alert">
  <span class="closebtn">&times;</span>
email exist </div>';
    }
      if (isset($_GET['error']) && $_GET['error'] == 3) {
        echo '<div class="alert">
  <span class="closebtn">&times;</span>
phone number exist </div>';
    }
         if (isset($_GET['error']) && $_GET['error'] == 4) {
        echo '<div class="alert">
  <span class="closebtn">&times;</span>
tc exist </div>';
    }

    ?>


    <script>
// class="closebtn" ile tüm öğeleri al
var close = document.getElementsByClassName("closebtn");
var i;

// Tüm kapatma düğmeleri arasında geçiş yap
for (i = 0; i < close.length; i++) {
  // Birisi kapat düğmesine tıkladığında
  close[i].onclick = function(){

    // <span class="closebtn"> öğesinin ebeveynini alın (<div class="alert">)
    var div = this.parentElement;

    // div'in opaklığını 0 (şeffaf) olarak ayarla
    div.style.opacity = "0";

    // 600 msn sonra div'i gizleyin (solma için gereken milisaniye ile aynı miktarda)
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
</script>




      <div class="form-container sign-up-container">
    <form action="signupBackend.php" method="post">
        <h1>Create Account</h1>

        <input required type="text" id="name_surname" name="name_surname" maxlength="50" placeholder="Name and Surname" />
         <input required type="text" id="user_name" name="user_name" maxlength="50" placeholder="User Name" />
        <input required type="number" id="tc" name="tc" oninput="limitInputLength(this)" min="0" step="1"  placeholder="Tc No" />
        <input required type="number" id="phone_number" name="phone_number" oninput="limitInputLength(this)" min="0" step="1"  placeholder="Phone Number" />
        <input required type="email" id="mail" name="mail" maxlength="50" placeholder="Mail" />
        <input required type="text" id="adress" name="adress" maxlength="150" placeholder="Address" />
        <input required type="password" id="password" name="password" maxlength="50" placeholder="Password" />

        <label>Already have an account?</label>
        <a href="login.php">Sign In</a>

        <button>Sign Up</button>
    </form>
</div>

<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        var nameSurname = document.getElementById('name_surname').value;
        var tcNo = document.getElementById('tc').value;
        var phoneNumber = document.getElementById('phone_number').value;
        var mail = document.getElementById('mail').value;
        var adress = document.getElementById('adress').value;
        var password = document.getElementById('password').value;

        if (nameSurname.length > 50) {
            event.preventDefault(); // Formun kısıtlanmasını engelleme
            alert('Name and Surname cannot exceed 50 characters.');
        }
       if (user_name.length > 50) {
            event.preventDefault(); 
            alert('username cannot exceed 50 characters.');
        }

        if (tcNo.length !== 11) {
            event.preventDefault();
            alert('Tc No must be exactly 11 characters.');
        }

        if (phoneNumber.length > 16) {
            event.preventDefault();
            alert('Phone Number cannot exceed 16 characters.');
        }

        if (mail.length > 50) {
            event.preventDefault();
            alert('Mail cannot exceed 50 characters.');
        }

        if (adress.length > 150) {
            event.preventDefault();
            alert('Address cannot exceed 150 characters.');
        }

        if (password.length > 50 ||password.length <8) {
            event.preventDefault();
            alert('Password cannot be less from 8 characters exceed 50 characters.');
        }
    });
         function limitInputLength(input) {
            if (input.value.length > 11) {
                input.value = input.value.slice(0, 11);
            }
        }
</script>




</body>
</html>