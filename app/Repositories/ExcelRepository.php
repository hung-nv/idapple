<?php

namespace App\Repositories;

use Maatwebsite\Excel\Facades\Excel;
use App\Interfaces\ExcelInterface;

class ExcelRepositories implements ExcelInterface {

    public function export($data = array(), $fileName = 'Data', $type = 'xls')
    {
        Excel::create($fileName, function($excel) use ($data) {

            $excel->sheet('New sheet', function($sheet) use ($data) {

                $sheet->fromArray($data,null, 'A1', false, false);

            });

        })->download($type);
    }

}