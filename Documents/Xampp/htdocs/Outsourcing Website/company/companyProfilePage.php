<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'outsourcing');
$companyPhoneNumberErr ="";

if(isset($_SESSION['email'])){
    $companyEmail1 = $_SESSION['email'];

    $sql1 = "SELECT * FROM companyDetails WHERE companyEmail = '$companyEmail1';";

    $res1 = mysqli_query($mysqli, $sql1);
    $rows = mysqli_fetch_row($res1);


    if(isset($_POST['update'])){
        $email10 = $_POST['companyEmail'];
        $sql10 = "SELECT * FROM companydetails WHERE companyEmail = '$email10'";
        $res10 = mysqli_query($mysqli, $sql10);
        $companyPhoneNumber = $_POST['companyPhoneNumber'];

        if((substr($companyPhoneNumber,0,2) != '07' && substr($companyPhoneNumber,0,2) != '01') || (strlen($companyPhoneNumber) != 10) ){
            $companyPhoneNumberErr = "Enter a valid phone number";
            echo "<script>alert('Failed!!! please enter valid details')</script>";

        }
        else if(mysqli_num_rows($res10)<1){
            $companyEmail = mysqli_real_escape_string($mysqli, $_POST['companyEmail']);
            $companyWebsite = mysqli_real_escape_string($mysqli, $_POST['companyWebsite']);
    
            $sql = "UPDATE companyDetails SET
            companyPhoneNumber = '$companyPhoneNumber',
            companyEmail = '$companyEmail',
            companyWebsite = '$companyWebsite'
            WHERE companyEmail = '$companyEmail1';";
    
            if(mysqli_query($mysqli, $sql)){
                $_SESSION['email'] = $companyEmail;
                echo "<script> alert('Your details have been updated successifully') </script>";
            }
            
        }
        else{
            echo "<script> alert('User with matching details already exists') </script>";
  
        }

    }

}
else{
    echo "<script>alert('Sorry You are not logged in');</script>";
}

$name = $_SESSION['companyName'];

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

    <!-- Two cards one for side menu (left) and respective conetent on right -->
    <h3 class='text-success text-center'>Hello <?php echo $name; ?>!</h3>

    <form action="" method="POST">


    <!-- <div class="col-lg-1"> -->
        <div class="card m-2 border-1">
            <div class="card-body">

                <fieldset id = "disableEdit">
                    <div class="text-center fs-4">
                        <button class="btn btn-primary" id = "edit">
                            Edit &nbsp;
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                </svg>
                        </button>
                    </div>
                </fieldset>


                <fieldset disabled id = "disableForm">

                        <div class="mb-3">
                            <label for="companyPhoneNumber" class="form-label">Company Phone Number</label>
                            <input type="name" class="form-control" id="companyPhoneNumber" name="companyPhoneNumber" value = <?php echo "0$rows[1]" ?> required>
                            <p class="text-danger"> <?php echo $companyPhoneNumberErr; ?></p> 
                            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                        </div>
                        
                        <div class="mb-3">
                            <label for="companyEmail" class="form-label">Company Email address</label>
                            <input type="email" class="form-control" id="companyEmail" name="companyEmail" aria-describedby="emailHelp" value = <?php echo "$rows[2]" ?> required>
                            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                        </div>

                        <div class="mb-3">
                            <label for="companyWebsite" class="form-label">Enter company website (<i>Optional</i>)</label>
                            <input type="name" class="form-control" id="companyWebsite" name="companyWebsite" aria-describedby="emailHelp" value = <?php echo "$rows[3]" ?>>
                            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                        </div>

                        <div class="card border-0" style="height: 4rem;">
                        <div class="d-flex justify-content-center">

                            <button type="Reset" class="btn btn-primary m-2">Reset</button>  
                            <button type="Submit" name = "update" class="btn btn-danger m-2" data-bs-dismiss="modal">Update</button>  
                        </div>
                    </div>

                </fieldset>
            </div>

        </div>
    </form>

    <app-footer></app-footer>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<script>
    var edit = document.getElementById('edit');
    edit.onclick = () =>{
    document.getElementById('disableForm').disabled = false;

    document.getElementById('disableEdit').disabled = true;
    };
</script>

<script src="..\\components.js"></script>  </body>
<script src="new.js"></script>

</html>