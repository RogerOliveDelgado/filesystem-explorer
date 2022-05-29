<?php

    require('fileInfo.php');
    
    $data = json_decode(file_get_contents('php://input'), true); //Returns an object
    $basePath = dirname(dirname(__FILE__));
    $targetPath = $basePath."/".$data['path'];

    $files = searchFiles($targetPath, $data['strToMatch']);
    print_r(json_encode(($files)));

    function searchFiles (string $path, string $strToMatch, ?array $matchedFiles = array()): array {
        $pathFiles = array_diff(scandir($path,1), array(".", ".."));
        if ($pathFiles){
            foreach ($pathFiles as $element){
                str_contains($element, $strToMatch) ? array_push($matchedFiles, getFileInfo($path."/".$element)): null;
                $matchedFiles = is_dir($path."/".$element) ? searchFiles($path."/".$element, $strToMatch, $matchedFiles) : $matchedFiles;
            }
        }
        return $matchedFiles;
    }

?>