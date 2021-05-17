<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Jobs\ProcessDataFile;
use App\Models\RecipientList;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Auth;
use App\Events\FileProcessingComplete;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RecipientListController extends Controller
{
    //'status', ['processed', 'pending', 'invalid']
    public function create(Request $request){
        $validator =  $this->validateForm($request);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        //storage
        $path = $request->file('data-file')->store('shelf');
        //databse
        $list = RecipientList::create([
            'user_id' => Auth::id(),
            'name' => $request->input('collection_name'),
            'entries' => 0,
            'status' => 'pending',
            'file_extension' => $request->file('data-file')->extension(),
            'file_path' => $path,
        ]);
        //$this->processFile($list);-Test
        $this->dispatchFileProcessingJob($list);
        
        return redirect('/recipients')
                ->with('status', 'The file has been uploaded and is being processed!');
    }

    private function validateForm(Request $request){
        //Convert this to middleware in the future
        return Validator::make([
                'collection_name' => $request->collection_name,
                'data-file' => $request->file('data-file'),
                'extension' => $request->file('data-file')->extension(),
            ],
            [
                'collection_name' => 'required|max:20',
                'data-file' => 'required|max:10250|min:0.045',//47-bytes
                'extension' => 'in:csv,txt,xls,xlsx',
            ],$messages = [
                'required' => 'The :attribute field is required.',
                'string.max' => 'The :attribute may not be greater than :max characters.',
                'data-file.max'=> 'The :attribute may not be greater than 10 Megabytes.',
                'data-file.min'=> 'The :attribute is too small.',
                'in' => 'The file must be one of these types: :values',
            ]
        );  
    }

    private function dispatchFileProcessingJob($list){
        Bus::chain([
            new ProcessDataFile(Auth::user(), $list),
            function () use ($list) {
                $list->status = 'processed';
                $list->save();
                FileProcessingComplete::dispatch($list);
            },
        ])->onQueue('uploads')->delay(now()->addSeconds(6))->dispatch();
    }

    public function deleteList(Request $request){
        $id = $request->id;
        try{
            $file = RecipientList::where([
                ['id','=', $id],
                ['user_id','=', Auth::id()]
                ])->firstOrFail();
            Storage::delete($file->file_path);
            $file->delete();

            return back()->withErrors('data file deleted!');
        }catch(Exception $e){
            return back()->withErrors('Oops! The request file could not be found.');
        }
    }

    public function download($id){
        try{
            $file = RecipientList::where([
                ['id','=', $id],
                ['user_id','=', Auth::id()]
                ])->firstOrFail();
            
            return Storage::download($file->file_path, $file->name);
        }catch(Exception $e){
            return back()->withErrors('Oops! The requested file could not be found.');
        }
    } 

}
