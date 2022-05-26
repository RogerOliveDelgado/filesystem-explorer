<?php

    $basePath = dirname(dirname(__FILE__)); //could this carry to problems if we have different roots folders??????
    $dirName = json_decode(file_get_contents('php://input'));
    $userDirectory =  $basePath."/".$dirName;
    
    // $files = array();
    // $filesInFolder = array_diff(scandir($nextDir,1), array(".", ".."));

    // foreach($filesInFolder as $file){

    //     $fileInfo = array(
    //         'filename' => $file,
    //         'extension' => pathinfo($file, PATHINFO_EXTENSION)
    //         // 'lastModified' => filemtime($file)
    //     ); //We'll add more information later,about edition date, creation date and so

    //     array_push($files, $fileInfo);
    // }
    
    // print_r(json_encode($files));

    $filesInFolder = array_diff(scandir($userDirectory,1), array(".", ".."));
    $files = array();
    foreach($filesInFolder as $file){
        $filePath = $userDirectory."/".$file;
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
        $fileInfo = array(
            'filename' => $file,
            'extension' => is_file($filePath)? $fileExtension : 'folder',
            'lastModifiedDate' => date("F j, Y, g:i a", filemtime($filePath)), //do it more clear and scalable
            'creationDate' =>  date("F j, Y, g:i a", filectime($filePath))
        );
        array_push($files, $fileInfo);
    }
    print_r(json_encode($files));
    
?>