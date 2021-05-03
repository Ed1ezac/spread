<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\RecipientList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
//
use  \PhpOffice\PhpSpreadsheet\IOFactory;

class RecipientListController extends Controller
{
    //
    public function create(Request $request){
        $validator =  $this->validateForm($request);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        $numRows = 0;
        //dd($request);
        //dd(mime_content_type($request->file('data-file')));
        //pre-processing
        try {
            $numRows = $this->processFile($request);
        } catch (\Throwable $th) {
            //an error occured while processing file...
            return back()->withErrors($validator);
        }
        
        //storage
        /*$path = $request->file('data-file')->store('shelf');
        //databse
        RecipientList::create([
            'user_id' => Auth::id(),
            'name' => $request->input('collection_name'),
            'entries' => $numRows,
            'file_path' => $path,
        ]);*/
        
        return redirect('/recipients')
                ->with('status', 'The recipient list has been uploaded successfully!');
    }

    private function validateForm(Request $request){
        //Convert this to middleware in the future
        return Validator::make([
                'collection_name' => $request->collection_name,
                'data-file' => $request->file('data-file'),
                'extension' => strtolower($request->file('data-file')->getClientOriginalExtension()),
            ],
            [
                'collection_name' => 'required|max:20',
                'data-file' => 'required|max:10250|min:0.045',//47-bytes
                'extension' => 'in:csv,xls,xlsx',
            ],$messages = [
                'required' => 'The :attribute field is required.',
                'string.max' => 'The :attribute may not be greater than :max characters.',
                'data-file.max'=> 'The :attribute may not be greater than 10 Megabytes.',
                'data-file.min'=> 'The :attribute is too small.',
                'in' => 'The file must be one of these types: :values',
            ]
        );  
    }

    private function processFile(Request $request){
        $file = $request->file('data-file');
        
        $reader = $this->getFileReaderByExtension(
            strtolower($request->file('data-file')->getClientOriginalExtension()));
        $spreadsheet = $reader->load($file->getPathName());
        return $spreadsheet->getActiveSheet()->getHighestDataRow();//gets number of rows with actual data
    }
    
    private function getFileReaderByExtension($extension){
        switch ($extension) {
            case 'csv':
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
    public function get(){
        
    }

    public function deleteList(){
        //Todo: implement
        Storage::delete('path-to-file');
    }

    public function download($id){
        //todo - handle fails
        $file = RecipientList::where([
            ['id','=', $id],
            ['user_id','=', Auth::id()]
            ])->first();
        
        return Storage::download($file->file_path, $file->name);
    } 

}
