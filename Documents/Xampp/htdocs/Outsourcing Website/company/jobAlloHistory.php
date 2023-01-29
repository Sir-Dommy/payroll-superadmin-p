
<?php

session_start();
$mysqli = new mysqli('localhost', 'root', '', 'outsourcing');

$key="12345";
foreach ($_POST as $key => $value){
  $jobId= substr($key,4);
//   $email = str_replace('_','.',$email1);
//   $time = date('Y-m-d h:i:sa');
  
  if(substr($key, 0,4)== "rest"){
  
      $sql = "UPDATE jobdetails SET
      status = 'Active'
      WHERE jobId = '$jobId' ";
  
  
      $res = mysqli_query($mysqli,$sql);
  
      if($res){
  
        echo "<script>
        alert('Job Restored successively, you can now give out this job')
        </script>";
      }
  }

  if(substr($key, 0,4)== "dele"){
  
    $sql = "UPDATE jobdetails SET
    status = 'Deleted'
    WHERE jobId = '$jobId' ";


    $res = mysqli_query($mysqli,$sql);

    if($res){

      echo "<script>
      alert('You will not be able to give out this job until you restore it')
      </script>";
    }
  }

  if(substr($key, 0,4)== "revo"){
  
    $_SESSION['jobId'] = substr($key,4);
    header('location: revoke.php');
    exit();

  }
}

$companyEmail = $_SESSION['email'];

// $jobId = $_SESSION['jobId'];

$sql = "SELECT * FROM jobapplications WHERE companyEmail = '$companyEmail';";

$res1 = mysqli_query($mysqli, $sql);

$sql2 = "SELECT * FROM jobdetails WHERE companyEmail = '$companyEmail' ORDER BY jobId DESC;";

$res2 = mysqli_query($mysqli, $sql2);


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Company HomePage</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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

    <!-- Job History> -->

    <!-- <div class="col-lg-1"> -->
    <div class="card m-2 border-1">
        <div class="card-body overflow-auto" id="table">
        <form method="POST">

            <!-- Jobs Issued -->
            <h4 class='text-center mt-5'>This is a history of your Job Allocation</h4>

            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">Job Id</th>
                    <th scope="col">Job Title</th>
                    <th scope="col">Date Posted</th>
                    <th scope="col">Applicant Email</th>
                    <th scope="col">Job Status</th>
                    <th scope="col">Date Given</th>
                    <th scope="col">Deadline</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                        while($rows2 = mysqli_fetch_row($res2)){
                            $jobId = $rows2[0];
                            $sql = "SELECT * FROM jobapplications WHERE jobId = '$jobId';";

                            $res = mysqli_query($mysqli, $sql);

                            if(mysqli_num_rows($res)>0){
                                while($rows3 = mysqli_fetch_row($res)){
                                    echo "<tr>
                                    <th scope='row'>$rows3[0]</th>
                                    <td>$rows2[2]</td>
                                    <td>$rows2[8]</td>
                                    <td>$rows3[2]</td>
                                    <td>$rows2[9]</td>
                                    <td>$rows3[3]</td>
                                    <td>$rows2[5]</td>
                                    <td><button class= 'btn btn-warning' type = 'Submit' name='revo$jobId'>
                                    Revoke
                                </button></td>
                                    </tr>
                                    ";
                                }
                            }
                            else{
                                echo "<tr>
                                <th scope='row'>$rows2[0]</th>
                                <td>$rows2[2]</td>
                                <td>$rows2[8]</td>
                                <td>Not Given</td>
                                <td>$rows2[9]</td>
                                <td>Not Given</td>
                                <td>$rows2[5]</td>";
                                if($rows2[9]=="Deleted"){
                                    echo "<td><button class= 'btn btn-primary' type = 'Submit' name='rest$jobId'>
                                    Restore
                                </button></td>
                                </tr>";
                                }
                                else{
                                    echo "<td><button class= 'btn btn-danger' type = 'Submit' name='dele$jobId'>
                                    Delete
                                </button></td>
                                </tr>";
                                }
                                
                                
                            }

                        }
                    ?>


                </tbody>
            </table>

        </form>      
        </div>

    </div>

    <div>
                <button class="btn btn-primary" id="print">Print</button>

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
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<script src="..\\components.js"></script>  </body>
<script src="new.js"></script>

</html>

