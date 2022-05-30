<?php

// Files
// $pathFile = 'C:/xampp/htdocs/filesystem-explorer/root/adios.jpg';
// $fileName = pathinfo($pathFile)['filename'];

function deleteFile($path){
    // var_dump (is_file($path));
    if (is_file($path)){
        return unlink($path);
    } else {
        echo "Error: This is not a file";
    }    
}
// deleteFile('C:/xampp/htdocs/filesystem-explorer/root/image-7.jpg');


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

// moveFile('C:/xampp/htdocs/filesystem-explorer/root/hola.txt', 'C:/xampp/htdocs/filesystem-explorer/root/Garcia/hola.txt');

// ----------------------------------
// ----------------------------------
// Folders
// $pathFolder = "C:/xampp/htdocs/filesystem-explorer/root/julitoFolder";
// print_r (pathinfo($pathFolder));


function createFolder($newfolder){
    if (!is_dir('../root/'.$newfolder)){
        mkdir('../root/'.$newfolder);
    }else{
        echo("Error: This folder exits");
    }
}
// createFolder('carmen');


function editFolder($path, $newFolder){
    $folderBaseName = pathinfo($path, PATHINFO_BASENAME);    
    if (is_dir($path)){            
        rename("../root/$folderBaseName", "../root/$newFolder");
    }else{
        echo "Error: This is not a folder. Please select a folder";
    }
}
// editFolder('C:/xampp/htdocs/filesystem-explorer/root/joselito111333',"julito");


function deleteFolder($path){
    $folderBaseName = pathinfo($path, PATHINFO_BASENAME);
// var_dump (is_dir($path));
    if (is_dir($path)){
        return rmdir($path);
    } else{
        echo "This folder doesn´t exits";
    }    
}
// deleteFolder("C:/xampp/htdocs/filesystem-explorer/root/Macarena");