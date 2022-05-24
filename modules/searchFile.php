<?php

    $basePath = dirname(dirname(__FILE__));
    $rootPath = "/root";
    $targetPath = $basePath.$rootPath;

    function searchFiles (string $path, string $strToMatch, array $matchedFiles): array {
        $pathFiles = array_diff(scandir($path,1), array(".", ".."));
        if ($pathFiles){
            foreach ($pathFiles as $element){
                str_contains($element, $strToMatch) ? array_push($matchedFiles, $element): null;
                $newPath = $path."/".$element;
                $matchedFiles = is_dir($newPath) ? searchFiles($newPath, $strToMatch, $matchedFiles) : $matchedFiles;
            }
        }
        return $matchedFiles;
    }

?>