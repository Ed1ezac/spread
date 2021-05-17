<?php

namespace App\Jobs;

use Throwable;
use Exception;
use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Models\RecipientList;
use App\Events\FileProcessingComplete;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessDataFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    protected $recipientList;
    private $validEntryCount = 0;
    public $deleteWhenMissingModels = true;
    
    public function __construct(User $user, RecipientList $item)
    {
        $this->user = $user;
        $this->recipientList = $item;
    }

    public function handle()
    {
        try{
            $this->processFile();
        }catch(Exception $e){
            $this->fail($e);
        }
    }

    private function processFile(){
        $reader = $this->getFileReaderByExtension($this->recipientList->file_extension);
        $spreadsheet = $reader->load(Storage::path($this->recipientList->file_path));
        $worksheet = $spreadsheet->getActiveSheet();
        
        foreach ($worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(true);//only cells with data
            foreach ($cellIterator as $cell) {
                $this->checkItemValidity(strval($cell->getValue()));
            }
        }

        if($this->validEntryCount < 5){
            throw new Exception("Low or invalid entries..");
        }else{
            $this->recipientList->entries = $this->validEntryCount;
            $this->recipientList->save();
        }
    }

    private function getFileReaderByExtension(String $extension){
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

    private function checkItemValidity(String $item){
        $pattern = "/^(?=^.{8}$)(?=^7[1-7])(?=.*\d{6}$)/";
        if(strlen($item) > 8 ){
            //get last 8 digits from - end
            $item = substr($item, -8);
        }

        if(preg_match($pattern, $item) > 0){
            $this->validEntryCount++;
        }
    }

    /*Handle a job failure.*/
    public function failed(Throwable $exception){
        $this->recipientList->status = 'invalid';
        $this->recipientList->save();
        //fire event
        FileProcessingComplete::dispatch($this->recipientList);
    }
}
///////////////TEST////////////////
/*private function processFile(RecipientList $recipientList){
    $reader = $this->getFileReaderByExtension($recipientList->file_extension);
    $spreadsheet = $reader->load(Storage::path($recipientList->file_path));
    $worksheet = $spreadsheet->getActiveSheet();
    //gets number of rows with actual data
    foreach ($worksheet->getRowIterator() as $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(true);//only cellswith data
        foreach ($cellIterator as $cell) {
            $this->checkItemValidity(strval($cell->getValue()));
        }
    }
    $recipientList->entries = $this->validEntryCount;
    //$spreadsheet->getActiveSheet()->getHighestDataRow();
    dd($this->validEntryCount);
    //$recipientList->save();
}
private function getFileReaderByExtension(String $extension){
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
private function checkItemValidity(String $item){
    $pattern = "/^(?=^.{8}$)(?=^7[1-7])(?=.*\d{6}$)/";
    if(strlen($item) > 8 ){
        //get last 8 digits from - end
        $item = substr($item, -8);
    }

    if(preg_match($pattern, $item) > 0){
        $this->validEntryCount++;
    }
}*/
//////////////////////////////////////////////////