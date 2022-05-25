<?php
    $basePath = dirname(dirname(__FILE__)); //same with $_SERVER['HTTP_REFERER]??
    $rootPath = "/root";
    $userDirectory = $basePath.$rootPath;

    // $userDirectory =  json_decode(file_get_contents('php://input'));
    $filesInFolder = array_diff(scandir($userDirectory,1), array(".", ".."));
    $files = array();
    foreach($filesInFolder as $file){
        $fileInfo = array();
        $fileInfo['filename'] = $file; //We'll add more information later,about edition date, creation date and so
        array_push($files, $fileInfo);
    }
    print_r(json_encode($files));
?>