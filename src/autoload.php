<?php
function classLoader($classPath)
{
    $filepath = str_replace("\\", DS, _SRC.DS.$classPath.".php");
    if(is_file($filepath)) {
        require($filepath);
    }
}
spl_autoload_register("classLoader");