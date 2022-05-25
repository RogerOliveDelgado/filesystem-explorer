<?php
session_start();


function uploadFile(){    

    $target_dir = "../root/";
    // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);    
    
    $_SESSION['upLoadedFileName'] = $_FILES["fileToUpload"]["name"];
    $target_file = $target_dir . basename($_SESSION['upLoadedFileName']);    

    // $fileTypeExtension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $_SESSION['fileTypeExtension'] = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // echo $_SESSION["fileTypeExtension"];
    

    // echo $_POST['submit']. "<br>";
    
    if (isset($_POST["submit"])){      
       
        $_SESSION['$checkSizeFile'] = $_FILES['fileToUpload']['size'];

        if ($_SESSION['$checkSizeFile']){
            
            $fileUpLoaded = move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);

            if ($fileUpLoaded){
                echo "File uploaded";           
            } else{
                echo "Impossible upload this file";
            }
        }else {
            echo "Please, select a file to upload";             
        }
    }

    header("location:../index.php");
}

uploadFile();


