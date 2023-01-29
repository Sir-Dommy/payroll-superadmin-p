<?php

session_start();


use PHPMailer\PHPMailer\PHPMailer;
USE PHPMailer\PHPMailer\Exception;

date_default_timezone_set('Africa/Nairobi');

$mysqli = new mysqli('localhost', 'root', '', 'outsourcing');

$jobId = $_SESSION['jobId'];

$emailC = $_SESSION['email'];

// $sql1 = "SELECT * FROM jobApplications WHERE jobId='$jobId' AND applicationStatus='Applied'";

// $res1 = mysqli_query($mysqli, $sql1);

// $applicantCount = mysqli_num_rows($res1);

$key="12345";
foreach ($_POST as $key => $value){
  $email1 = substr($key,4);
  $email = str_replace('_','.',$email1);
  $time = date('Y-m-d h:i:sa');

  $email3 = $email; //$email3 to be used when sending email to applicant
   
  if(substr($key, 0,4)== "succ"){

    $email1 = mysqli_real_escape_string($mysqli, $email);
    $sql1 = "SELECT * FROM applicantdetails where applicantEmail = '$email1'";

    $res1 = mysqli_query($mysqli, $sql1);
    $rows1 = mysqli_fetch_row($res1);

    $phone  = $rows1[2];
  
    $sql1 = "SELECT * FROM jobapplications WHERE jobId = '$jobId'";
  
    $res1 = mysqli_query($mysqli, $sql1);
  
    $num_rows = mysqli_num_rows($res1);
  
    if($num_rows<1){
      $sql = "INSERT INTO jobapplications SET
      dateGivenJob = '$time',
      jobId = '$jobId',
      companyEmail = '$emailC',
      applicantEmail = '$email';";
  
      $res = mysqli_query($mysqli,$sql);

      $sql2 = "UPDATE jobdetails SET status = 'Given' WHERE jobId = '$jobId'";
      $res2 = mysqli_query($mysqli, $sql2);
  
      if($res && $res2){
  
// $curl = curl_init();
// curl_setopt_array($curl, array(
//   CURLOPT_URL => 'https://api.mobitechtechnologies.com/sms/sendsms',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 15,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'POST',
//   CURLOPT_POSTFIELDS =>'{
//     "mobile": "0757388505",
//     "response_type": "json",
//     "sender_name": "23107",
//     "service_id": 0,
//     "message": "Hello, Sir Dommy"
// }',
//   CURLOPT_HTTPHEADER => array(
//     'h_api_key: 623a5480392b873431384ebd4d2c9bafefeffaa1ffe9dd9b178eeccc84074f24',
//     'Content-Type: application/json'
//   ),
// ));

// $response = curl_exec($curl);

// curl_close($curl);
// echo $response."<br>";

// $response = substr($response, 17,4);

// if($response == '1000'){
//   echo "<script> alert ('Success! Message has been queued for sending') </script>";
// }

// else{
//   echo "<script> alert ('Message not send! Contact admin for help') </script>";
// }



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

$email -> addAddress($email3);
$email -> isHTML(true);

$email -> Subject = 'Verification Email';
$email -> Body = 'You have been given a job, check out for job ID: '.$jobId.' in out website and accept if you are interested';

$email -> send();
  
        echo "<script>
        alert('Job given successifully, await applicant to accept your job we will notify you via email')
        </script>";
      }
  
    }

  else{

    echo "<script>
    alert('Job already given out')
    </script>";
  }

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

<app-companynav></app-companynav>
            
<!-- <div class="col-lg-1"> -->
  <div class="card m-2 border-1">
    <h4 class="text-center">Job Id: <?php echo $_SESSION['jobId'];?> </h4>

    <div class="card-body overflow-auto">   
    <a href="companyHomePage.php" class="btn btn-primary float-end">Back</a>             

<?php

$sql = "SELECT * FROM jobdetails WHERE jobId = '$jobId'";
$rows = mysqli_fetch_row(mysqli_query($mysqli, $sql));

$skills = $rows[6];
$level = $rows[7];

$skills =  explode(" ",$skills);

$skill1 = $skill2 = $skill3 = $skill4 = $skill5 = $skill6 = $skill7 = " ";

if(isset($skills[1])){
  $skill1 = $skills[1];
}
if(isset($skills[2])){
  $skill2 = $skills[2];
}
if(isset($skills[3])){
  $skill3 = $skills[3];
}
if(isset($skills[4])){
  $skill4 = $skills[4];
}
if(isset($skills[5])){
  $skill5 = $skills[5];
}
if(isset($skills[6])){
  $skill6 = $skills[6];
}
if(isset($skills[7])){
  $skill7 = $skills[7];
}
    $sql1 = "SELECT * FROM applicantdetails WHERE skills LIKE '%$skill1%' AND  skills LIKE '%$skill2%' AND  skills LIKE '%$skill3%' AND  skills LIKE '%$skill4%' AND  skills LIKE '%$skill5%' AND  skills LIKE '%$skill6%' AND  skills LIKE '%$skill7%' AND status = 'Verified' AND level = '$level' ORDER BY skillsCount DESC";
    // $sql1 = "SELECT * FROM applicantDetails WHERE skills LIKE '%' '%'";

    $res1 = mysqli_query($mysqli, $sql1);

    if(mysqli_num_rows($res1)>0){
      echo " 
      <div class='card text-center text-primary fs-3 border-0'>
      We found you the best match!
    </div>";

      while($rows1 = mysqli_fetch_row($res1)){
        $successEmail = $rows1[5];
                                                            
            echo "                   
          <div class='card m-4 border-1'>
            <div class='card-body'>
            <form method = 'POST'>
                <p>
                    <b>Applicant Name: </b>".$rows1[0]." ".$rows1[1]."<br>
                    <b>Phone Number: </b> 0". $rows1[2] ."<br>
                    <b>Level: </b>".$rows1[13]."<br>
                    <b>Skills: </b> ". $rows1[11] ." <br>
                    <b>Availability: </b> ". $rows1[4] ." <br>
                    <b>Email: </b> ". $rows1[5] ." <br>
                    
                    <button class= 'btn btn-primary' type = 'Submit' name=' succ$successEmail'>
                        Give Job
                    </button>
  
                </p>
            </form>
            </div>
            </div> ";
           
    }

    }

  else{
    echo "<p class = 'text-center text-danger fs-4'>No avaiable matches now, please check again after some time.</p>";
  }

    // $sql1 = "SELECT * FROM applicantdetails WHERE (skills LIKE '%$skill1%' OR  skills LIKE '%$skill2%' OR  skills LIKE '%$skill3%' OR  skills LIKE '%$skill4%' OR  skills LIKE '%$skill5%' OR  skills LIKE '%$skill6%' OR  skills LIKE '%$skill7%') AND status = 'Verified' and availability != 'Engaged' ORDER BY skillsCount DESC LIMIT 12";
    // // $sql1 = "SELECT * FROM applicantDetails WHERE skills LIKE '%' '%'";

    // $res1 = mysqli_query($mysqli, $sql1);

    // echo " 
    // <div class='card text-center fs-3 border-0'>
    // Available Matches
    // </div>";

    // while($rows1 = mysqli_fetch_row($res1)){
    //   $successEmail = $rows1[5];

    //   echo "
    //  <div class='card m-4 border-1'>
    //   <div class='card-body'>
    //   <form method = 'POST'>
    //       <p>
    //           <b>Applicant Name: </b>".$rows1[0]." ".$rows1[1]."<br>
    //           <b>Phone Number: </b> 0". $rows1[2] ."<br>
    //           <b>Level: </b>".$rows1[13]."<br>
    //           <b>Skills: </b> ". $rows1[11] ." <br>
    //           <b>Availability: </b> ". $rows1[4] ." <br>
    //           <b>Email: </b> ". $rows1[5] ." <br>
              
    //           <button class= 'btn btn-primary' type = 'Submit' name=' succ$successEmail'>
    //               Give Job
    //           </button>

    //       </p>
    //   </form>
    //   </div>
    // </div> ";
    // }


    ?>
      <a href="companyHomePage.php" class="btn btn-primary">Back</a>            

      </div>

    </div>


    <app-footer></app-footer>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<script src="..\\components.js"></script>
<!-- <script src="new.js"></script> -->


</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <script src="new.js"></script> -->

</html>
