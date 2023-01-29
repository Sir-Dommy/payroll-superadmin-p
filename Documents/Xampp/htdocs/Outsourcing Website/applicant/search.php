<?php
session_start();
$email = $_SESSION['email'];


$mysqli = new mysqli('localhost', 'root', '', 'outsourcing');

$email = mysqli_real_escape_string($mysqli, $email);
if(isset($_POST['acceptedJobSearch'])){

 $input = $_POST['acceptedJobSearch'];
 $sql = "SELECT * FROM jobapplications WHERE (jobId LIKE '%{$input}%' OR companyEmail LIKE '%{$input}%') AND (status ='Accepted' AND applicantEmail = '$email')";

  // $sql = "SELECT * FROM jobapplications WHERE companyEmail LIKE '%{$input}%'";
  $res = mysqli_query($mysqli, $sql);

  echo "<div id = 'table' class ='overflow-auto'>
  <table class='table table-hover'>
      <thead>
          <tr>
          <th scope='col'>Job Id</th>
          <th scope='col'>Job Title</th>
          <th scope='col'>Amount</th>
          <th scope='col'>Company Email</th>
          <th scope='col'>Job Status</th>
          <th scope='col'>Deadline</th>
          <th scope='col'>Report Issue</th>
          </tr>
      </thead>
      <tbody>";


          echo "<div class = 'text-center'> <b>Search Results</b> </div>";

              if(mysqli_num_rows($res) < 1){
                  echo "
                      <tr>
                          <td></td>
                          <td></td>
                          <td>  </td>
                          <td colspan ='5' class = 'text-danger'>No results found for search:  ``$input``</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>";
                          
              }
              else{
                  while($rows = mysqli_fetch_row($res)){
                    $jobId = $rows[0];
                    $sql2 = "SELECT * FROM jobdetails WHERE jobId = '$jobId'";

                    // jobId ='$jobId' AND
                    $res2 = mysqli_query($mysqli, $sql2);

                    if(mysqli_num_rows($res2) > 0){
                        while($rows2 = mysqli_fetch_row($res2)){
                                            
                            echo "
                            <tr>
                            <th scope='row'>$rows[0]</th>
                            <td>$rows2[2]</td>
                            <td>$rows2[4]</td>
                            <td><a href='mailto:$rows[1]'>$rows[1]</a></td>
                            <td>$rows[4]</td>
                            <td>$rows2[5]</td>
                            <td>
                                <form method='POST'>
                                    <button type='submit' name='$jobId' class='btn btn-danger'>
                                        Report Issue
                                    </button>
                                </form>
                            </td>
                            </tr>";
                        }
                    }
                  
                  }
              }


  echo "          

          </tbody>
      </table>

  </div> " ;

}

else if(isset($_POST['jobGivenSearch'])){

    $input = $_POST['jobGivenSearch'];
    $sql = "SELECT * FROM jobapplications WHERE (jobId LIKE '%{$input}%' OR companyEmail LIKE '%{$input}%') AND status ='Given' AND applicantEmail = '$email'";
   
    $res = mysqli_query($mysqli, $sql);
   
    // CREATE OR REPLACE VIEW sir AS SELECT jobdetails.jobId, jobdetails.amount, companydetails.companyName,companydetails.companyEmail, jobdetails.deadline FROM jobdetails, companydetails WHERE jobdetails.jobId=60;
    // SELECT * FROM sir;  
   
            echo "<div class = 'text-center'> <b>Search Results</b> </div>";
   
                if(mysqli_num_rows($res) < 1){
                    echo "
                        <p class = 'text-danger text-center'>No results found for search:  ``$input``</td>";             
                }                 

                while($rows = mysqli_fetch_row($res)){

                    $sql1 = "SELECT * FROM jobDetails WHERE jobId = '$rows[0]' AND status = 'Given'";
                    $res1 = mysqli_query($mysqli, $sql1);

                    while($rows1 = mysqli_fetch_row($res1)){


                        echo "<form method = 'POST'>
                        <div class='card m-2'>
                        <div class='card-body'>
                            <p> <b>Job ID: </b>$rows[0] </p>
                            <p> <b>Job Title: </b>$rows1[2] </p>
                            <p> <b>Job Description: </b>$rows1[3] </p>
                            <p> <b>Amount to be paid: </b>$rows1[4] </p>
                            <p> <b>Deadline: </b>$rows1[5] </p>
                            <p> <b>Skills needed: </b>$rows1[3] </p>
                            <button type='Submit' name = 'reje$rows[0]' class='btn btn-danger m-1' data-bs-dismiss='modal'>Reject</button> 
                            <button type='Submit' name = 'acce$rows[0]' class='btn btn-primary m-1' data-bs-dismiss='modal'>Accept</button>  

    
                        </div>
                        </div>
                        </form>";
                    }



                }
      
}


else if(isset($_POST['companySearch'])){

    $input = $_POST['companySearch'];
    $sql = "SELECT * FROM companydetails WHERE companyName LIKE '%{$input}%' OR CompanyPhoneNumber LIKE '%{$input}%' OR areYouRegistered LIKE '%{$input}%' OR companyEmail LIKE '%{$input}%' OR companyWebsite LIKE '%{$input}%' OR companyKey LIKE '%{$input}%' ";
   
     $res = mysqli_query($mysqli, $sql);
   
     echo "<div id = 'table' class ='overflow-auto'>
     <table class='table table-hover'>
        <thead>
            <tr>
            <th scope='col'>Company Name</th>
            <th scope='col'>Phone</th>
            <th scope='col'>Is Registerd?</th>
            <th scope='col'>Company Email</th>
            <th scope='col'>Company Website</th>
            <th scope='col'>Company Key</th>
            <th scope='col'>Status</th>
            </tr>
        </thead>
        <tbody>";
   
   
             echo "<div class = 'text-center'> <b>Search Results</b> </div>";
   
                 if(mysqli_num_rows($res) < 1){
                     echo "
                         <tr>
                             <td></td>

                             <td colspan ='5' class = 'text-danger'>No results found for search:  ``$input``</td>

                             <td></td>
                         </tr>";
                             
                 }
                else{
                     while($rows = mysqli_fetch_row($res)){
                        echo "
                        <tr>
                            <td>$rows[0]</td>
                            <td>0$rows[1]</td>
                            <td>$rows[2]</td>
                            <td>$rows[3]</td>
                            <td>$rows[4]</td> ";

                            if(strlen($rows[5])>1){
                            echo "<td>$rows[5]</td> 
                            </tr>";

                            }

                            else{
                                echo "<td>
                                        <form method = 'POST'>
                                            <button type='Submit' name = 'setKey' class='btn btn-success m-1'>Set Key</button> 
                                        </form>
                                    </td> 
                                </tr>";
                            }
                        
                    }
                     
                }
                 
   
   
     echo "          
   
             </tbody>
         </table>
   
     </div> " ;
   
}

?>