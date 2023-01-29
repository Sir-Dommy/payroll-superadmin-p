<?php
session_start();
// $_SESSION['email'];


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

if(isset($_POST['submitResponse'])){
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

     $sql = "SELECT * FROM tasks WHERE applicantEmail = '$email'";

     if(mysqli_num_rows(mysqli_query($mysqli, $sql))>0){
        echo "<script>alert('You have already submitted your responses')</script>";
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
                str_replace(" ","",$text);
                if($text == "defcomplexCode(x,y)return{'x':x,'y':y}"){
                    $score +=8;
                    array_push($skill,"Python");
                    // echo "7<br>";
                }
                // defcomplexCode(x,y)return{'x':x,'y':y}
            }

            else if($rows[1]==8){
                if( str_replace(" ","",$rows[2])=="num<6?console.log(6):console.log(0);"){
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
                if($text == "withopen('file.txt')asf:forlineinf:print(line)"){
                    $score +=10;
                    array_push($skill,"Python");
                    // echo "11<br>";
                }
                // withopen('file.txt')asf:forlineinf:print(line)
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


        <!-- <div class="col-lg-1"> -->
        <div class="card m-2 border-1">
            <div class="card-body">

                <h4 class="text-center mt-5">Complete the tasks below to stand a chance to be picked by an employer</h4>

                    <p class="text-success text-center">Ensure that you are ready for the task because no retries are offered and you need to respond in 30 minues!!!</p>
                    <h3 class="text-danger d-flex justify-content-end postion-fixed" id = "response">Timer 30.00MINS</h3> <br>

                <div class='card m-4 border-1'>
                    <form action="response.php" method="POST">
                        <div class='card-body'>

                            <!-- Task 1 -->
                            <div class="card m-4 border-1">

                                <h4>Task 1</h4> 
                                <p>Complete the following code by calling the defined function (PHP) to print "Jane" (Points: <b>3</b>)</p>
                                <p class="text-success fs-5">&nbsp;&nbsp;&nbsp;&nbsp;function myNameIs($name){<br>
                                    &nbsp;&nbsp;&nbsp;&nbsp; $name;<br>&nbsp;&nbsp;&nbsp;&nbsp;}</p>
                                <input type="text" class="form-control mt-4 mb-4" id="task1" name="task1" placeholder="Write your code here" value = "<?php  $task1 ?>" required>

                            </div>

                            <!-- Task 2 -->
                            <div class="card m-4 border-1">

                                <h4>Task 2</h4> 
                                <p>Write an SQL query to perform the following tasks: (Points: <b>3</b>)</p>
                                <p class="text-success fs-5">&nbsp;&nbsp;&nbsp;&nbsp;Select all elements from users table <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;where amount is greater than 400</p>
                                <input type="text" class="form-control mt-4 mb-4" id="task2" name="task2" placeholder="Write your code here" value = "<?php  $task2 ?>"  required>

                            </div>

                            <!-- Task 3 -->
                            <div class="card m-4 border-1">

                                <h4>Task 3</h4>
                                <p>Select the correct answer (Points: <b>1</b>)</p>
                                <p class="text-success fs-5">&nbsp;&nbsp;&nbsp;&nbsp;Which HTML input attribute is used <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;to ensure that input field is not left blank</p>
                                <select class="form-select mt-4 mb-4" id="task3" name="task3" aria-label="Default select example" value = "<?php  $task3 ?>"  required>
                                    <option selected> <?php  $task3 ?> </option>
                                    <option value="method">method</option>
                                    <option value="required">required</option>
                                    <option value="placeholder">placeholder</option>
                                </select>
                                    
                            </div>

                            <!-- Task 4 -->
                            <div class="card m-4 border-1">
                            
                                <h4>Task 4</h4>
                                <p>Select the correct answer (Points: <b>1</b>)</p>
                                <p class="text-success fs-5">&nbsp;&nbsp;&nbsp;&nbsp;Which Java package is mostly <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;used for UI design</p>
                                <select class="form-select mt-4 mb-4" id="task4" name="task4" aria-label="Default select example" required>
                                    <option selected> <?php  $task4 ?> </option>
                                    <option value="JavaFX">JavaFX</option>
                                    <option value="JavaSpring">JavaSpring</option>
                                    <option value="JavaSwing">JavaSwing</option>
                                    <option value="JavaClasses">JavaClasses</option>
                                </select>

                            </div>

                            <!-- Task 5 -->
                            <div class="card m-4 border-1">

                                <h4>Task 5</h4>
                                <p>Complete the code below to write into the file so that resulting file has the new data only <br>without clearing existing contents (Points: <b>5</b>)</p>
                                <p class="text-success fs-5">&nbsp;&nbsp;&nbsp;&nbsp; $log_file = 'xyz.php'; <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;//write into the file to have this line only --> 'This is Sir'</p>
                                <input type="text" class="form-control mt-4 mb-4" id="task5" name="task5" placeholder="Write your code here" value = "<?php  $task5 ?>"  required>

                            </div>

                            <!-- Task 6 -->
                            <div class="card m-4 border-1">

                                <h4>Task 6</h4> 
                                <p>Write SQL query to acchieve the following function (Points: <b>5</b>)</p>
                                <p class="text-success fs-5">&nbsp;&nbsp;&nbsp;&nbsp; Select all rows distinct rows in tablea and all rows in tableb <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;and produce the result in a single table</p>
                                <input type="text" class="form-control mt-4 mb-4" id="task6" name="task6" placeholder="Hint use UNION" value = "<?php  $task6 ?>"  required>

                            </div>                                

                            <!-- Task 7 -->
                            <div class="card m-4 border-1">

                                <h4>Task 7</h4> 
                                <p>The code below is right though it is a bad programming practice convert it to be <br> explicit and more stratight forward (Points: <b>8</b>)</p>
                                <p class="text-success fs-5">&nbsp;&nbsp;&nbsp;&nbsp; def complexCode(*args): <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;x, y = args <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return dict(**locals()) </p>

                                <textarea class=" mt-4 mb-4" name="task7" id="task7" cols="50" rows="5" placeholder="Hint summarize to two line of code..." value = "<?php  $task7 ?>"  required></textarea>

                            </div>
                            
                            <!-- Task 8 -->
                            <div class="card m-4 border-1">

                                    <h4>Task 8</h4> 
                                    <p>Convert JS arrow function to single line arrow functions (Points: <b>7</b>)</p>
                                    <p class="text-success fs-5">&nbsp;&nbsp;&nbsp;&nbsp; if(num < 6){ <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;console.log(6)<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;} <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp; else{ <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;console.log(0)<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;}<br></p>
                                    <input type="text" class="form-control mt-4 mb-4" id="task8" name="task8" placeholder="Write your code here..." value = "<?php  $task8 ?>"  required>

                            </div>  
                            
                            <!-- Task 9 -->
                            <div class="card m-4 border-1">

                                    <h4>Task 9</h4> 
                                    <p>Speed Test (Points: <b>2</b>)</p>
                                    <p class="text-success fs-5">&nbsp;&nbsp;&nbsp;&nbsp; Select the best option for fast compilation</p>
                                    <select class="form-select mt-4 mb-4" id="task9" name="task9" aria-label="Default select example" required>
                                        <option selected> <?php  $task9 ?> </option>
                                        <option value="num++">num++</option>
                                        <option value="num+=1">num+=1</option>
                                        <option value="+num+">+num+</option>
                                    </select>

                            </div> 

                            <!-- Task 10 -->
                            <div class="card m-4 border-1">

                                    <h4>Task 10</h4>
                                    <p>Programming knowledge test (Points: <b>2</b>)</p>
                                    <p class="text-success fs-5">&nbsp;&nbsp;&nbsp;&nbsp; Can bytecode written in Java work on Android?</p>
                                    <select class="form-select mt-4 mb-4" id="task10" name="task10" aria-label="Default select example" required>
                                        <option selected> <?php  $task10 ?> </option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>

                            </div> 

                            <!-- Task 11 -->
                            <div class="card m-4 border-1">

                                    <h4>Task 11</h4> 
                                    <p>The code below is right though it is a bad programming practice convert to <br> always close the file without using f.close() statement (Points: <b>10</b>)</p>
                                    <p class="text-success fs-5">&nbsp;&nbsp;&nbsp;&nbsp; f = open('file.txt'): <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;a = f.read() <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;print(a)<br> 
                                        &nbsp;&nbsp;&nbsp;&nbsp;f.close()<br> </p>

                                    <textarea class=" mt-4 mb-4" name="task11" id="task11" cols="50" rows="5" placeholder="Hint use with and for statements" value = "<?php  $task11 ?>"  required></textarea>

                            </div>                                

                            <!-- Task 12 -->
                            <div class="card m-4 border-1">

                                <h4>Task 12</h4> 
                                <p>Simplify single expression inside a function JS to a single line of code (Points: <b>7</b>)</p>
                                <p class="text-success fs-5">&nbsp;&nbsp;&nbsp;&nbsp; constant product = (x,y) =>{ <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return x * y;<br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;} </p>
                                <input type="text" class="form-control mt-4 mb-4" id="task12" name="task12" placeholder="Write your code here..." value = "<?php  $task12 ?>"  required>

                            </div> 

                            <!-- Task 13 -->
                            <div class="card m-4 border-1">

                                <h4>Task 13</h4>
                                <p>SQL knowledge test (Points: <b>5</b>)</p>
                                <p class="text-success fs-5">&nbsp;&nbsp;&nbsp;&nbsp; Why is it paramount to use prepare statement and bind parameters instead of including variables inside SQL queries <br>
                                    </p>
                                <input type="text" class="form-control mt-4 mb-4" id="task13" name="task13" placeholder="Type your response here" value = "<?php  $task13 ?>"  required>

                            </div> 
                            
                        </div>
                        <div class="text-center">
                            <!-- <h4>All your responses will be saved once you click submit button then you will be redirected to homepage</h4> -->
                        <button type="Submit" name = "submitResponse" class="btn btn-primary m-1" data-bs-dismiss="modal">Submit Your Responses</button>  
                        </div>
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

<script type="text/javascript">
    setInterval (function(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET","response.php",false);
        xmlhttp.send(null);
        var timer = "Timer: ";
        var after = " MINS";
        document.getElementById("response").innerHTML = timer.concat(xmlhttp.responseText, after) ;
    }, 1000);
</script>

