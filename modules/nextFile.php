<?php

    $basePath = dirname(dirname(__FILE__)); //could this carry to problems if we have different roots folders??????
    $dirName = json_decode(file_get_contents('php://input'));
    $userDirectory =  $basePath."/".$dirName;

    $filesInFolder = array_diff(scandir($userDirectory,1), array(".", ".."));
    $files = array();
    foreach($filesInFolder as $file){
        $filePath = $userDirectory."/".$file;
        $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        $fileInfo = getFileInfo($filePath);
        array_push($files, $fileInfo);
    }
    print_r(json_encode($files));
 
?>