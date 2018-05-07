<?php
namespace App\Interfaces;

/*
 * Interface ImageInterface
 */

interface ImageInterface {

    public function uploads($file, $folderUpload, $name = '');

    public function setFolderUpload($folderUpload, $level = 2);

    public function deleteImage($srcImage);
}

?>