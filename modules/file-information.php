<?php

function createName (){
    return $_SESSION['upLoadedFileName'];
}

// Date which files and directories were uploaded
function creationDate(){      
        $creationDay = date("d");
        // echo '<p>' .date("d"). '</p>';
        $creationMonth = date("M");
        // echo '<p>' .date("m"). '</p>';
        $creationYear = date("y");         
        // echo '<p>' .date("y"). '</p>';
        $creationDate = "$creationMonth $creationDay , $creationYear";
        // echo $creationDate;
        return $creationDate;               
}


// Date which files and directories were modified
function lastModifiedDate(){
    // * PENDING -> Before start with functions that allows to modify the files and directories
}

// Only for files
function extension(){
    return $_SESSION["fileTypeExtension"];
}

 
function size(){
    // less than 1 MB show KB, otherwise show MB
    // $_FILE["...."][size] => bytes  
    if ($_SESSION['$checkSizeFile'] <= 1000){
        // Bytes to KB
        return $_SESSION['$checkSizeFile'] * 1000 .'&nbsp; KB';
    } else {
        // Bytes to MB
        return round($_SESSION['$checkSizeFile'] * 0.000001, 2) ."&nbsp; MB";
    }   
}

