
<?php
session_start();
// echo $_SESSION['timer'];

date_default_timezone_set('Africa/nairobi');

$startTime = date('Y-m-d H:i:s');
$finish = $_SESSION['endtime'];

if(strtotime($finish) > strtotime($startTime)){
    $timeDifference = strtotime($finish) - strtotime($startTime);

}
else{
    $timeDifference = 0;
}
// $_SESSION['endtime'] = $endTime = date('Y-m-d H:i:s', strtotime('+'.$_SESSION['duration'].'minutes', strtotime($_SESSION['stime'])));


// echo $_SESSION['stime'];

$email = $_SESSION['email'];

$skill=[''];
$score = 0;

$mysqli = new mysqli('localhost', 'root', '', 'outsourcing');
$log_time = date('Y-m-d h:i:sa');
if(mysqli_errno($mysqli)){
    error_log("[ERROR: " . date("Y-m-d H:i:s") . "] Connect "
    . "failed: " . mysqli_connect_error() . "\n", 3, $log_filename);
}

$task1 = $task2 = $task3 = $task4 = $task5 = $task6 = $task7 = $task8 = $task9 = $task10 = $task11 = $task12 = $task13 = "";

if(($timeDifference<1) && ($timeDifference>-1)){
    if(isset($_POST['task1'])){
        $task1 = mysqli_real_escape_string($mysqli, $_POST['task1']);
    }
    else{
        $task1 = "";
    }
    if(isset($_POST['task2'])){
        $task2 = mysqli_real_escape_string($mysqli, $_POST['task2']);
    }
    else{
        $task2 = "";
    }    
    if(isset($_POST['task3'])){
        $task3 = mysqli_real_escape_string($mysqli, $_POST['task3']);
    }
    else{
        $task3 = "";
    }    
    if(isset($_POST['task4'])){
        $task4 = mysqli_real_escape_string($mysqli, $_POST['task4']);
    }
    else{
        $task4 = "";
    }    
    if(isset($_POST['task5'])){
        $task5 = mysqli_real_escape_string($mysqli, $_POST['task5']);
    }
    else{
        $task5 = "";
    }    
    if(isset($_POST['task6'])){
        $task6 = mysqli_real_escape_string($mysqli, $_POST['task6']);
    }
    else{
        $task6 = "";
    }    
    if(isset($_POST['task7'])){
        $task7 = mysqli_real_escape_string($mysqli, $_POST['task7']);
    }
    else{
        $task7 = "";
    }    
    if(isset($_POST['task8'])){
        $task8 = mysqli_real_escape_string($mysqli, $_POST['task8']);
    }
    else{
        $task8 = "";
    }    
    if(isset($_POST['task9'])){
        $task9 = mysqli_real_escape_string($mysqli, $_POST['task9']);
    }
    else{
        $task9 = "";
    }    
    if(isset($_POST['task10'])){
        $task10 = mysqli_real_escape_string($mysqli, $_POST['task10']);
    }
    else{
        $task10 = "";
    }    
    if(isset($_POST['task11'])){
        $task11 = mysqli_real_escape_string($mysqli, $_POST['task11']);
    }
    else{
        $task11 = "";
    }    
    if(isset($_POST['task12'])){
        $task12 = mysqli_real_escape_string($mysqli, $_POST['task12']);
    }
    else{
        $task12 = "";
    }    
    if(isset($_POST['task13'])){
        $task13 = mysqli_real_escape_string($mysqli, $_POST['task13']);
    }
    else{
        $task13 = "";
    }
    // $task2 = mysqli_real_escape_string($mysqli, $_POST['task2']);
    // $task3 = mysqli_real_escape_string($mysqli, $_POST['task3']);
    // $task4 = mysqli_real_escape_string($mysqli, $_POST['task4']);
    // $task5 = mysqli_real_escape_string($mysqli, $_POST['task5']);
    // $task6 = mysqli_real_escape_string($mysqli, $_POST['task6']);
    // $task7 = mysqli_real_escape_string($mysqli, $_POST['task7']);
    // $task8 = mysqli_real_escape_string($mysqli, $_POST['task8']);
    // $task9 = mysqli_real_escape_string($mysqli, $_POST['task9']);
    // $task10 = mysqli_real_escape_string($mysqli, $_POST['task10']);
    // $task11 = mysqli_real_escape_string($mysqli, $_POST['task11']);
    // $task12 = mysqli_real_escape_string($mysqli, $_POST['task12']);
    // $task13 = mysqli_real_escape_string($mysqli, $_POST['task13']);

    $sql = "SELECT * FROM tasks WHERE applicantEmail = '$email' AND taskNumber = '1'";

    if(mysqli_num_rows(mysqli_query($mysqli, $sql))>0){
       echo "<script>alert('Time Limit Exceeded!!!')</script>";

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

    <div class="card m-5">
        <div class="card m-5 text-center bg-dark">
            <h4 class="text-light m-2">Below are some guidelines for using our website</h4>
            <div class="card m-3 border-1">
                <div class="card-body">
                    <h5 class="card-title text-light text-center bg-success rounded-circle" style="width: 1rem;">1</h5> <br>
                    <p>Registration is one time, once you register the next you visit our site just click on login button
                        on the top right corner of registration page.
                    </p>

                </div>
            </div>
                
            <div class="card m-3 border-1">
                <div class="card-body">
                    <h5 class="card-title text-light text-center bg-success rounded-circle" style="width: 1rem;">2</h5> <br>
                    <p>All services in our site are free, companies should not ask you for any payments prior to giving you a job.
                    </p>

                </div>
            </div>
                
            <div class="card m-3 border-1">
                <div class="card-body">
                    <h5 class="card-title text-light text-center bg-success rounded-circle" style="width: 1rem;">3</h5> <br>
                    <p>Jobs given to you will appear in the job history, once a company gives you a job you will be notified via SMS.
                        SMSs will be send to the number you register with, you can always change this number in the profile page which can be accessed
                        from the navigation bar.
                    </p>

                </div>
            </div>
            
            <div class="card m-3 border-1">
                <div class="card-body">
                    <h5 class="card-title text-light text-center bg-success rounded-circle" style="width: 1rem;">4</h5> <br>
                    <p>Companies can revoke a job even after they have given it to you, though this is limited you do not have to worry
                        always check your email for such notifications.
                    </p>

                </div>
            </div>

            <div class="card m-3 border-1">
                <div class="card-body">
                    <h5 class="card-title text-light text-center bg-success rounded-circle" style="width: 1rem;">5</h5> <br>
                    <p>If you encounter any issues you can report through the report issue page which is accessible from the 
                        navigation bar.
                    </p>

                </div>
            </div>
        
            <div class="card m-3 border-1">
                <div class="card-body">
                    <h5 class="card-title text-light text-center bg-success rounded-circle" style="width: 1rem;">6</h5> <br>
                    <p>We have included our contacts in the footer in case you need to contact us, You can email us now by clicking <a href="mailto:mumbekyengo19@gmail.com">here</a>

                </div>
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


       <?php
    }

    else{
       $array = [$task1,$task2,$task3,$task4,$task5,$task6,$task7,$task8,$task9,$task10,$task11,$task12,$task13];

       // print_r($array);
       $count = 1;
       $resNo = 0;
       while($count<14){
           $sql1 = "INSERT INTO tasks SET 
           applicantEmail = '$email',
           taskNumber = '$count',
           response = '$array[$resNo]'";
           mysqli_query($mysqli, $sql1);

           $count +=1;
           $resNo +=1;
       }


       $sql2 = "SELECT * FROM tasks WHERE applicantEmail = '$email'";
       $res = mysqli_query($mysqli, $sql2);

       while($rows = mysqli_fetch_row($res)){
           if($rows[1]==1){
               if($rows[2]=="myNameIs('jane');" || $rows[2]=="myNameIs(\"jane\");"){
                   $score +=3;
                   array_push($skill,"PHP");
                   // echo "1<br>";
               }
           }
           else if($rows[1]==2){
               
               if(str_replace(" ","",$rows[2]) =="SELECT*FROMusersWHEREamount>400;"){
                   $score +=3;
                   array_push($skill,"SQL");
                   // echo "2<br>";
               }
           }

           else if($rows[1]==3){
               if($rows[2]=="required"){
                   $score +=1;
                   array_push($skill,"HTML");
                   // echo "3<br>";
               }
           }

           else if($rows[1]==4){
               if($rows[2]=="JavaSwing"){
                   $score +=1;
                   array_push($skill,"Java");
                   // echo "4<br>";
               }
           }

           else if($rows[1]==5){
               if(str_replace(" ","", $rows[2])=="file_put_contents(\$log_file,\"ThisisSir\");" || str_replace(" ","", $rows[2])=="file_put_contents(\$log_file,'ThisisSir');" ){
                   $score +=5;
                   array_push($skill,"PHP");
                   // echo "5<br>";
               }
           }

           else if($rows[1]==6){
               if(str_replace(" ","", $rows[2])=="SELECTDISTINCT(amount)FROMtableaUNIONSELECT*FROMtableb"){
                   $score +=5;
                   array_push($skill,"SQL");
                   // echo "6<br>";
               }
           }

           else if($rows[1]==7){
               if(str_replace(" ","", $rows[2])=="defcomplexCode(x,y):return{'x':x,'y':y}"){
                   $score +=8;
                   array_push($skill,"Python");
                   // echo "7<br>";
               }
               // echo str_replace(" ","", $rows[2]);
           }

           else if($rows[1]==8){
            $text = $rows[2];
            $text = preg_replace("/\R/", "", $text);
            str_replace(" ","",$text);
               if($text=="num<6?console.log(6):console.log(0);"){
                   $score +=7;
                   array_push($skill,"JavaScript");
                   // echo "8<br>";
               }
           }

           else if($rows[1]==9){
               if($rows[2]=="num+=1"){
                   $score +=2;
                   array_push($skill,"Problem Solver");
                   // echo "9<br>";
               }
           }

           else if($rows[1]==10){
               if($rows[2]=="No"){
                   $score +=2;
                   array_push($skill,"Android");
                   // echo "<br>";
               }
               // echo $rows[2];
           }

           else if($rows[1]==11){
            $text = $rows[2];
            $text = preg_replace("/\R/", "", $text);
            str_replace(" ","",$text);
               if($text=="withopen('file.txt')asf:forlineinf:print(line)"){
                   $score +=10;
                   array_push($skill,"Python");
                   // echo "11<br>";
               }
               // echo str_replace(" ","", $rows[2]);
           }

           else if($rows[1]==12){
               if(str_replace(" ","", $rows[2])=="constantproduct=(x,y)=>x*y;"){
                   $score +=7;
                   array_push($skill,"JavaScript");
                   // echo "12<br>";
               }
           }

           else if($rows[1]==13){
               if(strpos($rows[2], "security") || strpos($rows[2], "injection")){
                   $score +=5;
                   array_push($skill,"SQL Expert");
                   echo "13<br>";
               }
           }

       }

       // echo "<br>".$score."<br>";
       $skillCount = count($skill);
       $skills = implode(" ",$skill);
       if(strlen($skills)<1){
        $skillCount = 0;
       }
       $level = "Beginner";
       if($score > 44){
           $level = "Expert";
       }
       else if($score >24){
           $level = "Intermediate";
       }
       $sql3 = "UPDATE applicantDetails SET score = '$score', skills = '$skills', level = '$level', skillsCount = '$skillCount' WHERE applicantEmail = '$email'";

       mysqli_query($mysqli, $sql3);

    }

    

}


else if(isset($_POST['submitResponse']) && ($timeDifference == 0)){
    echo "<script>alert('Time limit exceeded!!!')</script>";

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

    <div class="card m-5">
        <div class="card m-5 text-center bg-dark">
            <h4 class="text-light m-2">Below are some guidelines for using our website</h4>
            <div class="card m-3 border-1">
                <div class="card-body">
                    <h5 class="card-title text-light text-center bg-success rounded-circle" style="width: 1rem;">1</h5> <br>
                    <p>Registration is one time, once you register the next you visit our site just click on login button
                        on the top right corner of registration page.
                    </p>

                </div>
            </div>
                
            <div class="card m-3 border-1">
                <div class="card-body">
                    <h5 class="card-title text-light text-center bg-success rounded-circle" style="width: 1rem;">2</h5> <br>
                    <p>All services in our site are free, companies should not ask you for any payments prior to giving you a job.
                    </p>

                </div>
            </div>
                
            <div class="card m-3 border-1">
                <div class="card-body">
                    <h5 class="card-title text-light text-center bg-success rounded-circle" style="width: 1rem;">3</h5> <br>
                    <p>Jobs given to you will appear in the job history, once a company gives you a job you will be notified via SMS.
                        SMSs will be send to the number you register with, you can always change this number in the profile page which can be accessed
                        from the navigation bar.
                    </p>

                </div>
            </div>
            
            <div class="card m-3 border-1">
                <div class="card-body">
                    <h5 class="card-title text-light text-center bg-success rounded-circle" style="width: 1rem;">4</h5> <br>
                    <p>Companies can revoke a job even after they have given it to you, though this is limited you do not have to worry
                        always check your email for such notifications.
                    </p>

                </div>
            </div>

            <div class="card m-3 border-1">
                <div class="card-body">
                    <h5 class="card-title text-light text-center bg-success rounded-circle" style="width: 1rem;">5</h5> <br>
                    <p>If you encounter any issues you can report through the report issue page which is accessible from the 
                        navigation bar.
                    </p>

                </div>
            </div>
        
            <div class="card m-3 border-1">
                <div class="card-body">
                    <h5 class="card-title text-light text-center bg-success rounded-circle" style="width: 1rem;">6</h5> <br>
                    <p>We have included our contacts in the footer in case you need to contact us, You can email us now by clicking <a href="mailto:mumbekyengo19@gmail.com">here</a>

                </div>
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

<?php
}




else if(isset($_POST['submitResponse']) && ($timeDifference>0)){
    // && ($timeDifference >0)

     $task1 = mysqli_real_escape_string($mysqli, $_POST['task1']);
     $task2 = mysqli_real_escape_string($mysqli, $_POST['task2']);
     $task3 = mysqli_real_escape_string($mysqli, $_POST['task3']);
     $task4 = mysqli_real_escape_string($mysqli, $_POST['task4']);
     $task5 = mysqli_real_escape_string($mysqli, $_POST['task5']);
     $task6 = mysqli_real_escape_string($mysqli, $_POST['task6']);
     $task7 = mysqli_real_escape_string($mysqli, $_POST['task7']);
     $task8 = mysqli_real_escape_string($mysqli, $_POST['task8']);
     $task9 = mysqli_real_escape_string($mysqli, $_POST['task9']);
     $task10 = mysqli_real_escape_string($mysqli, $_POST['task10']);
     $task11 = mysqli_real_escape_string($mysqli, $_POST['task11']);
     $task12 = mysqli_real_escape_string($mysqli, $_POST['task12']);
     $task13 = mysqli_real_escape_string($mysqli, $_POST['task13']);

     $sql = "SELECT * FROM tasks WHERE applicantEmail = '$email' AND taskNumber = '1'";

     if(mysqli_num_rows(mysqli_query($mysqli, $sql))>0){
        echo "<script>alert('Your responses have already been submitted')</script>";
     }

     else{
        $array = [$task1,$task2,$task3,$task4,$task5,$task6,$task7,$task8,$task9,$task10,$task11,$task12,$task13];

        // print_r($array);
        $count = 1;
        $resNo = 0;
        while($count<14){
            $sql1 = "INSERT INTO tasks SET 
            applicantEmail = '$email',
            taskNumber = '$count',
            response = '$array[$resNo]'";
            mysqli_query($mysqli, $sql1);

            $count +=1;
            $resNo +=1;
        }


        $sql2 = "SELECT * FROM tasks WHERE applicantEmail = '$email'";
        $res = mysqli_query($mysqli, $sql2);

        while($rows = mysqli_fetch_row($res)){
            if($rows[1]==1){
                if($rows[2]=="myNameIs('jane');" || $rows[2]=="myNameIs(\"jane\");"){
                    $score +=3;
                    array_push($skill,"PHP");
                    // echo "1<br>";
                }
            }
            else if($rows[1]==2){
                
                if(str_replace(" ","",$rows[2]) =="SELECT*FROMusersWHEREamount>400;"){
                    $score +=3;
                    array_push($skill,"SQL");
                    // echo "2<br>";
                }
            }
 
            else if($rows[1]==3){
                if($rows[2]=="required"){
                    $score +=1;
                    array_push($skill,"HTML");
                    // echo "3<br>";
                }
            }
 
            else if($rows[1]==4){
                if($rows[2]=="JavaSwing"){
                    $score +=1;
                    array_push($skill,"Java");
                    // echo "4<br>";
                }
            }
 
            else if($rows[1]==5){
                if(str_replace(" ","", $rows[2])=="file_put_contents(\$log_file,\"ThisisSir\");" || str_replace(" ","", $rows[2])=="file_put_contents(\$log_file,'ThisisSir');" ){
                    $score +=5;
                    array_push($skill,"PHP");
                    // echo "5<br>";
                }
            }
 
            else if($rows[1]==6){
                if(str_replace(" ","", $rows[2])=="SELECTDISTINCT(amount)FROMtableaUNIONSELECT*FROMtableb"){
                    $score +=5;
                    array_push($skill,"SQL");
                    // echo "6<br>";
                }
            }
 
            else if($rows[1]==7){
                $text = $rows[2];
                $text = preg_replace("/\R/", "", $text);
                $text = str_replace(" ","",$text);
                if($text=="defcomplexCode(x,y):return{'x':x,'y':y}"){
                    $score +=8;
                    array_push($skill,"Python");
                    // echo "7<br>";
                }
                // echo str_replace(" ","", $rows[2]);
            }
 
            else if($rows[1]==8){
             $text = $rows[2];
             $text = preg_replace("/\R/", "", $text);
             $text = str_replace(" ","",$text);
                if($text=="num<6?console.log(6):console.log(0);"){
                    $score +=7;
                    array_push($skill,"JavaScript");
                    // echo "8<br>";
                }
            }
 
            else if($rows[1]==9){
                if($rows[2]=="num+=1"){
                    $score +=2;
                    array_push($skill,"Problem Solver");
                    // echo "9<br>";
                }
            }
 
            else if($rows[1]==10){
                $text = $rows[2];
                $text = preg_replace("/\R/", "", $text);
                $text = str_replace(" ","",$text);
                if($text=="No"){
                    $score +=2;
                    array_push($skill,"Android");
                    // echo "10<br>";
                }
                // echo $rows[2];
            }
 
            else if($rows[1]==11){
             $text = $rows[2];
             $text = preg_replace("/\R/", "", $text);
             $text = str_replace(" ","",$text);
                if($text=="withopen('file.txt')asf:forlineinf:print(line)"){
                    $score +=10;
                    array_push($skill,"Python");
                    // echo "11<br>";
                }
                // echo str_replace(" ","", $rows[2]);
            }
 
            else if($rows[1]==12){
                if(str_replace(" ","", $rows[2])=="constantproduct=(x,y)=>x*y;"){
                    $score +=7;
                    array_push($skill,"JavaScript");
                    // echo "12<br>";
                }
            }
 
            else if($rows[1]==13){
                if(strpos($rows[2], "security") || strpos($rows[2], "injection")){
                    $score +=5;
                    array_push($skill,"SQL Expert");
                    // echo "13<br>";
                }
            }

        }

        // echo "<br>".$score."<br>";
        $skillCount = count($skill);
        $skills = implode(" ",$skill);
        $level = "Beginner";
        if($score > 44){
            $level = "Expert";
        }
        else if($score >24){
            $level = "Intermediate";
        }
        $sql3 = "UPDATE applicantDetails SET score = '$score', skills = '$skills', level = '$level', skillsCount = '$skillCount' WHERE applicantEmail = '$email'";
        mysqli_query($mysqli, $sql3);

        echo "<script>alert('Responses saved successfully check your profile page to see your score')</script>";

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

    <div class="card m-5">
        <div class="card m-5 text-center bg-dark">
            <h4 class="text-light m-2">Below are some guidelines for using our website</h4>
            <div class="card m-3 border-1">
                <div class="card-body">
                    <h5 class="card-title text-light text-center bg-success rounded-circle" style="width: 1rem;">1</h5> <br>
                    <p>Registration is one time, once you register the next you visit our site just click on login button
                        on the top right corner of registration page.
                    </p>

                </div>
            </div>
                
            <div class="card m-3 border-1">
                <div class="card-body">
                    <h5 class="card-title text-light text-center bg-success rounded-circle" style="width: 1rem;">2</h5> <br>
                    <p>All services in our site are free, companies should not ask you for any payments prior to giving you a job.
                    </p>

                </div>
            </div>
                
            <div class="card m-3 border-1">
                <div class="card-body">
                    <h5 class="card-title text-light text-center bg-success rounded-circle" style="width: 1rem;">3</h5> <br>
                    <p>Jobs given to you will appear in the job history, once a company gives you a job you will be notified via SMS.
                        SMSs will be send to the number you register with, you can always change this number in the profile page which can be accessed
                        from the navigation bar.
                    </p>

                </div>
            </div>
            
            <div class="card m-3 border-1">
                <div class="card-body">
                    <h5 class="card-title text-light text-center bg-success rounded-circle" style="width: 1rem;">4</h5> <br>
                    <p>Companies can revoke a job even after they have given it to you, though this is limited you do not have to worry
                        always check your email for such notifications.
                    </p>

                </div>
            </div>

            <div class="card m-3 border-1">
                <div class="card-body">
                    <h5 class="card-title text-light text-center bg-success rounded-circle" style="width: 1rem;">5</h5> <br>
                    <p>If you encounter any issues you can report through the report issue page which is accessible from the 
                        navigation bar.
                    </p>

                </div>
            </div>
        
            <div class="card m-3 border-1">
                <div class="card-body">
                    <h5 class="card-title text-light text-center bg-success rounded-circle" style="width: 1rem;">6</h5> <br>
                    <p>We have included our contacts in the footer in case you need to contact us, You can email us now by clicking <a href="mailto:mumbekyengo19@gmail.com">here</a>

                </div>
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

<?php
}




// if($timeDifference >0){
    echo "<div class = 'card bg-dark'>".gmdate("H:i:s", $timeDifference);

// }
// else{
//     echo "00:00";

// }
?>

