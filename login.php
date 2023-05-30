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
              <link rel="icon" href="https://cdn-icons-png.flaticon.com/128/3652/3652191.png" type="image/x-icon">

    <title>Login</title>
</head>
<body>

 <?php
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<div class="alert">
  <span class="closebtn">&times;</span>
  invalid user name or password
</div>';
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


    <div class="form-container">
        <form action="loginBackend.php" method="post">
            <h1>Sign in</h1>
            <input required type="text" id="user_name" name="user_name" placeholder="User Name" />
            <input required type="password" name="password" placeholder="Password" />
            <label>You Dont Have Account ? </label>     <a href="signUp.php"> Creat Account</a>
            <button>Sign In</button>
        </form>
    </div>

</body>
</html>
