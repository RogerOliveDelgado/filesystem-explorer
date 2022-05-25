<?php

    $basePath = dirname(dirname(__FILE__)); //could this carry to problems if we have different roots folders??????
    $dirName = json_decode(file_get_contents('php://input'));
    $nextDir =  $basePath."/".$dirName;
    $files = array();
    
    $filesInFolder = array_diff(scandir($nextDir,1), array(".", ".."));
    foreach($filesInFolder as $file){
        $fileInfo = array();
        $fileInfo['filename'] = $file; //We'll add more information later,about edition date, creation date and so
        array_push($files, $fileInfo);
    }
    
    print_r(json_encode($files));
    
?>