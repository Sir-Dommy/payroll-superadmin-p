<?php
if(isset($_POST['logOut'])){
    header('location: ../index.php');
    echo "logging out...";
    exit();
}