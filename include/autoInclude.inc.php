<?php
  spl_autoload_register('loader');

  function loader($className){
    $path = 'class/';
    $extension = '.class.php';
    $fullPath = $path.$className.$extension;

    if(!file_exists($fullPath)){
        $fullPath = '../'.$fullPath;
    }
    include $fullPath;
  }

?>
