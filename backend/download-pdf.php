<?php

if(isset($_GET['path'])){
    $filename = $_GET['path'];

    if(file_exists($filename)){

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream; charset=utf-8');
        header('Cache-control: no-cache, must-revalidate, post-check=0, pre-check=0');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Content-Disposition: attachment; filename='.basename($filename));
        header('Content-Length: ' . filesize($filename));
        header('Pragma: public');
        ob_clean();
        flush();
        readfile($filename);
  

    } else{
        echo "File does not exists";
    }
}

?>