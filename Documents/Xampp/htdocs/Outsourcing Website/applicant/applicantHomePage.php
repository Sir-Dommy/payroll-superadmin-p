<?php

session_start();
// $_SESSION['email'];
date_default_timezone_set('Africa/nairobi');

$email = $_SESSION['email'];

$mysqli = new mysqli('localhost', 'root', '', 'outsourcing');
$log_time = date('Y-m-d h:i:sa');
if(mysqli_errno($mysqli)){
    error_log("[ERROR: " . date("Y-m-d H:i:s") . "] Connect "
    . "failed: " . mysqli_connect_error() . "\n", 3, $log_filename);
}

else{
    $email1 = mysqli_real_escape_string($mysqli, $email);

    if(isset($_POST['startTasks'])){
        $sql = "SELECT * FROM tasks WHERE applicantEmail = '$email1'";

        if(mysqli_num_rows(mysqli_query($mysqli, $sql))>0){
            echo "<script>alert('You have already submitted your responses')</script>";
            
        }
        else{
            $sql = "INSERT INTO tasks SET applicantEmail = '$email1', taskNumber = '0'";
            mysqli_query($mysqli, $sql);

            $sql3 = "UPDATE applicantDetails SET score = '0', skills = '', level = 'Beginner', skillsCount = '0' WHERE applicantEmail = '$email1'";

            mysqli_query($mysqli, $sql3);

            $_SESSION['duration'] = 1;
            $_SESSION['stime'] = date('Y-m-d H:i:s');
    
            // $_SESSION['endtime'] = $endTime = date('Y-m-d H:i:s', strtotime('+'.$_SESSION['duration'].'minutes', strtotime($_SESSION['stime'])));
    
            $_SESSION['endtime'] = $endTime = date('Y-m-d H:i:s', 30*60 +  strtotime($_SESSION['stime']));
    
            header('location: applicantTasks.php');
            exit();
        }

    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Applicant page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body>

    <nav class="navbar bg-light">
        <div class="container mb-2">
            <a class="navbar-brand" href="../index.php">
                <img src="logo.jpg" alt="Logo" width="30rem" height="24"> <b>Arrow Outsourcing</b>
            </a>
        </div>
    </nav>

    <app-applicantnav></app-applicantnav>

<!-- Commented out user Navbar -->
            <!-- <div class="card border-1 bg-dark">
                <div class="card-body d-inline-flex p-auto overflow-auto">

                    <div> <a href="applicantHomePage.php" class="btn fs-4 btn-dark text-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                        </svg> Home  </a>
                    </div>

                    <div> <a href="applicantProfilePage.php" class="btn fs-4 btn-dark text-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-person-fill" viewBox="0 0 16 16">
                            <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-1 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm-3 4c2.623 0 4.146.826 5 1.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-1.245C3.854 11.825 5.377 11 8 11z"/>
                        </svg> Profile  </a>
                    </div>

                    <div> <a href="applicantHistoryPage.php" class="btn fs-4 btn-dark text-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                            <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                            <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                            <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                        </svg> History  </a>
                    </div>

                    <div> <a href="applicantJobsPage.php" class="btn fs-4 btn-dark text-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-workspace" viewBox="0 0 16 16">
                                <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                                <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z"/>
                        </svg> All Jobs  </a>
                    </div>

                    <form method="POST">
                        <div class="btn fs-4 btn-dark text-light" id="logOut" name = "logOut">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                                <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                            </svg> Log Out
                        </div>
                    </form>


                </div>
            </div> -->


    <!-- <div class="col-lg-1"> -->
    <div class="card m-2 border-1">
        <div class="card-body">
            <h5 class="card-title text-success text-center">Welcome  </h5>

            <div class="row fs-5 d-flex justify-content-center">
            <p class ="text-center" id="tops5">Below are the steps of getting a job in our website </p>
                <div class="card m-3 border-1" style="width: 13rem;" id="tops1">
                    <div class="card-body">
                        <h5 class="card-title text-light text-center bg-success rounded-circle">1</h5>
                        <p>
                            Ensure entry of all required information during registration
                        </p>
                    </div>
                </div>
                
                <div class="card m-3 border-1" style="width: 13rem;" id="tops2">
                    <div class="card-body">
                        <h5 class="card-title text-light text-center bg-success rounded-circle">2</h5>
                        <p>
                            Complete the tasks below using standard programming practice
                        </p>
                    </div>
                </div>
                
                <div class="card m-3 border-1" style="width: 13rem;" id="tops3">
                    <div class="card-body">
                        <h5 class="card-title text-light text-center bg-success rounded-circle">3</h5>
                        <p>
                            Your expertise will be gauged and shared with employers
                        </p>
                    </div>
                </div>
            
                <div class="card m-3 border-1" style="width: 13rem;" id="tops4">
                    <div class="card-body">
                        <h5 class="card-title text-light text-center bg-success rounded-circle">4</h5>
                        <p>
                            Employers will pick you if you meet their minimum requirements
                        </p>
                    </div>
                </div>

            </div>                  

            <h3 class="text-center">Press the button below to begin tasks</h3>
            <div class="text-center">
                <p class="fs-4"> Remember you have only thirty minutes to complete the tasks, once you press the button the count down starts</p> 
                <p class="text-danger fs-4">Note you cannot get a job unless you complete these tasks!!!</p>
            </div>
 
            <div class="text-center">
                <form action="" method = "POST">
                    <button type="Submit" name = "startTasks" class="btn btn-primary m-1" data-bs-dismiss="modal">Start Tasks</button>  
                </form>
            </div>

        </div>

    </div>

<app-footer></app-footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

        <script src="applicant.js"></script>
        <script src="../components.js"></script> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    </body>
</html>
