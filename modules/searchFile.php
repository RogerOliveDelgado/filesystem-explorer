<?php

    $basePath = dirname(dirname(__FILE__));
    $rootPath = "/root";
    $targetPath = $basePath.$rootPath;

    $data = json_decode(file_get_contents('php://input'));
    $files = searchFiles($targetPath, $data, array());
    print_r(json_encode(($files)));

    function searchFiles (string $path, string $strToMatch, array $matchedFiles): array {
        $pathFiles = array_diff(scandir($path,1), array(".", ".."));
        if ($pathFiles){
            foreach ($pathFiles as $element){
                str_contains($element, $strToMatch) ? array_push($matchedFiles, $element): null;
                $matchedFiles = is_dir($path."/".$element) ? searchFiles($path."/".$element, $strToMatch, $matchedFiles) : $matchedFiles;
            }
        }
        return $matchedFiles;
    }

?>