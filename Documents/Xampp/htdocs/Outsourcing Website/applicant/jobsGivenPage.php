<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
USE PHPMailer\PHPMailer\Exception;

$email = $_SESSION['email'];

$email1 = $email2 = $email; //$email1 is to be used when sending email to company

$mysqli = new mysqli('localhost', 'root', '', 'outsourcing');

foreach ($_POST as $key => $value){
$jobId = substr($key,4);

    if(substr($key,0,4) == "reje"){
        $sql = "UPDATE jobDetails SET status = 'Active ' WHERE jobId = '$jobId'";
        
        $sql2 = "DELETE FROM jobapplications WHERE jobId = '$jobId'";
        if(mysqli_query($mysqli, $sql) && mysqli_query($mysqli, $sql2)){
            echo "<script>alert('Job rejected!!!')</script>";

        }
        else{
            echo "<script>alert('An error occured please retry!')</script>";
        }
    }
    else{
        $sql = "UPDATE jobdetails SET status = 'Accepted' WHERE jobId = '$jobId'";
        $sql2 = "UPDATE jobapplications SET status = 'Accepted' WHERE jobId = '$jobId'";

        if(mysqli_query($mysqli, $sql) && mysqli_query($mysqli, $sql2)){

            
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
            $email -> Body = 'Job ID: '.$jobId.' accepted in your, please ensure that';

            $email -> send();
            echo "<script>alert('Job accepted! Please adhere to deadlines')</script>";
        }
        else{
            echo "<script>alert('An error occured please retry!')</script>";
        }
    }
        // header('location: applicantIssue.php');
        // exit();

}

?>


<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Applicant Jobs page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body>

    <nav class="navbar bg-light">
        <div class="container mb-2">
            <a class="navbar-brand" href="../../index.php">
                <img src="logo.jpg" alt="Logo" width="30rem" height="24"> <b>Arrow Outsourcing</b>
            </a>
        </div>
    </nav>

    <app-applicantnav></app-applicantnav>


    <!-- <div class="col-lg-1"> -->
    <div class="card m-2 border-1">
        <div class="card-body overflow-auto">



            <div class="card border-0" style="height: 4rem;">
                <div class="overflow-auto">

                    <form action="" method="POST">

                        <!-- <button type="Submit" name = "viewAllJobs" class="btn btn-primary m-1" data-bs-dismiss="modal">View All Jobs</button> 
                        <button type="Submit" name = "viewApplied" class="btn btn-primary m-1" data-bs-dismiss="modal">View Applied</button> 
                        <button type="Submit" name = "viewJobsGiven" class="btn btn-success m-1" data-bs-dismiss="modal">View Jobs Given</button>  
                        <button type="Submit" name = "viewRejectedApplications" class="btn btn-danger m-1" data-bs-dismiss="modal">View Rejected Applications</button>   -->


                </div>
            </div>
            <div class="float-end" style="width: 15rem;">
                <input type="search" id="liveSearch" class="form-control" placeholder=" Start Typing to Search" />
            </div>
            <h3 class="text-center">Jobs given to you are dispalyed below, click accept if you are interested</h3>

            <div id="table">
            <form action="" method="POST">
                        <?php

                        $email2 = mysqli_real_escape_string($mysqli, $email2);

                            $sql = "SELECT * FROM jobapplications WHERE applicantEmail = '$email2' AND status = 'Given';";

                            $res = mysqli_query($mysqli, $sql);

                            if(mysqli_num_rows($res)<1){
                                echo "
                                <p class = 'text-danger text-center'>No Data for this category!!! Accepted jobs appear in the jobs accepted tab</p>";
                            }
                            else{
                                
                            

                                while($rows = mysqli_fetch_row($res)){

                                    $sql1 = "SELECT * FROM jobDetails WHERE jobId = '$rows[0]' AND status = 'Given'";
                                    $res1 = mysqli_query($mysqli, $sql1);

                                    while($rows1 = mysqli_fetch_row($res1)){


                                        echo "<div class='card m-2'>
                                        <div class='card-body'>
                                            <p> <b>Job ID: </b>$rows[0] </p>
                                            <p> <b>Job Title: </b>$rows1[2] </p>
                                            <p> <b>Job Description: </b>$rows1[3] </p>
                                            <p> <b>Amount to be paid: </b>$rows1[4] </p>
                                            <p> <b>Deadline: </b>$rows1[5] </p>
                                            <p> <b>Skills needed: </b>$rows1[3] </p>
                                            <button type='Submit' name = 'reje$rows[0]' class='btn btn-danger m-1' data-bs-dismiss='modal'>Reject</button> 
                                            <button type='Submit' name = 'acce$rows[0]' class='btn btn-primary m-1' data-bs-dismiss='modal'>Accept</button>  

                    
                                        </div>
                                        </div>";
                                    }



                                }
                            }
                            

                        ?>


            </form> 
            </div>
            </div>

            <div>
                <button class="btn btn-primary" id="print">Print</button>

            </div>
                
        </div>

    </div>


    <app-footer></app-footer>

<script>
    var print = document.getElementById('print');
    print.onclick = () =>{
        alert("You are about to print this table");
        var tableContents = document.getElementById("table").innerHTML;
                var a = window.open('', '', 'height=500, width=500');
                a.document.write('<html>');
                a.document.write('<body > <h1> Table <br>');
                a.document.write(tableContents);
                a.document.write('</body></html>');
                a.document.close();
                a.print();

    }

        $(document).ready(function(){
        $('#liveSearch').keyup(function(){
            var jobGivenSearch = $(this).val();
            // alert(input);

            if(jobGivenSearch != ""){
                $.ajax({

                    url: "search.php",
                    method: "POST",
                    data:{jobGivenSearch:jobGivenSearch},

                    success: function(data){
                        $("#table").html(data);
                    }
                });
            }

        });

    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<script src="..\\components.js"></script>
<!-- <script src="applicant.js"></script>  -->

</body>

</html>