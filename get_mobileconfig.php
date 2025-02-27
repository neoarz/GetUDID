<?php

$name_file = isset($_GET['file']) ? $_GET['file'] : "https://raw.githubusercontent.com/neoarz/GetUDID/refs/heads/main/device.mobileconfig";


$name_file = basename($name_file);

if(file_exists($name_file)) {
    $file = fopen($name_file, "r");
    if ($file === false) {
        echo "Unable to open file!";
        die;
    }
    header("Content-type: application/x-apple-aspen-config; charset=utf-8");
    header("Content-Disposition: attachment; filename=\"$name_file\"");
    echo fread($file, filesize($name_file));
    fclose($file);
} else {
    echo "File Not Found.";
    die;
}
