<?php
session_start();

$log_filename = "arrow.log";

$email = $_SESSION['email'];

$firstNameErr = $lastNameErr = $phoneNumberErr = "";

$mysqli = new mysqli('localhost', 'root', '', 'outsourcing');
$log_time = date('Y-m-d h:i:sa');
if(mysqli_errno($mysqli)){
    // error_log("[ERROR: " . date("Y-m-d H:i:s") . "] Connect "
    // . "failed: " . mysqli_connect_error() . "\n", 3, $log_filename);
}

else{

    $sql1 = "SELECT * FROM applicantdetails WHERE applicantEmail = '$email'; ";

    $rows = mysqli_fetch_row(mysqli_query($mysqli, $sql1));

    if(ISSET($_POST['submit'])){
          
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $phoneNumber = $_POST['phoneNumber'];
        $availability = $_POST['availability'];
        $applicantEmail = $_POST['applicantEmail'];

        // echo $applicantEmail = $_POST['applicantEmail'];


        $email=$_POST['applicantEmail'];
        $email2=$_POST['applicantEmail']; //for use as value in registration form

        $email =  mysqli_real_escape_string($mysqli, "$email");
        $firstName =  mysqli_real_escape_string($mysqli, "$firstName");
        $lastName =  mysqli_real_escape_string($mysqli, "$lastName");
        $applicantEmail =  mysqli_real_escape_string($mysqli, "$applicantEmail");

        // echo $email."\n";

        if((!preg_match("/^[a-zA-Z ]*$/",$firstName)) || (!preg_match("/^[a-zA-Z ]*$/",$lastName)) || (strlen($phoneNumber)>10) || (strlen($phoneNumber)<10)){
            echo "<script>alert('Enter correct details')</script>";
            if(!preg_match("/^[a-zA-Z ]*$/",$firstName)){
                $firstNameErr = "Enter a valid name";
            }
            if(!preg_match("/^[a-zA-Z ]*$/",$lastName)){
                $lastNameErr = "Enter a valid name";
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
            if((strlen($phoneNumber)<10)){
                $phoneNumberErr = "Phone number must be 10 digits";    
            }
        }

        $phone1 = "0".$rows[2];
        $email1 = $_SESSION['email'];
        // if(($phoneNumber != $phone1)){
        //     $sql1 = "SELECT * FROM applicantdetails WHERE phoneNumber = '$phoneNumber'";
   
        //     $res1 = mysqli_fetch_array(mysqli_query($mysqli, $sql1));
        //     if($res1){
        //         echo "<script>alert('User with matching details already exists!!!')</script>";
        //     }

        // }
        if(($_POST['applicantEmail'] != $rows[5])){
            $sql2= "SELECT * FROM applicantdetails WHERE applicantEmail = '$applicantEmail'";
   
            $res2 = mysqli_fetch_array(mysqli_query($mysqli, $sql2));
            if($res2){
                echo "<script>alert('User with matching details already exists!!!')</script>";
            }

            else{
            // echo $email1;
            // echo $applicantEmail;

                $sql2 = "UPDATE applicantdetails SET 
                firstName = '$firstName',
                lastName = '$lastName',
                phoneNumber = '$phoneNumber',
                availability = '$availability',
                applicantEmail = '$applicantEmail'
                WHERE applicantEmail = '$email1'
                ";  
    
                if(mysqli_query($mysqli, $sql2)){
                    $_SESSION['username'] = $firstName;
                    $_SESSION['email']=$applicantEmail;
    
                    echo "<script>alert('Details Updated Successfully, reload to see changes')</script>";
    
    
                }
                else{
                    echo "<script>alert('An error occurred please retry!!!')</script>";
                }
            }
        }

        
    }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Applicant Jobs page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body>
    <form action="" method = "POST">

        <nav class="navbar bg-light">
            <div class="container mb-2">
                <a class="navbar-brand" href="../index.php">
                    <img src="logo.jpg" alt="Logo" width="30rem" height="24"> <b>Arrow Outsourcing</b>
                </a>
            </div>
        </nav>

        <app-applicantnav></app-applicantnav>

        <div class="row">

            <div class="card m-2 border-1 overflow-auto">
                <div class="card-body">
                    <div class="text-center fs-4">
                        <button class="btn btn-primary" id = 'edit'>
                            Edit &nbsp;
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                            </svg>
                        </button>
                    </div>

                    <fieldset disabled id = "disabledCard1">

                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" value = <?php echo $rows[0] ?> required>
                        <p class="text-danger"><?php echo $firstNameErr ?></p>
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>

                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" value = <?php echo $rows[1] ?> required>
                        <p class="text-danger"><?php echo $lastNameErr?></p>
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>

                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value = 0<?php echo $rows[2] ?> required>
                        <p class="text-danger"><?php echo $phoneNumberErr ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="availability" class="form-label">Availability</label>
                            <select class="form-select" id="availability" name="availability" aria-label="Default select example" value = <?php echo $rows[6] ?> required>
                                <option selected> <?php echo $rows[4] ?> </option>
                                <option value="Available all time">Available all time</option>
                                <option value="Partly available">Partly available</option>
                                <option value="Engaged">Engaged</option>
                            </select>
                    </div>
                        

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name = "applicantEmail" aria-describedby="emailHelp" value = <?php echo $rows[5] ?> required>
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>

                    
                    
                </div>
                                
            </div>
            <!-- </div> -->

            <!-- Second card-->
            <div class="card m-2 border-1 overflow-auto">
                <div class="card-body">

            <fieldset disabled id = "disabledCard2">
                    <!-- Select availability -->
                    <div class="mb-3">
                        <label for="score" class="form-label"><b> Your Score:</b></label><br>
                         <?php echo $rows[10]."/59" ?> 
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>

                                        <!-- Select availability -->
                    <div class="mb-3">
                        <label for="id" class="form-label"><b> National ID Number:</b></label><br>
                         <?php echo $rows[3] ?> 
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>

                    <div class="mb-3">
                        <label for="skills" class="form-label"><b>Your Skills:</b></label><br>
                        <?php echo $rows[11]?>
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>

                    <div class="mb-3">
                        <label for="level" class="form-label"><b> Your level:</b></label><br>
                        <?php echo $rows[13] ?>  
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>

                </div>
            </div>

            <fieldset disabled id = "disabledCard3">
            <div class="card border-0">
                <div class="d-flex justify-content-center">

                                <!-- Save changes button -->
                    <button type="Reset" class="btn btn-danger m-3" data-bs-dismiss="modal">Reset</button>  
                    <button type="Submit" name = "submit" class="btn btn-primary m-3" data-bs-dismiss="modal">Update</button>  
                </div>
            </div>


        </div>
                <!-- </div> -->

        </fieldset>
    </form>
    <app-footer></app-footer>

    <script>
        document.getElementById('edit').onclick = () =>{
            document.getElementById('disabledCard1').disabled = false;
            document.getElementById('disabledCard3').disabled = false;

            document.getElementById('edit').disabled = true;
        }
    </script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<script src="..\\components.js"></script>  </body>
<script src="applicant.js"></script> 

</html>