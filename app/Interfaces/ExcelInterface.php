<?php
namespace App\Interfaces;

interface ExcelInterface {

    public function export($data = array(), $fileName = 'Data', $type = 'xls');

}