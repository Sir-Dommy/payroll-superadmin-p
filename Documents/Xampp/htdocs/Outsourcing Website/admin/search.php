<?php

$mysqli = new mysqli('localhost', 'root', '', 'outsourcing');

if(isset($_POST['input'])){

 $input = $_POST['input'];
//  $sql = "SELECT * FROM jobdetails WHERE jobId LIKE '%{$input}%' OR companyEmail LIKE '%{$input}%' OR jobTitle LIKE '%{$input}%' OR status LIKE '%{$input}%' OR amount LIKE  '%{$input}%' OR dateCreated LIKE '%{$input}%' OR deadline LIKE '%{$input}%' OR skills LIKE '%{$input}%' AND level LIKE '%{$input}%' OR status LIKE '%{$input}%' ";
$sql = "SELECT * FROM jobDetails";
  $res = mysqli_query($mysqli, $sql);

  echo "<div id = 'table' class ='overflow-auto'>
  <table class='table table-hover'>
      <thead>
          <tr>
          <th scope='col'>Job Id</th>
          <th scope='col'>Company Name</th>
          <th scope='col'>Applicant Email</th>
          <th scope='col'>Job Title</th>
          <th scope='col'>Amount (KSH)</th>
          <th scope='col'>Date Created</th>
          <th scope='col'>Deadline</th>
          <th scope='col'>Skills</th>
          <th scope='col'>Level</th>
          <th scope='col'>Status</th>
          </tr>
      </thead>
      <tbody>";


          echo "<div class = 'text-center'> <b>Search Results</b> </div>";

            //   if(mysqli_num_rows($res) < 1){
            //       echo "
            //           <tr>
            //               <td></td>
            //               <td></td>
            //               <td>  </td>
            //               <td colspan ='5' class = 'text-danger'>No results found for search:  ``$input``</td>
            //               <td></td>
            //               <td></td>
            //               <td></td>
            //           </tr>";
                          
            //   }
            //   else{
                $count = mysqli_num_rows($res);
                  while($rows = mysqli_fetch_row($res)){
                    $jobId = $rows[0];
                    $companyEmail = $rows[1];
                    $jobTitle = $rows[2];

                    $sql1 = "CREATE OR REPLACE VIEW sir AS SELECT jobdetails.jobId, companydetails.companyName, jobapplications.applicantEmail,jobdetails.jobTitle,jobDetails.amount,jobDetails.dateCreated,jobDetails.deadline,jobDetails.skills,jobDetails.level,jobDetails.status 
                    FROM jobdetails,jobapplications,companydetails 
                    WHERE ( (jobdetails.jobId ='$jobId' AND jobdetails.companyEmail = '$companyEmail' AND jobdetails.jobTitle = '$jobTitle' AND companydetails.companyEmail = '$companyEmail')) ";

                    // AND (jobapplications.jobId = '$jobId' AND jobapplications.companyEmail = '$companyEmail') AND companyDetails.companyEmail = '$companyEmail'

// AND  (companydetails.companyName LIKE '%{$input}%' OR  jobapplications.applicantEmail LIKE '%{$input}%' OR jobdetails.jobTitle LIKE '%{$input}%' OR jobDetails.amount LIKE '%{$input}%' OR jobDetails.dateCreated LIKE '%{$input}%' OR jobDetails.deadline LIKE '%{$input}%' OR jobDetails.skills LIKE '%{$input}%' OR jobDetails.level LIKE '%{$input}%' OR jobDetails.status LIKE '%{$input}%')
                    mysqli_query($mysqli, $sql1);
                    $sql2 = "SELECT * FROM sir WHERE jobId LIKE '%{$input}%' OR companyName LIKE '%{$input}%' OR applicantEmail LIKE '%{$input}%' OR jobTitle LIKE '%{$input}%' OR amount LIKE '%{$input}%' OR dateCreated LIKE '%{$input}%' OR deadline LIKE '%{$input}%' OR skills LIKE '%{$input}%' OR level LIKE '%{$input}%' OR status LIKE '%{$input}%'";

                    $res2 = mysqli_query($mysqli, $sql2);
                    $count -=1;

                    if(mysqli_num_rows($res2) > 0){
                        while($rows2 = mysqli_fetch_row($res2)){
                            // print_r($rows2);
                                            
                            echo "
                            <tr>
                                <td>$rows2[0]</td>
                                <td>$rows2[1]</td>
                                <td><a href='mailto:$rows2[2]'>$rows2[2]</a></td>
                                <td>$rows2[3]</td>
                                <td>$rows2[4]</td>
                                <td>$rows2[5]</td>
                                <td>$rows2[6]</td>
                                <td>$rows2[7]</td>
                                <td>$rows2[8]</td>
                                <td>$rows2[9]</td>
                            </tr>";
                        }
                    }

                    else if($count < 1 && mysqli_num_rows($res2) < 0){
                        // echo mysqli_num_rows($res2);
                        while($rows2 = mysqli_fetch_row($res2)){

                        print_r($rows2);
                        }
                        echo "
                        
                        <tr>
                                <td colspan ='30' class = 'text-danger text-center fs-4'>No results found for search:  ``$input``</td>

                        </tr>";

                        break;

                    }
                  
                  }
            //   }


  echo "          

          </tbody>
      </table>

  </div> " ;

}

else if(isset($_POST['searchApplicant'])){

    $input = $_POST['searchApplicant'];
    $sql = "SELECT * FROM applicantdetails WHERE firstName LIKE '%{$input}%' OR lastName LIKE '%{$input}%' OR phoneNumber LIKE '%{$input}%' OR level LIKE '%{$input}%' OR skills LIKE '%{$input}%' OR availability LIKE '%{$input}%' OR applicantEmail LIKE '%{$input}%' OR status LIKE '%{$input}%'  ";
   
     $res = mysqli_query($mysqli, $sql);
   
     echo "<form method = 'POST'>
     <div id = 'table' class ='overflow-auto'>
     <table class='table table-hover'>
         <thead>
             <tr>
             <th scope='col'>Name</th>
             <th scope='col'>Phone</th>
             <th scope='col'>ID Number</th>
             <th scope='col'>Skills</th>
             <th scope='col'>Level</th>
             <th scope='col'>Availability</th>
             <th scope='col'>Email</th>
             <th scope='col'>Status</th>
             <th scope='col'>Action</th>
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
                            <td>$rows[0]    $rows[1]</td>
                            <td>$rows[2]</td>
                            <td>$rows[3]</td>
                            <td>$rows[11]</td>
                            <td>$rows[13]</td>
                            <td>$rows[4]</td>
                            <td>$rows[5]</td>
                            <td>$rows[8]</td>";
                            $email = $rows[5];
                            if($rows[8] == "Blocked"){
                                echo "<td> <button type = 'Submit' class='btn btn-primary' name='unb$email'>Unblock</button>
                                </td>";
                            }
                            else if($rows[8] == "Verified"){
                                echo "<td> <button type = 'Submit' class='btn btn-danger' name='blo$email'>Block</button>
                                </tr>";
                            }
                            else{
                                echo "<td> </td>
                                </tr>";
                            }
                              
                     
                     }
                 }
   
   
     echo "          
   
             </tbody>
         </table>
   
     </div>
     </form>
     " ;
   
}

else if(isset($_POST['companySearch'])){

    $input = $_POST['companySearch'];
    $sql = "SELECT * FROM companydetails WHERE companyName LIKE '%{$input}%' OR CompanyPhoneNumber LIKE '%{$input}%' OR companyEmail LIKE '%{$input}%' OR companyWebsite LIKE '%{$input}%' OR status LIKE '%{$input}%' ";
   
     $res = mysqli_query($mysqli, $sql);
   
     echo "<div id = 'table' class ='overflow-auto'> <form method = 'POST'>
     <table class='table table-hover'>
        <thead>
            <tr>
                <th scope='col'>Company Name</th>
                <th scope='col'>Phone</th>
                <th scope='col'>Company Email</th>
                <th scope='col'>Company Website</th>
                <th scope='col'>Status</th>
                <th scope='col'>Action</th>
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
                            <td>$rows[6] </td>";
                            $email = $rows[2];
                            if($rows[6] == "Blocked"){
                                echo "<td> <button type = 'Submit' class='btn btn-primary' name='unb$email'>Unblock</button></td>
                                </tr>";
                            }
                            else if($rows[6] == "Verified"){
                                echo "<td> <button type = 'Submit' class='btn btn-danger' name='blo$email'>Block</button>
                                </tr>";
                            }
                            else{
                                echo "<td> </td>
                                </tr>";
                            }
                        
                    }
                     
                }
                 
   
   
     echo "          
   
             </tbody>
         </table>
        </form>
     </div> " ;
   
}

else if(isset($_POST['adminSearch'])){
    $input = $_POST['adminSearch']; 

    // $sql01 = "SELECT * FROM applicantdetails";
    // $sql02 = "SELECT * FROM companydetails";
    // $sql03 = "SELECT * FROM jobdetails";

    // $res01 = mysqli_query($mysqli, $sql01);
    // $res02 = mysqli_query($mysqli, $sql02);
    // $res03 = mysqli_query($mysqli, $sql03);

    // $count = mysqli_num_rows($res01) + mysqli_num_rows($res02) + mysqli_num_rows($res02);

    // $rows01 = mysqli_fetch_row($res01);
    // $rows02 = mysqli_fetch_row($res02);
    // $rows03 = mysqli_fetch_row($res03);
    // while($count >0){
    //     if($rows01 = mysqli_fetch_row($res01)){
    //         echo $emaila = $rows01[5];
    //     }
    //     else if($rows02 = mysqli_fetch_row($res02)){
    //         echo $emailc = $rows02[2];
    //     }
    //     else if($rows03 = mysqli_fetch_row($res03)){
    //         echo $jobida = $rows03[0];

    //     }
    //     $count -=1;
    // }

    $sql = "CREATE OR REPLACE VIEW sir AS SELECT applicantdetails.applicantEmail, applicantdetails.phoneNumber, applicantdetails.identityNumber,
    companydetails.companyName,companydetails.companyPhoneNumber,companydetails.companyEmail, jobdetails.jobId, jobdetails.jobTitle 
    FROM applicantdetails, companydetails, jobdetails";

    mysqli_query($mysqli, $sql);

    $sql2 = "SELECT * FROM sir WHERE applicantEmail LIKE '%{$input}%' OR phoneNumber LIKE '%{$input}%' OR identityNumber LIKE '%{$input}%' OR 
    companyName LIKE '%{$input}%' OR companyPhoneNumber LIKE '%{$input}%' OR companyEmail LIKE '%{$input}%' OR 
    jobId LIKE '%{$input}%' OR jobTitle LIKE '%{$input}%' ";

    $res = mysqli_query($mysqli, $sql2);

    echo "
    <table class='table table-hover'>
    <thead>
        <tr>
        <th scope='col'>First Column</th>
        <th scope='col'>Second Column</th>
        <th scope='col'>View</th>

        </tr>
    </thead>
    <tbody>";
        

            while($rows = mysqli_fetch_row($res)){
                echo "
                <tr>
                
                <td>$rows[0]</td>
                <td>$rows[1]</td>
                <td><button type='Submit' name = 'job$rows[0]' class='btn btn-primary m-1' data-bs-dismiss='modal'>View</button></td>
                </tr>";
            }
        ?>
    </tbody>
</table>
<?php
}

?>