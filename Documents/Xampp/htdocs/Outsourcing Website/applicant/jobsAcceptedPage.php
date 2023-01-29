<?php

session_start();

$email = $_SESSION['email'];

$mysqli = new mysqli('localhost', 'root', '', 'outsourcing');

$key;
  foreach ($_POST as $key => $value){
    // echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($key)."<br>";

    if(substr($key,0,4) == 'repo'){
        $_SESSION['jobId']=substr($key,4);

        header('location: applicantIssue.php');
              exit();
    }
    else if(substr($key,0,4) == 'term'){
        $_SESSION['jobId']=substr($key,4);

        header('location: revoke.php');
              exit();
    }
    else{

    }



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
  <body style="width: 100%;">

<div class="overflow-hidden">
    <nav class="navbar bg-light">
        <div class="container mb-2">
            <a class="navbar-brand" href="../index.php">
                <img src="logo.jpg" alt="Logo" width="30rem" height="24"> <b>Arrow Outsourcing</b>
            </a>
        </div>
    </nav>

    <app-applicantnav></app-applicantnav>

    <!-- <div class="col-lg-1"> -->
    <div class="card border-1">

            <!-- Search jobs -->
                
        <div class="input-group text-center d-flex justify-content-end">
            <p class="mt-3"> Search by Job ID or Company Email &nbsp;</p>
            <div class="form-outline m-2">
                <input type="search" id="liveSearch" class="form-control" placeholder="Start typing to search" />
            </div>
        </div>
            
            <h4 class="text-center mt-2">You have accepted the following jobs, please adhere to deadlines as indicated.</h4>

            <div id = "table" class ="overflow-auto">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">Job Id</th>
                        <th scope="col">Job Title</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Company Email</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">Report Issue</th>
                        <th scope="col">Terminate Job</th>
                        </tr>
                    </thead>
                    <tbody>
                    <form action="" method ="POST">
            <?php

                $email = mysqli_real_escape_string($mysqli, $email);
                $sql3 = "SELECT * FROM jobapplications WHERE applicantEmail = '$email' AND status = 'Accepted';"; 
                $res3 = mysqli_query($mysqli, $sql3);

                if(mysqli_num_rows($res3)<1){
                    echo "
                    <tr>
                    <td colspan = '10' class = 'text-danger text-center'>No Data for this category!!!</td>
                    </tr>"; 
                }

                else{
                    while($rows3 = mysqli_fetch_row($res3)){
                        $sql4 = "SELECT * FROM jobdetails WHERE jobId = '$rows3[0]';"; 

                        $res4 = mysqli_query($mysqli, $sql4);
                        while($rows4 = mysqli_fetch_row($res4)){
                            $sql5 = "SELECT * FROM companydetails WHERE companyEmail = '$rows3[1]'";
                            $rows5 = mysqli_fetch_row(mysqli_query($mysqli,$sql5));
                            echo  "<tr>
                            <td><b>$rows3[0]</b></td>
                            <td>$rows4[2]</td>
                            <td>$rows4[4]</td>
                            <td>$rows5[0]</td>
                            <td><a href='mailto:$rows3[1]'>$rows3[1]</a></td>
                            <td>$rows4[5]</td>
                            <td><button type='Submit' name = 'repo$rows3[0]' class='btn btn-danger' data-bs-dismiss='modal'>Report issue</button></td>
                            <td><button type='Submit' name = 'term$rows3[0]' class='btn btn-warning' data-bs-dismiss='modal'>Terminate</button></td>
                            </tr>
                             ";
                        }

                    }
                }



                ?>
                </form>
               </tbody>
                </table>

            </div>

            <div>
                <button class="btn btn-primary" id="print">Print Table</button>

            </div>
                <!-- </div> -->
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
            var acceptedJobSearch = $(this).val();
            // alert(input);

            if(acceptedJobSearch != ""){
                $.ajax({

                    url: "search.php",
                    method: "POST",
                    data:{acceptedJobSearch:acceptedJobSearch},

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
<script src="applicant.js"></script> 
  </body>
</html>


<?php

            
?>
