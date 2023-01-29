<?php

session_start();
$mysqli = new mysqli('localhost', 'root', '', 'outsourcing');

if(isset($_POST['submit'])){
    $jobId = $_SESSION['jobId'];
    $email = $_SESSION['email'];
    $issue = $_POST['issue'];
    $time = date('Y-m-d h:i:sa');

    $sql = "SELECT * FROM jobapplications WHERE jobId = '$jobId' AND applicantEmail = '$email'";

    $res = mysqli_query($mysqli, $sql);

    $rows = mysqli_fetch_row($res);
    
    if($rows[6] == "No Issues Yet"){
        $sql = "UPDATE jobapplications SET
        issues = '$issue',
        issueDate = '$time'
        WHERE jobId = '$jobId' AND
        applicantEmail = '$email';";

        $res = mysqli_query($mysqli, $sql);

        if($res){
            echo "<script> alert('Your issue has been recorderd') </script>";
        }
    }
    else{
        $sql = "UPDATE jobapplications SET
        issues = '$issue',
        issueDate = '$time'
        WHERE jobId = '$jobId' AND
        applicantEmail = '$email';";

        $res = mysqli_query($mysqli, $sql);

        if($res){
            echo "<script> alert('You are recording a new issue!!! Issue has been recorderd')</script>";
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

    <nav class="navbar bg-light">
        <div class="container mb-2">
            <a class="navbar-brand" href="../index.php">
                <img src="logo.jpg" alt="Logo" width="30rem" height="24"> <b>Arrow Outsourcing</b>
            </a>
        </div>
    </nav>

    <app-applicantnav></app-applicantnav>

    <!-- Two cards one for side menu (left) and respective conetent on right -->
    <form action="" method = "POST">

        <div class ="d-flex justify-content-center">
            <div class="card m-5 border-1 d-flex" style="width: 50rem;">
                <div class="card-body">

                    <div class="m-3 justify-content-center text-center">
                        <h4>Job ID: <?php echo $_SESSION['jobId'] ?></h4>
                        <h4>Type your issue here and press submit</h4>
                        <textarea name="issue" id="issue" cols="50" rows="10" required></textarea>
                    </div>                            
                    

                    
                    <div class="card border-0" style="height: 4rem;">
                        <div class="d-flex justify-content-center">

                            <button type="Reset" class="btn btn-primary m-2" data-bs-dismiss="modal">Reset</button>  
                            <button type="Submit" name = "submit" class="btn btn-danger m-2" data-bs-dismiss="modal">Submit</button>  
                        </div>
                    </div>
                </div>
                                
            </div>
        </div>

    </form>
    <app-footer></app-footer>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<script src="..\\components.js"></script>  </body>
<script src="applicant.js"></script> 

</html>