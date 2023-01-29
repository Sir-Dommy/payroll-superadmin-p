<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
USE PHPMailer\PHPMailer\Exception;

$OTP = subStr(session_id(),0,6);

    $log_filename = "arrow.log";
    $companyPhoneNumberErr = "";
    $companyPhoneNumber = "";
    $companyName = "";
    $companyWebsite = "";
    $companyNumber = "";
    $email = "";

    $mysqli = new mysqli('localhost', 'root', '', 'outsourcing');
    $log_time = date('Y-m-d h:i:sa');
    if(mysqli_errno($mysqli)){
        error_log("[ERROR: " . date("Y-m-d H:i:s") . "] Connect "
        . "failed: " . mysqli_connect_error() . "\n", 3, $log_filename);
    }

    else{
        if(ISSET($_POST['register'])){

            $_SESSION['email']=$email= $_POST['companyEmail'];
            $companyNumber = $_POST['companyNumber'];
            $companyPhoneNumber = $_POST['companyPhoneNumber'];

            // echo $email."\n";
            $companyName = $_POST['companyName'];
            $companyName = mysqli_real_escape_string($mysqli, $companyName);
            $companyWebsite = $_POST['companyWebsite'];
            $companyWebsite = mysqli_real_escape_string($mysqli, $companyWebsite);

            $email1 = $email; //for sendin email $email1
            $email = mysqli_real_escape_string($mysqli, "$email");

            $name1 = mysqli_real_escape_string($mysqli, $companyName);
            $sql= "SELECT * FROM allCompanies WHERE companyName = '$companyName' ";
       
            $res = mysqli_fetch_array(mysqli_query($mysqli, $sql));

            if(mysqli_num_rows(mysqli_query($mysqli, $sql)) > 0){
                
                $sql1 = "SELECT * FROM companyDetails WHERE companyEmail = '$email' OR companyName = '$name1' OR companyPhoneNumber = '$companyPhoneNumber'";
                if(mysqli_num_rows(mysqli_query($mysqli, $sql1))>0){
                    echo "<script>alert('Failed!!! Company with matching details already exists!!!')</script>";
                }
                else{
                    if((substr($companyPhoneNumber,0,2) != '07' && (substr($phoneNumber,0,2) != '01')) || (strlen($companyPhoneNumber) != 10) ){
                        $companyPhoneNumberErr = "Enter a valid phone number";
                        echo "<script>alert('Failed!!! please enter valid details')</script>";
        
                    }
                    else{
                        $sql2 = "INSERT INTO companyDetails SET 
                        companyName = '$companyName',
                        companyPhoneNumber = '$companyPhoneNumber',
                        companyEmail = '$email',
                        companyWebsite = '$companyWebsite',
                        OTP = '$OTP',
                        statusDate = '$log_time'
                        ";
    
                        if(mysqli_query($mysqli, $sql2)){


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
                            header('location: verifyEmail.php');
                            exit();
                        }
                    }
                }

            }

            else{
                echo "<script>alert('Failed!!! Seems like your company does not exist!!!')</script>";  
            }
            
        }
    }

    // code for login functionality
    if(isset($_POST['login'])){
        $_SESSION['email']=$emailL = $_POST['companyEmailL'];
        $password = $_POST['password'];

        $sqlLogin= "SELECT * FROM companydetails WHERE companyEmail= '$emailL' AND password='$password' AND status = 'Verified'";
        $resLogin = mysqli_fetch_array(mysqli_query($mysqli, $sqlLogin));

        if($resLogin){
            $row = mysqli_fetch_row(mysqli_query($mysqli, $sqlLogin));
            $_SESSION['companyPhone'] = $row[1];
            header('location: companyHomePage.php');
            exit();
        }
        else{
            echo "<script> alert('Invalid Login Please Retry!!!'); </script>";
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <title>Company Registration</title>
</head>
<body>
    
    <nav class="navbar bg-light">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <img src="logo.jpg" alt="Logo" width="30rem" height="24"> <b>Arrow Outsourcing</b>
            </a>
   <!-- Button to trigger applicant login pop up page -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#login">
                Login
            </button>
        </div>
    </nav>


    <!-- Registration form -->
    <form action="" method="POST" enctype="multipart/form-data">

    <!-- Two cards having registration form -->
    <div class="allHomeCards">
            <div class="row m-1">
                <!-- <div class="col-lg-1"> -->
                    <div class="card m-2 border-0" style="width: 20rem;">
                                        
                    </div>


                    <div class="card m-2 border-1" style="width: 40rem;">
                        <div class="card-body">

                            <div class="mb-3">
                                <label for="companyName" class="form-label">Company name</label>
                                <input type="name" class="form-control" id="companyName" name="companyName" value="<?php echo $companyName ?>" required>
                                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                            </div>

                            <div class="mb-3">
                                <label for="companyNumber" class="form-label">Company Number</label>
                                <input type="text" class="form-control" id="companyNumber" name="companyNumber" value="<?php echo $companyNumber ?>" required>
                                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                            </div>

                            <div class="mb-3">
                                <label for="companyPhoneNumber" class="form-label">Company Phone Number (in form -->0700221133)</label>
                                <input type="number" class="form-control" id="companyPhoneNumber" name="companyPhoneNumber" value="<?php echo $companyPhoneNumber ?>"  required>
                                <p class="text-danger"> <?php echo $companyPhoneNumberErr; ?></p> 
                            </div>
                            
                            <div class="mb-3">
                                <label for="companyEmail" class="form-label">Company Email address</label>
                                <input type="email" class="form-control" id="companyEmail" name="companyEmail" aria-describedby="emailHelp" value="<?php echo $email ?>"  required>
                                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                            </div>

                            <div class="mb-3">
                                <label for="companyWebsite" class="form-label">Enter company website (<i>Optional</i>)</label>
                                <input type="url" class="form-control" id="companyWebsite" name="companyWebsite" aria-describedby="emailHelp" value="<?php echo $companyWebsite ?>" >
                                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                            </div>
                           
                        </div>

                        <div class="card border-0">
                            <div class="d-flex justify-content-center">
                                            <!-- Clear and Register button -->
                                <button type="Button" class="btn btn-danger m-2">Clear</button>
                                <button type="Submit" class="btn btn-primary m-2" data-bs-dismiss="modal" name="register">Register</button>  
                            </div>
                        </div>
                                        
                    </div>


                    <!-- </div> -->
            </div>


        </div>
 



  

    </form>


<!-- Code for the login popup page -->
<div class="modal" tabindex="-1" id="login">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<!-- Login form -->
        <form action="" method="POST">
            <div class="mb-3">
                <label for="companyEmailL" class="form-label">Company Email address</label>
                <input type="email" class="form-control" name="companyEmailL" id="companyEmailL" aria-describedby="emailHelp" required>
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>

            <div class="mb-3">
                <p>
                    <i>Forgot password? <a href="empty.php">click here</a></i> 
               </p>  
            </div>

            <button type="Submit" class="btn btn-primary" name="login">login</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Register</button>    

        </form>

      </div>
      <div class="modal-footer">
            <p class="text-success mr-1"><i>Lets keep work moving...</i></p>
      </div>
    </div>
  </div>
</div>


 <!-- Footer section begins -->
<app-footer></app-footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<script src="..\\components.js"></script>



</body>
</html>
