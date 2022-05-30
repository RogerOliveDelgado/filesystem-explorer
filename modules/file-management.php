<?php

// Files
// $pathFile = 'C:/xampp/htdocs/filesystem-explorer/root/adios.jpg';
// $fileName = pathinfo($pathFile)['filename'];

// function deleteFile($path){
//     // var_dump (is_file($path));
//     if (is_file($path)){
//         return unlink($path);
//     } else {
//         echo "Error: This is not a file";
//     }    
// }
// deleteFile('C:/xampp/htdocs/filesystem-explorer/root/image-7.jpg');

$data = json_decode(file_get_contents("php://input"));
// function doFileOperation(string $path, string $operation);

function deleteFile(string $path): bool {
    if (is_file($path)){
        return unlink($path);
    } 
}

function renameFile($path, $newName){
    // echo "<pre>";
    if (is_file($path)){        
        // print_r(pathinfo($path)); 
        $fileBaseName = pathinfo($path, PATHINFO_BASENAME);  
        rename("../root/$fileBaseName", "../root/$newName"); 
    } else {
        echo "Error: This is not a file";
    }       
}
renameFile('C:/xampp/htdocs/filesystem-explorer/root/image-3.jpg', "C:/xampp/htdocs/filesystem-explorer/root/julito/image-3.jpg");


function editFile($path, $newText){
    $fileExtension = pathinfo($path,PATHINFO_EXTENSION);
    if((is_file($path)) && ($fileExtension === 'txt' || $fileExtension === 'doc')){        
        $textFile = fopen($path,'a') or die('Unable to open this file!');
        fwrite($textFile, "\n".$newText);        
        fclose($textFile);  
    }else {
        echo "Error: This is not a text file. Imposible to edit it";
    } 
}
// editFile('C:/xampp/htdocs/filesystem-explorer/root/always.txt', "weekend2");


// $pathFile = 'C:/xampp/htdocs/filesystem-explorer/root/adios.jpg';

// echo "<pre>";
// print_r(pathinfo($pathFile));

function moveFile($origin, $dest){
    $dirName = pathinfo($dest)['dirname'];
    $fileName = pathinfo($dest)["filename"];
    $extension = pathinfo($dest)["extension"];

    if (file_exists($dest)) {
        echo ("This file already exist");                 
        return rename($origin,"$dirName/$fileName-copy.$extension");         
    }else{ 
        return rename($origin, $dest);
    }   

}

moveFile('C:/xampp/htdocs/filesystem-explorer/root/image-3.jpg', 'C:/xampp/htdocs/filesystem-explorer/root/julito/image-3.jpg');

// ----------------------------------
// ----------------------------------
// Folders
// $pathFolder = "C:/xampp/htdocs/filesystem-explorer/root/julitoFolder";
// print_r (pathinfo($pathFolder));
