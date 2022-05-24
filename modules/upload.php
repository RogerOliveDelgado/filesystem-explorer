<?php

    $target_dir = "../root/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    // echo "<p>$target_file</p>";

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // echo $imageFileType;

    // echo $_POST['submit']. "<br>";
    // print_r ($_FILES['fileToUpload']);
    if (isset($_POST["submit"])){
        // echo "works";
        // print_r ($_FILES['fileToUpload']);

        // $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        // print_r $check;
        $checkSizeFile = $_FILES['fileToUpload']['size'];

        if ($checkSizeFile){
            // echo "works"; 
            $fileUpLoaded = move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);

            if ($fileUpLoaded){
                echo "File uploaded";
            } else{
                echo "Impossible upload this file";
            }
        }else {
            echo "Please, select a file to upload";
            // echo " no works"; 
        }
    }

    header("location:../index.php");




