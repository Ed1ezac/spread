<?php

namespace App\Helpers;

use Throwable;
use Exception;
use Illuminate\Support\Facades\Storage;

class FileProcessing{
    /**
     * DOCUMENTATION @:
     * https://phpspreadsheet.readthedocs.io/en/latest/
     **/
    //Bw Number regex pattern
    private static $pattern = "/^(?=^.{8}$)(?=^7[1-7])(?=.*\d{6}$)/";
    private static $map = [];

    public static function createReader($fileExtension){
        return self::getFileReaderByExtension($fileExtension);
    }

    public static function getMaxRowSnapShot($reader, $filePath){
        $spreadsheet = self::loadFile($reader, $filePath);
        $numMaxRows = $spreadsheet->getActiveSheet()->getHighestDataRow();
        $spreadsheet = null;//dump-it
        return $numMaxRows;
    }

    public static function loadFile($reader, $filePath){
        return $reader->load(Storage::path($filePath)); 
    }

    private static function getFileReaderByExtension(String $extension){
        //Todo convert switch to HashMap
        switch ($extension) {
            case 'csv':
                return new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            case 'txt':
                return new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            case 'xls':
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                $reader->setReadDataOnly(true);
                return $reader;
            case 'xlsx':
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $reader->setReadDataOnly(true);
                return $reader;
            default:
                throw new Exception("Invalid file type.");
                break;
        }
    }

    public static function isValidBwNumber(String $item){
        if(strlen($item) > 8 ){
            //get last 8 digits from - end
            $item = substr($item, -8);
        }
        return preg_match(self::$pattern, $item) > 0;
    }
}
