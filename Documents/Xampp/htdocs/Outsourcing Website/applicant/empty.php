<?php
session_start();

if(isset($_POST['continue'])){
    $_SESSION['prev'] = 'resetPassword';
    $_SESSION['email'] = $_POST['email'];
    header('location: verifyEmail.php');
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
    <form action="" method="POST">
        <div class="card mx-auto mt-5" style="width: 40rem">
            <div class="m-5 mb-2">
                <label for="email" class="form-label">Enter your email and press continue, we will send you a verfication code</label>
            </div>
            <div class="m-3">
                <input type="email" class="form-control" id="email"  name="email" placeholder = "senor@gmail.com" required>
            </div>
            <div class="m-3">
                <button type="Reset" class="btn btn-danger mt-1 mb-1 m-3">Clear</button>
                <button type="Submit" class="btn btn-primary mt-1 mb-1 m-3" data-bs-dismiss="modal" name="continue">Continue</button>  
            </div>

            <div class="m-3">
                <a class="btn btn-secondary" href="applicantRegLogin.php">Back</a>            
            </div>
        </div> 
    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</body>
</html>

