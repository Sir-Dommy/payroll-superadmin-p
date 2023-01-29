<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
USE PHPMailer\PHPMailer\Exception;

$applicantEmail = $_SESSION['email'];
$jobId = $_SESSION['jobId'];
$companyEmail = "";

$mysqli = new mysqli('localhost', 'root', '', 'outsourcing');

$emailc = mysqli_real_escape_string($mysqli, $applicantEmail);
$sql0 = "SELECT * FROM revokes WHERE applicantEmail = '$emailc' ";

$revokesCount = mysqli_num_rows(mysqli_query($mysqli, $sql0));

$sql = "SELECT * FROM jobapplications WHERE jobId = '$jobId' AND applicantEmail = '$emailc'";

$rows = mysqli_fetch_row(mysqli_query($mysqli, $sql));

$companyEmailEmail = mysqli_real_escape_string($mysqli, $rows[1]);

?>

<?php
if(isset($_POST['revoke'])){
    if (strlen($_POST['reason']) > 100){

        $sql = "SELECT * FROM revokes WHERE jobId = '$jobId'";

        if(mysqli_num_rows(mysqli_query($mysqli, $sql))>0){
            echo "<script> alert('Job already revoked'); </script>";

        }
        else{
            $revokeReason = mysqli_real_escape_string($mysqli, $_POST['reason']);
            $sql = "INSERT INTO revokes SET 
            jobId ='$jobId',
            companyEmail = 'companyEmail',
            applicantEmail = '$emailc',
            revokeReason = '$revokeReason'
            ";

            $sql2 = "UPDATE jobdetails SET status = 'Active' WHERE jobId = '$jobId'";

            $sql3 = "DELETE FROM jobapplications WHERE jobId = '$jobId'";

            if (mysqli_query($mysqli, $sql) && mysqli_query($mysqli, $sql2) && mysqli_query($mysqli, $sql3)){
                echo "<script> alert('An email will be send to company explaining the termination.'); </script>";

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

                $email -> addAddress($rows[1]);
                $email -> isHTML(true);

                $email -> Subject = 'Verification Email';
                $email -> Body = 'The Job ID '.$jobId.' Has been revoked by the applicant due to this reason: <br>'.$revokeReason;

                $email -> send();

                $sql0 = "SELECT * FROM revokes WHERE applicantEmail = '$emailc' ";

                $revokesCount = mysqli_num_rows(mysqli_query($mysqli, $sql0));
                if($revokesCount > 5){
                    $sql = "UPDATE applicantdetails SET status = 'Blocked' WHERE applicantEmail = '$emailc'";
                    header('location: ../index.php');
                    exit();

                }
            }
        }

    }

else{
  echo "<script> alert('Reason for revoke must have more than 100 characters'); </script>";

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

    <!-- Create Job> -->
    <div class="card m-2 border-1">
        <div class="card-body">

        <div>
            <h2 class="bg-warning float-end">Current Revokes: <?php echo $revokesCount ?> &nbsp;&nbsp;</h2> <br>

            <h3 class="text-danger text-center">If you revoke more than five jobs you will be barred from using our system!!!</h3>

        </div>
            

        <div class="text-center">
            <h3 class="">Revoke JobId: <?php echo $jobId ?></h3>
            <h4>Company Email: <?php echo $rows[1] ?></h4>

        </div>

        <form action="" method="POST">

            <div class="mb-3">
                <label for="jobDescription" class="form-label"><b>Reason for revoke</b> (should be more than 100 characters)</label>
                <textarea class="form-control" id="jobDescription" name="reason" required> </textarea>
            </div>

            <div class="card border-0" style="height: 4rem;">
                <div class="d-flex justify-content-center">
                    <!-- Submit Job button -->
                    <button type="Submit" class="btn btn-danger m-2" name="revoke">Revoke</button>  
                </div>
            </div>

        </form>

        </div>

    </div>

<div class="modal" tabindex="-1" id="error1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger">Error</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<!-- Login form -->
            <p class="text-danger">Enter Valid inputs!!!</p>

      </div>

    </div>
  </div>
</div>


    <app-footer></app-footer>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<script src="..\\components.js"></script>  
<script src="new.js"></script>


</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="new.js"></script>

</html>
