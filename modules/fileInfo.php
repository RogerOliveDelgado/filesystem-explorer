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

function getFileInfo(string $path): array {
    return $fileInfo = array(
            'filename' => basename($path),
            'extension' => is_file($path)? pathinfo($path, PATHINFO_EXTENSION) : 'folder',
            'size' => formatSizeUnits(filesize($path)),
            'lastModifiedDate' => date("F j, Y, g:i a", filemtime($path)),
            'creationDate' =>  date("F j, Y, g:i a", filectime($path))
    );
}

function formatSizeUnits(int $bytes): string{
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }
        return $bytes;
}

