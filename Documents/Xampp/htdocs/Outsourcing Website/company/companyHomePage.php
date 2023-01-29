
<?php

session_start();

$_SESSION['email'];

$mysqli = new mysqli('localhost', 'root', '', 'outsourcing');

$email = mysqli_real_escape_string($mysqli, $_SESSION['email']);

$sql = "SELECT * FROM companydetails WHERE companyEmail = '$email'";
$row = mysqli_fetch_row(mysqli_query($mysqli,$sql));

$_SESSION['companyName'] = $row[0];

foreach ($_POST as $key => $value){
    if(substr($key,0,4)=='view'){
        $_SESSION['jobId'] = substr($key,4);
        header('location: viewApplicantsPage.php');
        exit();
    }
    else if(substr($key,0,4)=='dele'){
        $jobId = substr($key,4);

        $sql2 = "UPDATE jobdetails SET
        status = 'Deleted'
        WHERE jobId = '$jobId'
        ";
        if(mysqli_query($mysqli, $sql2)){
            echo "<script> alert('Job removed successfully!!!'); </script>";

        }
        else{
            echo "<script> alert('An error occurred, Please Retry!!!'); </script>";
        }
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Company HomePage</title>
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

    <app-companynav></app-companynav>

    <!-- <div class="card border-1 bg-dark">
        <div class="card-body d-flex overflow-auto">

            <div> <a href="companyHomePage.php" class="btn fs-4 btn-dark text-light">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                    <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                </svg> Home  </a>
            </div>

            <div> <a href="companyProfilePage.php" class="btn fs-4 btn-dark text-light">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-person-fill" viewBox="0 0 16 16">
                    <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-1 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm-3 4c2.623 0 4.146.826 5 1.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-1.245C3.854 11.825 5.377 11 8 11z"/>
                </svg> Profile  </a>
            </div>

            <div> <a href="jobAlloHistory.php" class="btn fs-4 btn-dark text-light">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                    <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                    <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                    <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                </svg> History  </a>
            </div>

            <div> <a href="createJobPage.php" class="btn fs-4 btn-dark text-light">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-workspace" viewBox="0 0 16 16">
                        <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                        <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z"/>
                </svg> Create a Job  </a>
            </div>

            <div> <a href="ratingRequestsPage.php" class="btn fs-4 btn-dark text-light">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
                    <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
                </svg> Reported Issues </a>
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


    <!-- Jobs issues section (card) -->
    <div class="card m-2 border-1">
        <div class="card-body">

        <h3 class='text-success'>Hello <?php echo $row[0] ?>!</h3>

            <div class="text-center">
                <h4 class='text-center mt-1'>These are the jobs you have not given out (Oldest jobs appear first)</h4>
                <a href="createJobPage.php" class="btn btn-primary mt-3">Create new job</a>
            </div>
            <!-- Jobs Issued -->


            <?php
                    $sql2 = "SELECT * FROM jobDetails WHERE status='Active' AND companyEmail = '$email' ORDER BY jobId ASC;"; 
                    $jobId=2;

                    if(mysqli_query($mysqli, $sql2)){

                        $res = mysqli_query($mysqli, $sql2);

                        if(mysqli_num_rows($res)<1){
                            echo "<div class='card m-4 border-1 overflow-auto'>
                            <div class='card-body overflow-auto' style='width: 422px;'>
        
                                <p class = 'text-danger text-center'> No Jobs yet!!! </p>

                                <a href = 'createJobPage.php' class = 'btn btn-primary text-center'>Create Job</a>
                            </div>
                    </div>";
                        }

                        echo "<br>";
                        while($rows = mysqli_fetch_row($res)){
                            $jobId = $rows[0];
                            $jobTitle = $rows[1];


                        echo 
            "<form method='POST'>
            <div class='card m-4 border-1 overflow-auto'>
                    <div class='card-body overflow-auto'>

                        <p>
                            <b>Job ID: </b>".$rows[0]." <br>
                            <b>Job Type: </b>". $rows[2] ."<br>
                            <b>Job Description: </b> ".$rows[3] ." <br>
                            <b>Amount to be paid: </b>".$rows[4]."<br>
                            <b>Deadline: </b> ". $rows[5] ." <br>
                            <b>Skills needed: </b> ". $rows[6] ." <br>
                            <b>Level: </b> ". $rows[7] ." <br>

                            <b>View Applicabts for this job</b><button class='btn btn-primary m-2 mb-1 mt-2' name='view$jobId' id='viewApplicants'>View Fitting Applicants</button> <br>


                            <button class='btn btn-danger' name='dele$jobId'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3-fill' viewBox='0 0 16 16'>
                                    <path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z'/>
                                </svg> Delete
                            </button> <br>
                        
                        </p>
                    </div>
            </div> 
            </form>";
                            echo "<br>";
                        }


                    }
                    else{
                        echo "Sorry an error occurred";
                    }

                ?>


                
        </div>

    </div>

    <app-footer></app-footer>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<script>
    var deleteJob = new bootstrap.Modal(document.getElementById("deleteJob"), {});                     
</script>

<script src="..\\components.js"></script>  </body>
<script src="new.js"></script>

</html>

