<?php
    $basePath = dirname(dirname(__FILE__)); //same with $_SERVER['HTTP_REFERER]??
    $rootPath = "/root";
    $userDirectory = $basePath.$rootPath;

    // $userDirectory =  json_decode(file_get_contents('php://input'));
    $filesInFolder = array_diff(scandir($userDirectory,1), array(".", ".."));
    $files = array();
    foreach($filesInFolder as $file){
        $filePath = $userDirectory."/".$file;
        $fileInfo = array(
            'filename' => $file,
            'extension' => is_file($filePath)? pathinfo($filePath, PATHINFO_EXTENSION) : 'folder',
            'size' => filesize($filePath),
            'lastModifiedDate' => date("F j, Y, g:i a", filemtime($filePath)), //do it more clear and scalable
            'creationDate' =>  date("F j, Y, g:i a", filectime($filePath))
        );
        array_push($files, $fileInfo);
    }
    print_r(json_encode($files));
?>