<?php

$mysqli = new mysqli('localhost', 'root', '', 'outsourcing');

?>


<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Page</title>
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

    <!-- Two cards one for side menu (left) and respective conetent on right -->
    <!-- <div class="allHomeCards">
        <div class="row"> -->
            <!-- <div class="col-lg-1"> -->
            <div class="card m-1 border-1 bg-dark overflow-auto">
                <div class="card-body d-inline-flex p-auto">

                <!-- Home icon -->
                <div> <a href="applicants.php" class="btn fs-4 btn-dark text-light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-window-stack" viewBox="0 0 16 16">
                        <path d="M4.5 6a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1ZM6 6a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1Zm2-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z"/>
                        <path d="M12 1a2 2 0 0 1 2 2 2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2 2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h10ZM2 12V5a2 2 0 0 1 2-2h9a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1Zm1-4v5a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V8H3Zm12-1V5a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v2h12Z"/>
                    </svg> Applicants  </a>
                </div>

                                    <!-- Profile icon -->
                    <div> <a href="companies.php" class="btn fs-4 btn-dark text-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z"/>
                            <path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z"/>
                        </svg> Companies  </a>
                    </div>

                    <!-- History icon -->
                    <div> <a href="Jobs.php" class="btn fs-4 btn-dark text-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-workspace" viewBox="0 0 16 16">
                            <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                            <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z"/>
                        </svg> Jobs  </a>
                    </div>

                                        <!-- Reports Icon and Link -->
                    <div> <a href="reports.php" class="btn fs-4 btn-dark text-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-binary-fill" viewBox="0 0 16 16">
                            <path d="M5.526 10.273c-.542 0-.832.563-.832 1.612 0 .088.003.173.006.252l1.559-1.143c-.126-.474-.375-.72-.733-.72zm-.732 2.508c.126.472.372.718.732.718.54 0 .83-.563.83-1.614 0-.085-.003-.17-.006-.25l-1.556 1.146z"/>
                            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-2.45 8.385c0 1.415-.548 2.206-1.524 2.206C4.548 14.09 4 13.3 4 11.885c0-1.412.548-2.203 1.526-2.203.976 0 1.524.79 1.524 2.203zm3.805 1.52V14h-3v-.595h1.181V10.5h-.05l-1.136.747v-.688l1.19-.786h.69v3.633h1.125z"/>
                        </svg> Reports  </a>
                    </div>

                    <!-- Log out icon -->
                    <!-- <form method="POST">
                        <div class="btn fs-4 btn-dark text-light" id="logOut" name = "logOut">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                                <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                            </svg> Log Out
                        </div>
                    </form> -->



                </div>
            </div>
        <!-- </div>
    </div> -->


            <!-- <div class="col-lg-1"> -->
            <div class="card m-2 border-1">
                <div class="card-body">


                   <!-- Jobs Issued -->
                   <h4 class='text-center mt-1' id="hed">Jobs</h4>

                    <div class="d-flex  mb-1 justify-content-end">
                        <input type="text" class="form-control" id='liveSearch' placeholder="Start Typing to search..." style="width: 12rem;">

                    </div>


                   <div class="card border-0 overflow-auto" style="height: 4rem;">
                        <div class="mx-auto">

                            <form action="" method="POST">

                                <button type="Submit" name = "viewAllJobs" class="btn btn-primary m-1">View All Jobs</button>
                                <button type="Submit" name = "viewActiveJobs" class="btn btn-success m-1">View Active Jobs</button>  
                                <button type="Submit" name = "viewDeletedJobs" class="btn btn-danger m-1">View Deleted Jobs</button> 
                                <button type="Submit" name = "viewGivenJobs" class="btn btn-primary m-1">View Jobs Given Out</button>
                                <button type="Submit" name = "viewAcceptedJobs" class="btn btn-success m-1">View Accepted Jobs</button>  
                                <button type="Submit" name = "viewRevokedJobs" class="btn btn-primary m-1">View Terminated Jobs</button> 

                            </form> 
                        </div>
                    </div>

                    <?php

                    $jobId = 4567;

                    $action = "werty";

                    // CREATE OR REPLACE VIEW sir AS SELECT jobapplications.applicantEmail,jobapplications.jobId, jobapplications.companyEmail, companydetails.companyName FROM jobapplications, companydetails WHERE companydetails.companyEmail = 'mumbeKyengo2017@gmail.com';
                    // SELECT * FROM sir;

                    $sql = "CREATE OR REPLACE VIEW sir AS SELECT applicantEmail, jobapplications.companyEmail FROM jobdetails, jobapplications";

                    foreach ($_POST as $key => $value){
                        $nkey = substr($key,3)."<br>";

                        $action = substr($key,0,3);

                        if((substr($key,0,3) == 'res')){
                            $sql2 = "UPDATE jobdetails SET
                            status = 'Active' 
                            WHERE jobId = '$nkey'";


                            if(mysqli_query($mysqli, $sql2)){
                                echo " <script> alert('Status Updated Successively') </script>";
                            }

                        }

                        if((substr($key,0,3) == 'del')){
                            $sql2 = "UPDATE jobdetails SET
                            status = 'Deleted' 
                            WHERE jobId = '$nkey'";


                            if(mysqli_query($mysqli, $sql2)){
                                echo " <script> alert('Job Deleted Successively') </script>";
                            }

                        }

                    }

                        if(isset($_POST['viewDeletedJobs']) || $action == 'res'){
                            echo "<div id = 'table' class ='overflow-auto'>
                            <table class='table table-hover'>
                                <thead>
                                    <tr>
                                    <th scope='col'>Job Id</th>
                                    <th scope='col'>Company Email</th>
                                    <th scope='col'>Job Title</th>
                                    <th scope='col'>Amount (KSH)</th>
                                    <th scope='col'>Date Created</th>
                                    <th scope='col'>Deadline</th>
                                    <th scope='col'>Status</th>
                                    <th scope='col'>Action</th>
                                    </tr>
                                </thead>
                                <tbody>";


                                    echo "<div class = 'text-center'> <b>These are the Deleted Jobs </b> </div>";
    
                                        $sql = "SELECT * FROM jobdetails WHERE status = 'Deleted'";
    
                                        $res = mysqli_query($mysqli, $sql);

                                        if(mysqli_num_rows($res)<1){
                                            echo "
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>No reults found!!!</td>  
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>                                                 
                                                </tr>";
                                                    
                                        }

                                        else{
                                            while($rows = mysqli_fetch_row($res)){
                                            
                                                $jobId = $rows[0];
    
                                                echo "
                                                <tr>
                                                    <td>$rows[0]</td>
                                                    <td>$rows[1]</td>
                                                    <td>$rows[2]</td>
                                                    <td>$rows[4]</td>
                                                    <td>$rows[6]</td>
                                                    <td>$rows[5]</td>
                                                    <td>$rows[7]</td>
                                                    <td>
                                                        <form method='POST'>
                                                            <button type = 'Submit' name = 'res$jobId' class = 'btn btn-danger'>Restore </button>
                                                        </form>
                                                    </td>
                                                </tr>";
    
                                            }
                                        }
                                           

                            echo "          

                                    </tbody>
                                </table>

                            </div> " ;
                            

                        }

                        else if(isset($_POST['viewActiveJobs']) || $action == 'del'){
                            echo "<div id = 'table' class ='overflow-auto'>
                            <table class='table table-hover'>
                                <thead>
                                    <tr>
                                    <th scope='col'>Job Id</th>
                                    <th scope='col'>Company Email</th>
                                    <th scope='col'>Job Title</th>
                                    <th scope='col'>Amount (KSH)</th>
                                    <th scope='col'>Date Created</th>
                                    <th scope='col'>Deadline</th>
                                    <th scope='col'>Status</th>
                                    <th scope='col'>Action</th>
                                    </tr>
                                </thead>
                                <tbody>";


                                    echo "<div class = 'text-center'> <b>These are all active jobs </b> </div>";
    
                                        $sql = "SELECT * FROM jobdetails WHERE status = 'Active'";
    
                                        $res = mysqli_query($mysqli, $sql);
                                        
                                        if(mysqli_num_rows($res)<1){
                                            echo "
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>No reults found!!!</td>  
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>                                                 
                                                </tr>";
                                                    
                                        }

                                        else{
                                            while($rows = mysqli_fetch_row($res)){
                                            
                                                $jobId = $rows[0];
    
                                                echo "
                                                <tr>
                                                    <td>$rows[0]</td>
                                                    <td>$rows[1]</td>
                                                    <td>$rows[2]</td>
                                                    <td>$rows[4]</td>
                                                    <td>$rows[6]</td>
                                                    <td>$rows[5]</td>
                                                    <td>$rows[7]</td>
                                                    <td>
                                                        <form method='POST'>
                                                            <button type = 'Submit' name = 'del$jobId' class = 'btn btn-danger'>Delete </button>
                                                        </form>
                                                    </td>
                                                </tr>";
    
                                            }
                                        }
    

                            echo "          

                                    </tbody>
                                </table>

                            </div> " ;
                            

                        }


                        else if(isset($_POST['viewGivenJobs'])){
                            echo "<div id = 'table' class ='overflow-auto'>
                            <table class='table table-hover'>
                                <thead>
                                    <tr>
                                    <th scope='col'>Job Id</th>
                                    <th scope='col'>Company Email</th>
                                    <th scope='col'>Applicant Email</th>
                                    <th scope='col'>Date Applied</th>
                                    <th scope='col'>Status</th>
                                    <th scope='col'>Status Change Date</th>
                                    </tr>
                                </thead>
                                <tbody>";


                                    echo "<div class = 'text-center'> <b>These are all Applications </b> </div>";
    
                                        $sql = "SELECT * FROM jobapplications WHERE status = 'Given'";
    
                                        $res = mysqli_query($mysqli, $sql);
                                        
                                        if(mysqli_num_rows($res)<1){
                                            echo "
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td>No reults found!!!</td>  
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>                                                 
                                                </tr>";
                                                    
                                        }

                                        else{
                                            while($rows = mysqli_fetch_row($res)){
                                            
                                                $jobId = $rows[0];
    
                                                echo "
                                                <tr>
                                                    <td>$rows[0]</td>
                                                    <td>$rows[1]</td>
                                                    <td>$rows[2]</td>
                                                    <td>$rows[3]</td>
                                                    <td>$rows[4]</td>
                                                    <td>$rows[5]</td>
                                                </tr>";
    
                                            }
                                        }
    

                            echo "          

                                    </tbody>
                                </table>

                            </div> " ;

                            
                        }


                        else if(isset($_POST['viewAcceptedJobs'])){
                           
                            echo "<div id = 'table' class ='overflow-auto'>
                            <table class='table table-hover'>
                                <thead>
                                    <tr>
                                    <th scope='col'>Job Id</th>
                                    <th scope='col'>Company Email</th>
                                    <th scope='col'>Applicant Email</th>
                                    <th scope='col'>Date Applied</th>
                                    <th scope='col'>Status</th>
                                    <th scope='col'>Issues</th>
                                    </tr>
                                </thead>
                                <tbody>";


                                    echo "<div class = 'text-center'> <b>These are all Active Applications </b> </div>";
    
                                        $sql = "SELECT * FROM jobapplications WHERE status = 'Accepted'";
    
                                        $res = mysqli_query($mysqli, $sql);
                                        
                                        if(mysqli_num_rows($res)<1){
                                            echo "
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td>No reults found!!!</td>  
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>                                                 
                                                </tr>";
                                                    
                                        }

                                        else{
                                            while($rows = mysqli_fetch_row($res)){
                                            
                                                $jobId = $rows[0];
    
                                                echo "
                                                <tr>
                                                    <td>$rows[0]</td>
                                                    <td>$rows[1]</td>
                                                    <td>$rows[2]</td>
                                                    <td>$rows[3]</td>
                                                    <td>$rows[4]</td>
                                                    <td>$rows[5]</td>
                                                </tr>";
    
                                            }
                                        }
    

                            echo "          

                                    </tbody>
                                </table>

                            </div> " ;
                            
                        }

                        else if(isset($_POST['viewRevokedJobs'])){
                           
                            echo "<div id = 'table' class ='overflow-auto'>
                            <table class='table table-hover'>
                                <thead>
                                    <tr>
                                    <th scope='col'>Job Id</th>
                                    <th scope='col'>Company Email</th>
                                    <th scope='col'>Applicant Email</th>
                                    <th scope='col'>Date Applied</th>
                                    <th scope='col'>Status</th>
                                    <th scope='col'>Issues</th>
                                    </tr>
                                </thead>
                                <tbody>";


                                    echo "<div class = 'text-center'> <b>These are all Active Applications </b> </div>";
    
                                        $sql = "SELECT * FROM jobapplications WHERE status = 'Revoked'";
    
                                        $res = mysqli_query($mysqli, $sql);
                                        
                                        if(mysqli_num_rows($res)<1){
                                            echo "
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td>No reults found!!!</td>  
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>                                                 
                                                </tr>";
                                                    
                                        }

                                        else{
                                            while($rows = mysqli_fetch_row($res)){
                                            
                                                $jobId = $rows[0];
    
                                                echo "
                                                <tr>
                                                    <td>$rows[0]</td>
                                                    <td>$rows[1]</td>
                                                    <td>$rows[2]</td>
                                                    <td>$rows[3]</td>
                                                    <td>$rows[4]</td>
                                                    <td>$rows[5]</td>
                                                </tr>";
    
                                            }
                                        }
    

                            echo "          

                                    </tbody>
                                </table>

                            </div> " ;
                            
                        }


                        else{
                            echo "<div id = 'table' class ='overflow-auto'>
                            <table class='table table-hover'>
                                <thead>
                                    <tr>
                                    <th scope='col'>Job Id</th>
                                    <th scope='col'>Company Email</th>
                                    <th scope='col'>Job Title</th>
                                    <th scope='col'>Amount (KSH)</th>
                                    <th scope='col'>Skills</th>
                                    <th scope='col'>Date Created</th>
                                    <th scope='col'>Deadline</th>
                                    <th scope='col'>Level</th>
                                    </tr>
                                </thead>
                                <tbody>";
                                // CREATE OR REPLACE VIEW sir AS SELECT jobdetails.companyEmail, jobdetails.jobTitle, companydetails.companyName,jobapplications.applicantEmail FROM jobdetails,jobapplications,companydetails WHERE jobdetails.companyEmail = 'mumbekyengo2017@gmail.com' AND companydetails.companyEmail = 'mumbekyengo2017@gmail.com' AND jobdetails.jobId = '61';
                                // SELECT * FROM sir;

                                    echo "<div class = 'text-center'> <b>These are All the jobs </b> </div>";
    
                                        $sql = "SELECT * FROM jobdetails";
    
                                        $res = mysqli_query($mysqli, $sql);

                                        if(mysqli_num_rows($res)<1){
                                            echo "
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>No reults found!!!</td>  
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>";
                                                    
                                        }
                                        else{
                                            while($rows = mysqli_fetch_row($res)){
                                            
                                                $jobId = $rows[0];
    
                                                echo "
                                                <tr>
                                                    <td>$rows[0]</td>
                                                    <td>$rows[1]</td>
                                                    <td>$rows[2]</td>
                                                    <td>$rows[4]</td>
                                                    <td>$rows[6]</td>
                                                    <td>$rows[8]</td>
                                                    <td>$rows[5]</td>
                                                    <td>$rows[7]</td>
                                                </tr>";
                                            }
                                        }
    

                            echo "          

                                    </tbody>
                                </table>

                            </div> " ;
  
                        }


                    ?>


                    <div>
                        <button class="btn btn-primary" id="print">Print Table</button>

                    </div>
                     
                </div>

            </div>

    <app-footer></app-footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script type="text/javascript">

    var print = document.getElementById('print');
    print.onclick = () =>{
        alert("You are about to print this table");
        var tableContents = document.getElementById("table").innerHTML;
                var a = window.open('', '', 'height=500, width=500');
                a.document.write('<html>');
                a.document.write('<body >');
                a.document.write(tableContents);
                a.document.write('</body></html>');
                a.document.close();
                a.print();

    };
 

    $(document).ready(function(){
        $('#liveSearch').keyup(function(){
            var input = $(this).val();
            // alert(input);

            if(input != ""){
                $.ajax({

                    url: "search.php",
                    method: "POST",
                    data:{input:input},

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

</body>

</html>