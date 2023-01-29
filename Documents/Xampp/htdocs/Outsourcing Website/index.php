 <?php

session_start();
session_destroy();

// echo session_id(); 
// echo "<br>".session_status();

// define("LOG_FILE", "arrow.log");
//     error_log("You are good to go...")

//$log_time = date('Y-m-d h:i:sa');
// $log_msg = "how to create log file in php?";
  
// wh_log($log_msg);
 
// function wh_log($log_msg)
// {
//     $log_filename = "arrow.log";
//     $mysqli = new mysqli('localhost', 'root', '', 'kusoma');
//     $log_time = date('Y-m-d h:i:sa');
//     if(mysqli_errno($mysqli)){
//         error_log("[ERROR: " . date("Y-m-d H:i:s") . "] Connect "
//         . "failed: " . mysqli_connect_error() . "\n", 3, $log_filename);
//     }
//     else{

//         error_log("[SUCCESS: " . date("Y-m-d H:i:s") . "] Connect "
//         . "Succeeded: " . mysqli_connect_error() . "\n", 3, $log_filename);
//     }

    
// }
?>  




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Arrow Outsourcing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body>

        <nav class="navbar bg-light">
        <div class="container overflow-auto">
            <a class="navbar-brand" href="">
            <img src="logo.jpg" alt="Logo" width="30rem" height="24"> <b>Arrow Outsourcing</b>
            </a>
   
            <a class="navbar-brand" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Apply" href="applicant\applicantRegLogin.php">Apply for Jobs</a>
            <a class="navbar-brand btn btn-primary text-light"data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hire" href="company\companyRegLogin.php">Hire IT Specialists</a>
        </div>
        </nav>

        <div class="allHomeCards">
            <div class="row m-2">
                <!-- <div class="col-lg-1"> -->
                    <div class="card m-2 mt-5 border-0" style="width: 38rem;" style="height: 40rem;">
                            <div class="card-body">
                                <h1 class="card-title mt-5">Welcome to Arrow Outsourcing!</h1>
                                <p class="card-text">The best local outsourcing website for IT specialists.</p>
                                <a href="applicant\applicantRegLogin.php" class="btn btn-dark mt-5">Apply for Jobs</a> &#160; &#160;
                                <a href="company\companyRegLogin.php" class="btn btn-primary mt-5">Hire IT experts</a>

                                <p class="mt-5">Do you want to hire or apply for a job? click the above links depending on your choice.</p>
                            </div>
                        </div> 
                    <!-- </div> -->

                    <!-- <div class="col-lg-1"> -->
                    <div class="card m-2 border-0" style="width: 42rem;" style="height: 40rem;">
                        <img src="images/HomePic.jpg" class="card-img-top" alt="Arrow Outsourcing" height="390rem">
                            <div class="card-body">
                                <h5 class="card-title">We allow you to explore the skills and experience of who you hire.</h5>
                            </div>
                        </div>
                    <!-- </div> -->
            </div>
        </div>

        <div class="card ml-5 text-center border-0">
                <div class="card-body">
                    <h5 class="card-title">You are not alone, other firms outsourcing through our website are:</h5>
                </div>
        </div>

        <!-- Start of list of companies outsourcing through our website -->
        <div class="card listOfCompanies border-0">
            <div class="row text-center m-5 mt-0 d-flex justify-content-center overflow-auto">
                <div class="card m-3 border-0" style="width: 12rem;"> <a href="https://equitygroupholdings.com/ke/" target="_blank" class="btn">
                    <img src="images/Equity.png" class="card-img-top" alt="Equity" height="100rem">
                    <div class="card-body">
                        <h5 class="card-title">Equity Bank</h5>
                    </div>  </a>
                </div>

                <div class="card m-3 border-0" style="width: 12rem;"> <a href="https://ke.kcbgroup.com/" target="_blank" class="btn">
                    <img src="images/kcb.jpg" class="card-img-top" alt="KCB Bank" height="100rem">
                    <div class="card-body">
                        <h5 class="card-title">KCB Bank</h5>
                    </div>  </a>
                </div>
                
                <div class="card m-3 border-0" style="width: 12rem;"> <a href="https://www.kplc.co.ke/" target="_blank" class="btn">
                    <img src="images/Kenyapower.jpg" class="card-img-top" alt="Kenya Power" height="100rem">
                    <div class="card-body">
                        <h5 class="card-title">Kenya Power</h5>
                    </div>  </a>
                </div>
                
                <div class="card m-3 border-0" style="width: 12rem;"> <a href="https://www.krc.co.ke/" target="_blank" class="btn">
                    <img src="images/Kenyarailways.jpg" class="card-img-top" alt="Kenya Railways" height="100rem">
                    <div class="card-body">
                        <h5 class="card-title">Kenya Railways</h5>
                    </div>  </a>
                </div>
                
                <div class="card m-3 border-0" style="width: 12rem;"> <a href="https://www.moko.co.ke/" target="_blank" class="btn">
                    <img src="images/moko.png" class="card-img-top" alt="Moko" height="100rem">
                    <div class="card-body">
                        <h5 class="card-title">Moko</h5>
                    </div>  </a>
                </div>
                
                <div class="card m-3 border-0" style="width: 12rem;"> <a href="https://www.tononoka.co.ke/" target="_blank" class="btn">
                    <img src="images/Tononoka.png" class="card-img-top" alt="Tononoka" height="100rem">
                    <div class="card-body">
                        <h5 class="card-title">Tononoka</h5>  
                    </div> </a>
                </div>
            </div>

        </div>
        <!-- End of list of companies outsourcing through our website -->

        <!-- Join Other firms and hire through our website section -->
        <div class="card m-2 mt-5 border-0 text-center">
        
        <h6 class="card-text">Join other firms hiring through our website and enjoy benefits listed below</h6>

            <div class="card-body">

                        <!-- Adavantages Section -->
                <div class="listOfAdvantages1">
                    <div class="row text-center m-5 mt-0 d-flex justify-content-center overflow-auto">
                        <div class="card m-3 border-1" style="width: 20rem;">
                            <div class="card-body">
                                <h5 class="card-title text-success">Access to quality Skills</h5>
                                <p>Check skills of who you hire</p>
                            </div>
                        </div>

                        <div class="card m-3 border-1" style="width: 20rem;">
                            <div class="card-body">
                                <h5 class="card-title text-success">Save on time</h5>
                                <p>We link you to applicants in seconds</p>
                            </div>
                        </div>

                        <div class="card m-3 border-1" style="width: 20rem;">
                            <div class="card-body">
                                <h5 class="card-title text-success">Affordable labour</h5>
                                <p>Local skills are cheaper</p>
                            </div>
                        </div>

                    </div>

                </div>

                <a href="company\companyRegLogin.php" class="btn btn-primary mt-0">Hire IT experts</a>
            </div>
        </div>


        <!-- End of Join Other firms and hire through our website section -->


        <!-- Start of join other IT experts working on Outsourced jobs -->
        <div class="card m-2 mt-5 border-0 text-center">
            <div class="card-body">
                <h6 class="card-text">Join other IT experts enjoying goodies of outsourced jobs</h6>

                        <!-- Adavantages Section -->
                <div class="listOfAdvantages2">
                    <div class="row text-center m-5 mt-0 d-flex justify-content-center overflow-auto">
                        <div class="card m-3 border-1" style="width: 16rem;">
                            <div class="card-body">
                                <h5 class="card-title text-success">Grow your income</h5>
                                <p>Work and earn from unlimited projects</p>
                            </div>
                        </div>

                        <div class="card m-3 border-1" style="width: 16rem;">
                            <div class="card-body">
                                <h5 class="card-title text-success">Expand your skills</h5>
                                <p>Projects come from different fiels of IT</p>
                            </div>
                        </div>

                        <div class="card m-3 border-1" style="width: 16rem;">
                            <div class="card-body">
                                <h5 class="card-title text-success">Retention</h5>
                                <p>Work smart the company may retain you!!!</p>
                            </div>
                        </div>

                        <div class="card m-3 border-1" style="width: 16rem;">
                            <div class="card-body">
                                <h5 class="card-title text-success">Work from anywhere</h5>
                                <p>Work at your own space and time</p>
                            </div>
                        </div>

                    </div>

                </div>

                <a href="applicant\applicantRegLogin.php" class="btn btn-primary mt-0">Apply for Jobs</a>
            </div>
        </div>

        <!-- Start of comment section -->
        <h5 class="text-center mt-5">People are loving our services check their feedback</h5>
        <div class=" card listOfComments text-danger border-0">
            <div class="row text-center m-5 mt-0 d-inline-flex justify-content-center overflow-auto">
                
                <div class="card m-4 border-1" style="width: 20rem;">
                    <div class="card-body">
                        <p><i>"Amazing work from you guys big up..."</i></p>
                        <figcaption class="blockquote-footer mb-0">
                            Senorita
                        </figcaption>
                    </div>
                </div>
                  
                <div class="card m-4 border-1" style="width: 20rem;">
                    <div class="card-body">
                        <p><i>"I recieved payment for my first project thanks Arrow Outsourcing"</i></p>
                        <figcaption class="blockquote-footer mb-0">
                            Sir Dommy
                        </figcaption>
                    </div>
                </div>
                
                <div class="card m-4 border-1" style="width: 20rem;">
                    <div class="card-body">
                        <p><i>"Thank you fo linking me to an IT expert"</i></p>
                        <figcaption class="blockquote-footer mb-0">
                            Moko Furnitures
                        </figcaption>
                    </div>
                </div>

            </div>

        </div>
<!-- End of comments section -->

<!-- Footer section begins -->

<app-footer></app-footer>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

    <script src="components.js"></script>
  </body>
</html>