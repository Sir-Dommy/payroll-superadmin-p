<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
    <textarea name="text" id="" cols="30" rows="10"></textarea>
    <button type="submit" name="go">Submit</button>
    </form>
</body>
</html>

<?php
if(isset($_POST['go'])){
    $text = $_POST['text'];

echo $text = preg_replace("/\R/", "", $text)."<br>";
echo str_replace(" ","",$text);


}
?>

<?php

// use PHPMailer\PHPMailer\PHPMailer;
// USE PHPMailer\PHPMailer\Exception;


// require 'PHPMailer\PHPMailer-master\src\Exception.php';
// require 'PHPMailer\PHPMailer-master/src/PHPMailer.php';
// require 'PHPMailer\PHPMailer-master/src/SMTP.php';

// $email = new PHPMailer(true);

// $email -> isSMTP();
// $email -> Host = 'smtp.gmail.com';
// $email -> SMTPAuth = true;
// $email -> Username = 'dominickyengo2017@gmail.com';
// $email -> Password = 'htbasuadyapohlun';
// $email -> SMTPSecure = 'ssl';
// $email -> Port = 465;

// $email -> setFrom('dominickyengo2017@gmail.com');

// $email -> addAddress('mumbekyengo19@gmail.com');
// $email -> isHTML(true);

// $email -> Subject = 'Verification Email';
// $email -> Body = 'Your OTP is 1234567';

// $email -> send();

// echo "email send";


?>