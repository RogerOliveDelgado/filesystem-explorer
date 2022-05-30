<?php

    $basePath = dirname(dirname(__FILE__));
    $data = json_decode(file_get_contents("php://input"), true);

    $folderDirectory =  $basePath."/".$data['path'];
    $newDirectory = $basePath."/".$data['newPath'];
    $operation = $data['operation'];

    if($operation === 'create'){
        createFolder($folderDirectory);
    } else if ($operation === 'edit'){
        editFolder($folderDirectory, $newDirectory);
    } else if ($operation === 'delete'){
        echo $folderDirectory;
        deleteFolder($folderDirectory);
    }

    function createFolder($folderPath){
        if (!file_exists($folderPath) && !is_dir($folderPath) ) {
            mkdir($folderPath);       
        } 
    }

    function editFolder($path, $newPath){
        if (is_dir($path)){
            rename($path, $newPath);
        }
    }

    function deleteFolder (string $path): void {
        $pathFiles = array_diff(scandir($path,1), array(".", ".."));
        if ($pathFiles){
            foreach ($pathFiles as $element){
                $elemPath = $path."/".$element;
                if(is_dir($elemPath)) {
                    if (!is_dir_empty($elemPath)){
                        deleteFolder($elemPath);
                    }
                    rmdir($elemPath);
                } else {
                    unlink($elemPath);
                }
            }
        }
        rmdir($path);
    }

    function is_dir_empty(string $dir) : bool {
        if (!is_readable($dir)) return null; 
            return (count(scandir($dir)) == 2);
    }

?>