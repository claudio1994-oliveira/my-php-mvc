<?php

function view(string $view, array $data = []): void
{
    extract($data);
    
    $paths = explode(".", $view);
    $completePath = "";
    
    if (count($paths) > 1){
        foreach ($paths as $key => $path) {
            if ($key +1 >= count($paths)){
                $completePath .= $path;
            }else {
                $completePath .= $path . DIRECTORY_SEPARATOR;
            }
        }
        require_once __DIR__ . '/../../views/' . $completePath . '.php';
        return;
    }
    
    require_once __DIR__ . '/../../views/' . $paths[0] . '.php';
}