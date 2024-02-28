<?php
class File{
    public static function build_path($path_array)
    {
        // $ROOT_FOLDER (sans slash à la fin) vaut
        $ROOT_FOLDER = __DIR__;
        return $ROOT_FOLDER . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR. join(DIRECTORY_SEPARATOR, $path_array);
    }    
}
?>