<?php

    require('fileInfo.php');

    $basePath = dirname(dirname(__FILE__)); //same with $_SERVER['HTTP_REFERER]??
    $dirName = json_decode(file_get_contents('php://input'));
    $userDirectory =  $basePath."/".$dirName;

    $files = getFilesInFolder($userDirectory);
    print_r(json_encode($files));

    function getFilesInFolder(string $path): array{
        $filesInFolder = array_diff(scandir($path,1), array(".", ".."));
        $files = array();
        foreach($filesInFolder as $file){
            $fileInfo = getFileInfo($path."/".$file);
            array_push($files, $fileInfo);
        }
        return $files;
    }
?>