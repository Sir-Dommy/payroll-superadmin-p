<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>video upload page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <style>
       form{
        border:3px solid red;
        text-align:center;
        padding:3%;
       }
       form input{
        margin:2%;
       }
       form select{
        margin-bottom:3%;
       }
    </style>
</head>
<body>
    <form method="post" action="" enctype="multipart/form-data">
      <input class="form-control" type="file" id="uploadResume" name="file" required>
<br><br>
        <!-- Select Category <br>
        <select name="category" id="" required>
            <option value="None">_select_</option>
            <option value="Proffessional">Proffessional</option>
            <option value="Digital Skills">Digital Skills</option>
            <option value="Lifeskills">Lifeskills</option>
        </select>

        <br><br> -->

        <!-- Video Heading<br> 
        <textarea name="vidName" id="" cols="30" rows="2" required></textarea> <br><br>

        Video description<br> 
        <textarea name="videodescription" id="" cols="30" rows="5" required></textarea> <br><br> -->
        <input type="submit" name="upload" value="upload video"><br><br>
    </form>
    
 


</body>
</html>


<?php
  //  include("..\confirmation.php");

        if(true){

          // $file_content = file_get_contents($_FILES['file']['tmp_name']);

          // echo $file_content;
            $name = $_FILES['file']['name'];
            $target_dir = "resumes/";
            $target_file = $target_dir.$name ;
            $tempfile = $_FILES['file']['tmp_name'];
                if(move_uploaded_file($tempfile,$target_file)){
                  echo "video inserted".sys_get_temp_dir();;
                }
                else{
                    echo "failed to upload video";
                }

            
        }
       

    ?>
