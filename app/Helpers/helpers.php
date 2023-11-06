<?php

if (!function_exists('uploadFile')) {
    function uploadFile($file, $directory = 'uploads')
    {
        if ($file->isValid()) {
            $path = $file->store($directory);
            return $path;
        }

        return false;
    }
}