<?php

class Miscellaneous
{

    public function __construct()
    {
    }
    public function uploadFile(string $directory, $file,$filename):bool{
        $target_file = $directory . $filename;
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
  return true;
        }
        else{
            return false;
        }
    }
}