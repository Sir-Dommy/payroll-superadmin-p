<?php
session_start();
$email1 =  $_SESSION['email']; //$email1 used when sending email

use PHPMailer\PHPMailer\PHPMailer;
USE PHPMailer\PHPMailer\Exception;

$mysqli = new mysqli('localhost', 'root', '', 'outsourcing');
if(isset($_SESSION['prev']) === false){
    $_SESSION['prev']="";  
}
if(isset($_POST['resendOTP']) || $_SESSION['prev'] == 'resetPassword'){
    $email = $_SESSION['email'];
    $email = mysqli_real_escape_string($mysqli, $email);
    $OTP = substr(session_id(),6,6);

    $sql1 = "SELECT * FROM applicantdetails WHERE applicantEmail = '$email'";
    if(mysqli_num_rows(mysqli_query($mysqli, $sql1)) == 1){
        $sql = "UPDATE applicantdetails SET OTP = '$OTP' WHERE applicantEmail = '$email'";

        if(mysqli_query($mysqli, $sql)){

            require 'PHPMailer\PHPMailer-master\src\Exception.php';
            require 'PHPMailer\PHPMailer-master/src/PHPMailer.php';
            require 'PHPMailer\PHPMailer-master/src/SMTP.php';

            $email = new PHPMailer(true);

            $email -> isSMTP();
            $email -> Host = 'smtp.gmail.com';
            $email -> SMTPAuth = true;
            $email -> Username = 'dominickyengo2017@gmail.com';
            $email -> Password = 'htbasuadyapohlun';
            $email -> SMTPSecure = 'ssl';
            $email -> Port = 465;

            $email -> setFrom('dominickyengo2017@gmail.com');

            $email -> addAddress($email1);
            $email -> isHTML(true);

            $email -> Subject = 'Verification Email';
            $email -> Body = 'Your OTP is: '.$OTP;

            $email -> send();
            echo "<script>alert('Check your email we have send the verification code')</script>";
        }
        else{
            echo "<script>alert('An error occurred please retry!!!')</script>";
        }
    }
    else{
        echo "<script>alert('You are not registered ensure that you have registered')</script>";  
    }

}

$passwordErr = "";

if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
}
else{
    $email = "";
}

if(isset($_POST['continue'])){
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    if((strlen($password1)<6)){
        $passwordErr = "Password must be more than 5 characters <br>"; 
    }
    if($password1 != $password2){
        $passwordErr = "Passwords must match!!!"; 
    }

    else{
        $OTP = $_POST['OTP'];
        // $email = $_POST['email'];
        $email2 = $email1; //for use in sending email...$email2
        $email1 = mysqli_real_escape_string($mysqli, $email);

        echo $email1;

        $sql = "SELECT * FROM applicantDetails WHERE applicantEmail = '$email1'";

        $res = mysqli_query($mysqli, $sql);
        $rows = mysqli_fetch_row($res);

        if(mysqli_num_rows($res)<1){
            echo "<script>alert('Email does not exist please ensure that you have registered!')</script>";
        }
        else if($rows[7] === $OTP){
            $time = date('Y-m-d h:i:sa');
            $sql = "UPDATE applicantdetails SET
            status = 'Verified',
            password = '$password1',
            statusDate = '$time'
            WHERE applicantEmail = '$email1'";

            if(mysqli_query($mysqli,$sql)){
                header('location: applicantHomePage.php');
                exit();
            }
            else{
                echo "<script>alert('An error occurred please retry!!!')</script>";
            }

        }
        else{
            echo "<script>alert('You entered the wrong code please enter right code')</script>";
        }

    }
}

?>  




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Arrow Outsourcing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body>

    <nav class="navbar bg-light">
        <div class="container overflow-auto">
            <a class="navbar-brand" href="../index.php">
            <img src="logo.jpg" alt="Logo" width="30rem" height="24"> <b>Arrow Outsourcing</b>
            </a>
   
        </div>
    </nav>
    <form class=" text-center" method="POST">
        <button type="submit" name="resendOTP" class="btn btn-primary m-2">Resend code</button>
    </form>
    <form method = "POST">
        <h4 class="text-center">We sent an email containing a verification code please enter the code below.</h4>
            <div class="m-5 card mx-auto border-1" style="width: 40rem;">
                <div class="card-body">
                    <div class = "card-title">
                        <h5 class = "text-center">Verify your email</h5>                        
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email</label>
                        <input type="email" class="form-control" id="email"  name="email" value = "<?php echo $email; ?>" disabled required>
                    </div>

                    <div class="mb-3">
                        <label for="OTP" class="form-label">Enter verification PIN sent to your email</label>
                        <input type="text" class="form-control" id="OTP"  name="OTP" required>
                    </div>

                    <div class="mb-3">
                        <label for="password1" class="form-label">Set Password (<i>must be more than 5 characters</i>)</label>
                        <input type="password" class="form-control" id="password1"  name="password1" required>
                    </div>

                    <div class="mb-3">
                        <label for="password2" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password2" name="password2" required>
                        <p class="text-danger"><?php echo $passwordErr ?></p>
                    </div>

                </div>
            </div>

                        <div class="card border-0" style="height: 4rem;">
                <div class="d-flex justify-content-center m-2">
                                <!-- Clear and Register button -->
                        <a class="btn btn-secondary" href="empty.php">Back</a>            
                        <button type="Reset" class="btn btn-danger mt-1 mb-1 m-3">Clear</button>
                        <button type="Submit" class="btn btn-primary mt-1 mb-1 m-3" data-bs-dismiss="modal" name="continue">Continue</button>  
                </div>
            </div>
    </form>

<!-- Footer section begins -->

<app-footer></app-footer>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

    <script src="../components.js"></script>
  </body>
</html>