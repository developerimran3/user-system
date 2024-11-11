<?php

if (file_exists(__DIR__ . "/autoload.php")) {
    require_once(__DIR__ . "/autoload.php");
} else {
    echo "autoload.php not found";
} ?>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    //get form Data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conform_password = $_POST['cpassword'];

    $md5pass = md5($password);

    if ($password === $conform_password) {

        $sql = "INSERT INTO new_users (name, email, password) VALUES (:name, :email, :password)";
        $statement = connect()->prepare($sql);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $md5pass);
        $statement->execute();
    } else {
        $passError = "Password Not Match!";
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive Login, Registration & Forgot Form Design</title>
    <!-- Bootstrap 4 CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
    <!-- Fontawesome CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body class="bg-info">
    <div class="container">
        <!-- Registration Form Start -->
        <div class="row justify-content-center wrapper" id="register-box">
            <div class="col-lg-10 my-auto myShadow">
                <div class="row">
                    <div class="col-lg-5 d-flex flex-column justify-content-center myColor p-4">
                        <h1 class="text-center font-weight-bold text-white">Welcome Back!</h1>
                        <hr class="my-4 bg-light myHr" />
                        <p class="text-center font-weight-bolder text-light lead">To keep connected with us please login with your personal info.</p>
                        <a class="btn btn-outline-light btn-lg font-weight-bolder mt-4 align-self-center myLinkBtn" href="./login.php" id="login-link">Sign In</a>
                    </div>
                    <div class="col-lg-7 bg-white p-4">
                        <h1 class="text-center font-weight-bold text-primary">Create Account</h1>
                        <hr class="my-3" />
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off" class="px-3" id="register-form">
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i class="far fa-user fa-lg fa-fw"></i></span>
                                </div>
                                <input type="text" id="name" name="name" class="form-control rounded-0" placeholder="Full Name" value="<?php if (isset($_POST['submit'])) {
                                                                                                                                            echo $name;
                                                                                                                                        } ?>" />
                            </div>
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i class="far fa-envelope fa-lg fa-fw"></i></span>
                                </div>
                                <input type="email" id="email" name="email" class="form-control rounded-0" placeholder="E-Mail" value="<?php if (isset($_POST['submit'])) {
                                                                                                                                            echo $email;
                                                                                                                                        } ?>" />
                            </div>
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i class="fas fa-key fa-lg fa-fw"></i></span>
                                </div>
                                <input type="password" id="rpassword" name="password" class="form-control rounded-0" minlength="5" placeholder="Password" value="<?php if (isset($_POST['submit'])) {
                                                                                                                                                                        echo $password;
                                                                                                                                                                    } ?>" />
                            </div>
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i class="fas fa-key fa-lg fa-fw"></i></span>
                                </div>
                                <input type="password" id="cpassword" name="cpassword" class="form-control rounded-0" minlength="5" placeholder="Confirm Password" />
                            </div>
                            <div class="form-group">
                                <div id="passError" class="text-danger font-weight-bolder"> <?php if (isset($_POST['submit'])) {
                                                                                                echo $passError;
                                                                                            } ?> </div>
                            </div>
                            <div class="form-group">
                                <input type="submit"
                                    name="submit" id="register-btn" value="Sign Up" class="btn btn-primary btn-lg btn-block myBtn" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Registration Form End -->
    </div>
    <!-- jQuery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <!-- <script>
        $(function() {
            $("#register-link").click(function() {
                $("#login-box").hide();
                $("#register-box").show();
            });
            $("#login-link").click(function() {
                $("#login-box").show();
                $("#register-box").hide();
            });
            $("#forgot-link").click(function() {
                $("#login-box").hide();
                $("#forgot-box").show();
            });
            $("#back-link").click(function() {
                $("#login-box").show();
                $("#forgot-box").hide();
            });
            //Registered Ajax Request

            $("#register-btn").click(function(e) {
                if ($("#register-form")[0].checkVisibility()) {
                    e.preventDefault();
                    $("#register-btn").val('Please Wait......');
                    if ($("#rpassword").val() != $("#cpassword").val()) {
                        $("#passError").text('* Password did nat matched!');
                        $("#register-btn").val('Sign Up');
                    }
                } else {
                    $("#passError").text('');
                    $.ajax({
                        url: 'assets/php/action.php',
                        method: 'post',
                        data: $("#register-form").serialize() + '&action=register',
                        success: function(response) {
                            console.log(response);
                        }


                    })
                }

            });
        });
    </script> -->
</body>

</html>