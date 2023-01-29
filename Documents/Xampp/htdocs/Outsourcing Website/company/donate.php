<?php

session_start();
// echo session_id();
$mysqli = new mysqli('localhost', 'root', '', 'outsourcing');

$email = mysqli_real_escape_string($mysqli, $_SESSION['email']);

$sql = "SELECT * FROM companyDetails WHERE  companyEmail = '$email'";

$res = mysqli_query($mysqli, $sql);

$rows = mysqli_fetch_row($res);

$rows[1];


# PHP example
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

// file_put_contents('response.json', $response);


if(isset($_POST['submit'])){

  date_default_timezone_set('Africa/Nairobi');

  # access token from Sir Dommy app in daraja
  $consumerKey = 'afYnYW76TbogjR73FblxiZaMQrZbBXX8'; //confidential consumer key from sandbox app (daraja)
  $consumerSecret = '6EdoGFf1RLnhXwAJ'; // confidential consumer secret from sandbox app (daraja)

  # define the variales
  # provide the following details, found on test credentials on the developer account -- daraja
  $BusinessShortCode = '174379'; //This is the sandbox business short code
  $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';  
  
  /*
    This are your info, for
    $PartyA should be the ACTUAL clients phone number or your phone number, format 2547********
    $AccountRefference, it maybe invoice number, account number etc on production systems, but for test just put anything
    TransactionDesc can be anything, probably a better description of or the transaction
    $Amount this is the total invoiced amount, Any amount here will be 
    actually deducted from a clients side/your test phone number once the PIN has been entered to authorize the transaction. 
    for developer/test accounts, this money will be reversed automatically by midnight.
  */
  
    $PartyA = $_POST['phone']; // This is your phone number, 
  $AccountReference = '2255';
  $TransactionDesc = 'Sir Dommy';
  $Amount = $_POST['amount'];

  $PartyA ="254".substr($PartyA,1);
 
  # Get the timestamp, format YYYYmmddhms -> 20181004151020
  $Timestamp = date('YmdHis');    
  
  # Get the base64 encoded string -> $password. The passkey is the M-PESA Public Key
  $Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);

  # header for access token
  $headers = ['Content-Type:application/json; charset=utf8'];

    # M-PESA endpoint urls
  $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

  # callback url
  $CallBackURL = 'https://sir2.000webhostapp.com/callback_url.php';  

  $curl = curl_init($access_token_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($curl, CURLOPT_HEADER, FALSE);
  curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
  $result = curl_exec($curl);
  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  $result = json_decode($result);
  $access_token = $result->access_token; 
  // $access_token = ""; 
  // if($result->access_token){
  // $access_token = $result->access_token;  

  // }
  // else{
  //   echo "<script> alert('Unable to process your request now please ensure you are connected to the internet')</script>";
  // }
  curl_close($curl);

  # header for stk push
  $stkheader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];

  # initiating the transaction
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $initiate_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); //setting custom header

  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => $PartyA,
    'CallBackURL' => $CallBackURL,
    'AccountReference' => $AccountReference,
    'TransactionDesc' => $TransactionDesc
  );

  $data_string = json_encode($curl_post_data);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  $curl_response = curl_exec($curl);
  // print_r($curl_response);

//   echo $curl_response;
// echo substr($curl_response,0,5);

if(strpos($curl_response,'400')){
  echo "<script> alert('Ensure you have entered correct details! Please check your details and retry')</script>";

}
else{
  echo "<script> alert('STK push was sent to your phone please enter your PIN to complete transaction')</script>";

}
  // var_dump($curl_response);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Donate Page</title>
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
    <!-- card for donate before user logs in -->
  <div class="d-flex justify-content-center">
    <div class="card m-3" style="width: 30rem;">
        <div class="card-header">
          <h5 class="card-title text-success">Donate via Mpesa</h5>
        </div>
        <div class="card-body">
        <!-- Login form -->
        <!-- ../stk.php -->
          <form action="" method="POST">
              <div class="mb-3">
                  <label for="amount" class="form-label">Amount</label>
                  <input type="number" class="form-control" name="amount" id="amount" aria-describedby="emailHelp" value="100" required>
                  <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
              </div>

              <div class="mb-3">
                  <label for="phone" class="form-label">Phone Number</label>
                  <input type="tel" class="form-control" name="phone" id="phone" value=<?php echo "0".$rows[1]; ?> required>
              </div>

              <div class="d-flex justify-content-center">
                  <button type="Submit" class="btn btn-success" name="submit">Donate</button>
              </div>

          </form>

        </div>
        <div class="card-footer">
              <p class="text-success mr-1"><i>Lets keep work moving...</i></p>
        </div>
      </div>
  </div>
    
  <app-footer></app-footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="..\\components.js"></script>  </body>

</body>
</html>
