<?php

session_start();

$companyEmail = $_SESSION['email'];

$mysqli = new mysqli('localhost', 'root', '', 'outsourcing');

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

    <app-companynav></app-companynav>

    <!-- Issues Card"> -->
    <div class="card m-2 border-1">

            <!-- Jobs Issued -->
        <h4 class="text-center mt-5">Please review the following issues</h4>

        <h5 class="text-center">(We recommend that you reply to each indepedently)</h5>

        <div class="card-body overflow-auto">
            <?php
            
            $sql = "SELECT * FROM jobapplications where companyEmail = '$companyEmail' AND issues != 'No Issues Yet';";

            $res = mysqli_query($mysqli, $sql);

            if(mysqli_num_rows($res) == 0){
                echo "No Issues Yet...";
            }
            else{
                while($rows = mysqli_fetch_row($res)){
                    $jobId = $rows[0];

                    $sql2 = "SELECT * FROM jobdetails WHERE jobId = '$jobId';";
                    $res2 = mysqli_query($mysqli, $sql2);

                    while($rows2 = mysqli_fetch_row($res2)){
                        echo " 
                        <div class='card m-4 border-1' style='width: 422px;'>
                            <div class='card-body'>                             
                                <p>
                                    <b>Job Id: </b> $rows[0] <br>
                                    <b>Job Title: </b> $rows2[2] <br>
                                    <b>Applicant Email: </b> $rows[2] <br>
                                    <b>Issue: </b> $rows[6] <br>
                                    <b>Date Posted </b> $rows[7] <br>

                                    <a class='btn btn-primary mt-2' href='mailto:$rows[2]'>Reply Via Mail</a>
                                </p>

                            </div>
                        </div>"; 
                    }

                }
            }

            ?>

                
        </div>

    </div>

    <app-footer></app-footer>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<script src="..\\components.js"></script>  </body>
<script src="new.js"></script>

</html>
