<?php

namespace App\Jobs;

use Throwable;
use Exception;
use App\Traits\Trackable;
use App\Models\RecipientList;
use Illuminate\Bus\Queueable;
use App\Helpers\FileProcessing;
use App\Helpers\FileChunkReadFilter;
use App\Events\FileProcessingComplete;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessDataFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Trackable;

    private $recipientList;
    private $validEntryCount = 0;
    public $deleteWhenMissingModels = true;
    
    public function __construct(RecipientList $list)
    {
        $this->recipientList = $list;
    }

    public function handle()
    {
        $this->startTracking($this, $this->recipientList);
        try{
            $this->jobStatus->markAsExecuting();

            $this->processFile();

            $this->jobStatus->markAsFinished();
        }catch(Throwable $e){
            $this->beforeFail($e);
            $this->fail($e);
        }
    }

    private function processFile(){
        $chunkFilter = new FileChunkReadFilter();
        $reader = FileProcessing::createReader($this->recipientList->file_extension);
        $maxRows = FileProcessing::getMaxRowSnapShot($reader, $this->recipientList->file_path);
        $reader->setReadFilter($chunkFilter);
        
        for($startRow = 1; $startRow <= $maxRows; $startRow += FileChunkReadFilter::chunkSize) {
            $chunkFilter->setRows($startRow);
            $spreadsheet = FileProcessing::loadFile($reader, $this->recipientList->file_path);
            //validate entries
            $this->validateCells($spreadsheet->getActiveSheet());
        }

        if($this->validEntryCount < 5){
            throw new Exception("Low or invalid entries..");
        }else{
            $this->recipientList->update(['entries' => $this->validEntryCount]);
        }
    }

    private function validateCells($worksheet){
        foreach ($worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(true);//only cells with data
            foreach ($cellIterator as $cell){
                if(FileProcessing::isValidBwNumber(strval($cell->getValue()))){
                    $this->validEntryCount++;
                }
            }
        }
    }

    private function beforeFail(Throwable $e){
        $this->jobStatus->markAsFailed($e->getMessage());
        $this->recipientList->update(['status' => RecipientList::Invalid]);
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