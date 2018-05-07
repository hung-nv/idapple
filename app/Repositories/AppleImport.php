<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Input;

class AppleImport extends \Maatwebsite\Excel\Files\ExcelFile {

    public function getFile()
    {
        // Import a user provided file
        $file = Input::file('file');
        $filename = $this->doSomethingLikeUpload($file);

        // Return it's location
        return $filename;
    }

    public function getFilters()
    {
        return [
            'chunk'
        ];
    }
}