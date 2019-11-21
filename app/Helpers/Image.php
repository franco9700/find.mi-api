<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

Class Image
{
	/**
     * Set the headers for the images using the name
     * the size and others
     *
     * @param  string $filepath the path of the image
     * @param  string $size     the size of the image
     *
     * @return void
     */
    public static function set_image_headers($filename, $size) {
        $mtime     = Storage::lastModified($filename); 
        $gmt_mtime = gmdate('D, d M Y H:i:s', $mtime).' GMT';

        header('ETag: "' . md5($mtime . $filename . $size) . '"');

        if(isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
            if($_SERVER['HTTP_IF_MODIFIED_SINCE'] == $gmt_mtime) {
                header('HTTP/1.1 304 Not Modified');
                exit();
            }
        }

        if(isset($_SERVER['HTTP_IF_NONE_MATCH'])) {
            if(str_replace('"', '', stripslashes($_SERVER['HTTP_IF_NONE_MATCH'])) == md5($mtime . $filename . $size)) {
                header("HTTP/1.1 304 Not Modified");
                // abort processing and exit
                exit();
            }
        }

        // output last modified header using the last modified date of the file.
        header('Last-Modified: ' . $gmt_mtime);
        // tell all caches that this resource is publically cacheable.
        // header('Cache-Control: public');
        // this resource expires one month from now.
        header('Expires: ' . gmdate('D, d M Y H:i:s', strtotime('+1 month')) . ' GMT');
    }
}

