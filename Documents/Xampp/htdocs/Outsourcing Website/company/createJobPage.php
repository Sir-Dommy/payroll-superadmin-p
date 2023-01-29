<?php

use function PHPSTORM_META\type;

session_start();

$companyEmail = $_SESSION['email'];

$skills = "";

if(isset($_POST['submitJob'])){
    $jobTitle=$_POST['jobTitle'];
    $jobDescription=$_POST['jobDescription'];
    $amount=$_POST['amount'];
    $deadline=$_POST['deadline'];

    if(isset($_POST['PHP'])){
      $skills .= "PHP ";
    }
    if(isset($_POST['JavaScript'])){
      $skills .= "JavaScript ";
    }
    if(isset($_POST['Python'])){
      $skills .= "Python ";
    }
    if(isset($_POST['SQL'])){
      $skills .= "SQL ";
    }
    if(isset($_POST['Java'])){
      $skills .= "Java ";
    }
    if(isset($_POST['Ruby'])){
      $skills .= "Ruby ";
    }
    if(isset($_POST['other'])){
      $skills .= "Other ";
    }

    $mysqli = new mysqli('localhost', 'root', '', 'outsourcing');
    $log_time = date('Y-m-d h:i:sa');
  //  function isRealDate($date){
  //   echo $date;
  //   if(false === strtotime($date)){
  //     return false;
  //   }
  //   if(true === strtotime($date)){
  //     return true;
  //   }

  //   if(strpos("/",$date)){
  //     echo $date;
  //     list($year, $month, $day) = explode('/', $date);
  //     return checkdate($month,$day,$year);
  //   }
  //   if(strpos("-",$date)){
  //     list($year, $month, $day) = explode('-', $date);
  //     return checkdate($month,$day,$year);
  //   }
  //   // else{
  //   //   return true;
  //   // }
 
  //  }

    if(strlen($skills)<1 || strlen($jobTitle)<5 || strlen($jobTitle)>49 || is_numeric($jobTitle) || strlen($jobDescription)<5 || is_numeric($jobDescription) || is_numeric($amount) == false || $amount<1 || $amount>1000000000){
      // isRealDate($deadline);
      if(strlen($skills)<1){
        echo "<script> alert('Select atleast one skill'); </script>";
      }
      if(strlen($jobTitle)<5 || strlen($jobTitle)>49 || is_numeric($jobTitle)){
        echo "<script> alert('Job title should be between 5 to 49 non-numeric characters'); </script>";
      }
      if(strlen($jobDescription)<5 || is_numeric($jobDescription)){
        echo "<script> alert('Job description should be more than 5 non-numeric characters'); </script>";
      }
      // if(isRealDate($deadline) == false){
      //   echo "<script> alert('Please enter a valid date'); </script>";
      // }
      if (is_numeric($amount) == false || $amount<1 || $amount>1000000000){
        echo "<script> alert('Amount must be a number between 1 - 1000000000'); </script>";
     
      }


    }


    else{
      // isRealDate($deadline);

      $t = date('Y-m-d');

      $t = strtotime($t);

      if(strtotime($deadline) && strtotime($deadline) >= $t){
        $deadline = date('Y-m-d', strtotime($deadline));

        $companyEmail = mysqli_real_escape_string($mysqli, $companyEmail);
        $level = $_POST['level'];
  
        $jobTitle = mysqli_real_escape_string($mysqli, $jobTitle);
        $jobDescription = mysqli_real_escape_string($mysqli, $jobDescription);
  
        // $sql = "SELECT * FROM jobDetails WHERE companyEmail = '$companyEmail' AND jobTitle = '$jobTitle'";
  
        $sql2 = "INSERT INTO jobDetails SET
        companyEmail = '$companyEmail',
        jobTitle = '$jobTitle',
        jobDescription = '$jobDescription',
        amount = '$amount',
        deadline = '$deadline',
        skills = '$skills',
        level = '$level'
        ";  
  
        // $res = mysqli_query($mysqli, $sql);
              
        // if(mysqli_num_rows($res) > 0){
        //   echo "<script> alert('Job matching these details already exists please, check it out in your history'); </script>";
        // }
  
        // else{
  
          if(mysqli_query($mysqli, $sql2)){
            echo "<script> alert('Job saved successfully, check it out in the home tab'); </script>";
  
          }
          else{
              echo "<script> alert('Sorry an error occurred please retry'); </script>";
          }
  
        // }

      }
      else{
        echo "<script> alert('Enter a valid date'); </script>";
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
    <link href=
	"https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
		rel="stylesheet" />
	<script src="https://code.jquery.com/jquery-1.10.2.js">
	</script>
	<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js">
	</script>

	<!-- Javascript -->
	<script>
		$(function () {
			$("#deadline").datepicker({
				// minDate: new Date(2022, 1 - 1, 1)
                minDate: 0
			});
		});
	</script>
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

    <!-- Create Job> -->
    <div class="card m-2 border-1">
        <div class="card-body">

        <form action="" method="POST">

            <div class="mb-3">
                <label for="jobTitle" class="form-label">Job Title <i>(Type of the Job)</i></label>
                <input type="name" class="form-control" id="jobTitle" name="jobTitle" required>
            </div>

            <div class="mb-3">
                <label for="jobDescription" class="form-label">Job description </label>
                <textarea class="form-control" id="jobDescription" name="jobDescription" required> </textarea>
            </div>

            <!-- Select Skills -->
            <div class="mb-3">
              <label for="availability" class="form-label">Select Skills (You must select atleast one)</label> <br>
              <fieldset>
                <input type="checkbox" name="PHP" value = "PHP" > PHP &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="Java" value = "Java" > Java &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="JavaScript" value = "JavaScript" > JavaScript &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="Python" value = "Python" > Python &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="SQL" value = "SQL" > SQL &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="Ruby" value = "Ruby" > Ruby &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="Node" value = "JavaScript" > NodeJs &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="PHP" value = "PHP" > Laravel &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="other" value = "other" > Other &nbsp;&nbsp;&nbsp;&nbsp;
              </fieldset>
            </div>

            <!-- Select level -->
            <div class="mb-3">
                <label for="availability" class="form-label">Select level of skills</label>
                    <select class="form-select" id="level" name="level" aria-label="Default select example" required>
                        <option value="Expert">Expert</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Beginner">Beginner</option>
                    </select>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Amount to be paid for the job <i>(Amount in Kenyan Shillings 1 - 1000000000)</i></label>
                <input type="name" class="form-control" id="amount" name="amount" required>
            </div>


            <div class="mb-3">
                <label for="deadline" class="form-label">Deadline for Submission</label>
                <input type="text" class="form-control" id="deadline" name="deadline" aria-describedby="emailHelp" autocomplete="off" placeholder="Click to pick a date" required>
            </div>

            <div class="card border-0" style="height: 4rem;">
                <div class="d-flex justify-content-center">
                    <!-- Clear and Submit Job button -->
                    <button type="Reset" class="btn btn-danger m-2">Clear</button>
                    <button type="Submit" class="btn btn-primary m-2" name="submitJob">Submit Job</button>  
                </div>
            </div>

        </form>

        </div>

    </div> 
    <!-- Code for the login popup page -->
<div class="modal" tabindex="-1" id="success1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-success">Success</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<!-- Login form -->
            <p class="text-success"> Job Saved Successifully</p>

      </div>

    </div>
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

<?php
if(isset($_POST['submitJob'])){


}

                ?>
</body>

<script src="new.js"></script>

</html>
