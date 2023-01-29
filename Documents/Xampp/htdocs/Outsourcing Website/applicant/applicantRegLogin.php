<?php
 session_start();

 use PHPMailer\PHPMailer\PHPMailer;
 USE PHPMailer\PHPMailer\Exception;

 $OTP = substr(session_id(),0,6);

 $firstNameErr = $availability = $firstName = $phoneNumberErr = $phoneNumber = $lastNameErr = $lastName = $email = $passwordErr = $email2 = $identityNumber = $identityNumberErr = $emailErr = "";

    $log_filename = "arrow.log";

    $mysqli = new mysqli('localhost', 'root', '', 'outsourcing');
    $time = date('Y-m-d h:i:sa');
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(mysqli_errno($mysqli)){
            // error_log("[ERROR: " . date("Y-m-d H:i:s") . "] Connect "
            // . "failed: " . mysqli_connect_error() . "\n", 3, $log_filename);
        }
    
        else{
            if(ISSET($_POST['continue'])){
    
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $phoneNumber = $_POST['phoneNumber'];
                $identityNumber = $_POST['identityNumber'];
                $availability = $_POST['availability'];
                $applicantEmail = $_POST['applicantEmail'];

    
                $email=$_POST['applicantEmail'];
                $email2=$_POST['applicantEmail']; //for use as value in registration form
    
                $email =  mysqli_real_escape_string($mysqli, "$email");
                $firstName =  mysqli_real_escape_string($mysqli, "$firstName");
                $lastName =  mysqli_real_escape_string($mysqli, "$lastName");
                $applicantEmail =  mysqli_real_escape_string($mysqli, "$applicantEmail");
        
                // echo $email."\n";
                $sql= "SELECT * FROM applicantdetails WHERE applicantEmail= '$email' OR phoneNumber = '$phoneNumber' OR identityNumber = '$identityNumber'";
           
                $res = mysqli_fetch_array(mysqli_query($mysqli, $sql));
    
                if((!preg_match("/^[a-zA-Z ]*$/",$firstName)) || strlen($firstName) >19  || strlen($email) >29|| (!preg_match("/^[a-zA-Z ]*$/",$lastName))|| strlen($lastName) >19 || (strlen($phoneNumber)>10) || (strlen($phoneNumber)<10) && ((substr($phoneNumber,0,2) != '07')  || (substr($phoneNumber,0,2) != '01')) || (strlen($identityNumber) != 8) || ($identityNumber)<10000000){
                    echo "<script>alert('Enter correct details')</script>";
                    if(!preg_match("/^[a-zA-Z ]*$/",$firstName)){
                        $firstNameErr = "Enter a valid name";
                    }
                    if(!preg_match("/^[a-zA-Z ]*$/",$lastName)){
                        $lastNameErr = "Enter a valid name";
                    }
                    if(strlen($firstName) >19){
                        $firstNameErr = "Firstname should not be longer than 19 characters";
                    }
                    if(strlen($lastName) >19){
                        $lastNameErr = "Lastname should not be longer than 19 characters";
                    }
                    if(strlen($email) >29){
                        $emailErr = "Email should not be longer than 29 characters";
                    }
                    
                    if(strlen($phoneNumber)>10){
                        $phoneNumberErr = "Phone number must be 10 digits";
                    }
                    if((substr($phoneNumber,0,2) != '07')){
                        if((substr($phoneNumber,0,2) != '01')){
                            $phoneNumberErr = "Phone number must start with '07' or '01'";    
                        }                    }
                    if((substr($phoneNumber,0,2) != '01')){
                        if((substr($phoneNumber,0,2) != '07')){
                            $phoneNumberErr = "Phone number must start with '07' or '01'";    
                        }                    }
                    if((strlen($identityNumber)>8) || (strlen($identityNumber)<10000000)){
                        $identityNumberErr = "Enter a valid Identity Number";
                    }
                    if((strlen($phoneNumber)<10)){
                        $phoneNumberErr = "Phone number must be 10 digits";    
                    }
                }
    
                else if($res){
                    $res1 = mysqli_query($mysqli, $sql);
                    $rows = mysqli_fetch_row($res1);
                    if($rows[8] == "Registered"){
                        $_SESSION['email'] = $_POST['applicantEmail'];
                        header('location: verifyEmail.php');
                        exit();
                    }
                    else{
                        echo "<script>alert('User with matching details already exists!!!')</script>";
                    }
                }
                else{
    
                    
                    // $name = $_FILES['file']['name'];
                    // $target_dir = "resumes/";
                    // $target_file = $target_dir.$name ;
                    // $tempfile = $_FILES['file']['tmp_name'];
                    //     if(move_uploaded_file($tempfile,$target_file)){
                    //       echo "Resume saved";
                    //     }
                    //     else{
                    //         echo "Failed to save resume please retry";
                    //     }
                    //     $uploadResume = $target_file;
    
                        // $language = $_POST['java'].",".$_POST['PHP'].",".$_POST['Golang'].",".$_POST['Ruby'].",".$_POST['python'].",".$_POST['javascript'].",".$_POST['SQL'].",".$_POST['C++'].",".$_POST['CSS'].",".$_POST['NodeJs'].",".$_POST['C#'];
    
                    // echo $language;
    
                    $sql2 = "INSERT INTO applicantdetails SET 
                    firstName = '$firstName',
                    lastName = '$lastName',
                    phoneNumber = '$phoneNumber',
                    identityNumber = '$identityNumber',
                    availability = '$availability',
                    applicantEmail = '$applicantEmail',
                    status = 'Registered',
                    OTP = '$OTP',
                    statusDate = '$time'
                    ";  
    
                    if(mysqli_query($mysqli, $sql2)){
                        $_SESSION['username'] = $firstName;
                        $_SESSION['email']=$email;


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

                        $email -> addAddress($email2);
                        $email -> isHTML(true);

                        $email -> Subject = 'Verification Email';
                        $email -> Body = 'Your OTP is: '.$OTP;

                        $email -> send();
        
                        header('location: verifyEmail.php');
                        exit();
    
                    }
                    else{
                        echo "Sorry an error occurred";
                    }
                }
            }
        
    
            // code for login functionality
            if(isset($_POST['login'])){
                $emailL = $_POST['emailL'];
    
                $emailL =  mysqli_real_escape_string($mysqli, "$emailL");
    
                $passwordL = $_POST['passwordL'];
    
                $_SESSION['email']=$emailL;
    
                $sqlLogin= "SELECT * FROM applicantdetails WHERE applicantEmail= '$emailL' AND password='$passwordL' AND status = 'Verified'";
                $resLogin = mysqli_fetch_array(mysqli_query($mysqli, $sqlLogin));
    
                $res = mysqli_query($mysqli, $sqlLogin);
                while($rows = mysqli_fetch_row($res)){
                    $_SESSION['username'] = $rows[0];
                }
    
                if($resLogin){
    
                    header('location: applicantHomePage.php');
                    exit();
                }
                else{
                    echo "<script> alert('Invalid Login Please Retry!!!'); </script>";
                }
    
            }
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

    <title>Applicant Registration</title>
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
                    <div class="card border-1 mx-auto" style="width: 40rem;">
                        <div class="card-body">
                            <div class="text-center fs-4">
                                <p>PART A</p>
                            </div>
                            <div class="mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="name" class="form-control" id="firstName" name="firstName" value= "<?php echo $firstName ?>" required>
                                <p class="text-danger"><?php echo $firstNameErr ?></p>
                                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                            </div>

                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="name" class="form-control" id="lastName" name="lastName" value= "<?php echo "$lastName" ?>" required>
                                <p class="text-danger"><?php echo $lastNameErr ?></p>
                            </div>

                            <div class="mb-3">
                                <label for="phoneNumber" class="form-label">Phone Number (in the form --> 0700442266)</label>
                                <input type="number" class="form-control" id="phoneNumber" name="phoneNumber" value= "<?php echo "$phoneNumber" ?>"  required>
                                <p class="text-danger"><?php echo $phoneNumberErr ?></p>
                            </div>
                           
                        </div>
                                        
                    </div>
                    <!-- </div> -->

                    <!-- Second card-->
                    <div class="card mx-auto border-1" style="width: 40rem;">
                        <div class="card-body">
                            <div class="text-center fs-4">
                                <p>PART B</p>
                            </div>

                            <!-- Enter ID number -->
                            <div class="mb-3">
                                <label for="identityNumber" class="form-label">Identity Number</label>
                                <input type="number" class="form-control" id="identityNumber" name="identityNumber" value= "<?php echo "$identityNumber" ?>"  required>
                                <p class="text-danger"><?php echo $identityNumberErr ?></p>
                            </div>

                            <!-- Select availability -->
                            <div class="mb-3">
                                <label for="availability" class="form-label">Availability</label>
                                    <select class="form-select" id="availability" name="availability" aria-label="Default select example" required>
                                        <option selected> <?php echo $availability ?> </option>
                                        <option value="Available all time">Available all time</option>
                                        <option value="Partly available">Partly available</option>
                                        <option value="Engaged">Engaged</option>
                                    </select>
                            </div>

                            <div class="mb-3">
                                <label for="applicantEmail" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="applicantEmail" name="applicantEmail" aria-describedby="emailHelp" value= "<?php echo $email2 ?>"   required>
                                <p class="text-danger"><?php echo $emailErr ?></p>
                                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                <label class="form-check-label" for="exampleCheck1">By registering you agree to <a href="http://" target="_blank" rel="noopener noreferrer">terms and conditions</a></label>
                            </div>
                        </div>
                    </div>
                    <!-- </div> -->
            </div>
        </div>

        <div class="card border-0" style="height: 4rem;">
            <div class="d-flex justify-content-center">
                            <!-- Clear and Register button -->
                    <button type="Reset" class="btn btn-danger mt-1 mb-1 m-3">Clear</button>
                    <button type="Submit" class="btn btn-primary mt-1 mb-1 m-3" data-bs-dismiss="modal" name="continue">Continue</button>  
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
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" name="emailL" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="passwordL" id="exampleInputPassword1" required>
            </div>

            <div class="mb-3">
                <p>
                    <i>Forgot password? <a href="empty.php">click here</a></i> 
               </p>  
            </div>

            <!-- <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Keep you logged in?</label>
            </div> -->

            <div class="text-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Register</button> 
                <button type="Submit" class="btn btn-primary" name="login">login</button>
            </div>
            
        </form>

      </div>
      <div class="modal-footer">
            <p class="text-success mr-1"><i>With you in every step of your career</i></p>
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
