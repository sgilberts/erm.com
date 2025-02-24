<?php

if (!empty($_GET['song'])) {
    $filename = basename($_GET['song']);
    // $filename = $_GET['song'];

    // print_r($filename);
    // if (preg_match('/^[^.][-a-z0-9_.]+[a-z]$/i', $filename)) {
        // $filepath = "public/" . $file;
        $filepath = 'vor/songs/' . $filename;

        print_r($filepath);

        if (!empty($filename) && file_exists($filepath)) {


            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header("Content-Type: application/zip");
            header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            header("Content-Transfer-Emcoding: binary");
            flush(); // Flush system output buffer
            readfile($filepath);
            die();
        } else {
            print_r("This File Does not exist.");
        }
    // } else { print_r("This File Does not exist."); }
} else {
    print_r("Download cannot be processed");
}
