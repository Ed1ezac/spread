<?php

namespace App\Http\Controllers;

use Throwable;
use Carbon\Carbon;
use App\Models\User;
use App\Models\JobStatus;
use Illuminate\Http\Request;
use App\Jobs\ProcessDataFile;
use App\Models\RecipientList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Auth;
use App\Events\FileProcessingComplete;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RecipientListController extends Controller
{   
    public function createRecipients(){
        if(!Auth::user()->hasRole('client')){
            return redirect()->back();
        }
        return view('dashboard.add-recipients');
    }

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
            'name' => $request->input('list_name'),
            'entries' => 0,
            'status' => RecipientList::Pending,
            'file_extension' => $request->file('data-file')->extension(),
            'file_size'=> $request->file('data-file')->getSize(),
            'file_path' => $path,
        ]);
        
        $jobId = $this->dispatchFileProcessingJob($list);
        $this->updateSmsJobTracker($jobId, $list);
        
        return redirect('/recipients')
                ->with('status', 'The file has been uploaded and is being processed..');
    }

    private function validateForm(Request $request){
        //Convert this to middleware in the future
        return Validator::make([
                'list_name' => $request->list_name,
                'data-file' => $request->file('data-file'),
                'extension' => $request->file('data-file')->extension(),
            ],
            [
                'list_name' => 'required|max:20',
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
        return Bus::chain([
            new ProcessDataFile($list),
            function () use ($list) {
                $list->update(['status' => RecipientList::Processed]);
                FileProcessingComplete::dispatch($list);
            },
        ])->onQueue('fileprocessing')->delay(now()->addSeconds(8))->dispatch();
    }

    public function deleteList(Request $request){
        $id = $request->id;
        try{
            $file = RecipientList::mine()->withId($id)->firstOrFail();
            
            Storage::delete($file->file_path);
            $file->delete();
            return back()->withErrors('data file deleted!');
        }catch(Throwable $e){
            return back()->withErrors('Oops! The requested file could not be found.');
        }
    }

    public function download($id){
        try{
            $file = RecipientList::mine()->withId($id)->firstOrFail();
            
            return Storage::download($file->file_path, $file->name);
        }catch(Exception $e){
            return back()->withErrors('Oops! The requested file could not be found.');
        }
    }

    private function updateSmsJobTracker($job_id, $list){
        $x = DB::table('jobs')->where('id', $job_id)->first();   
        $muuid = json_decode($x->payload)->uuid;
        $tr = JobStatus::mine()->onQueue('fileprocessing')->forModelId($list->id)->first();
        $tr->uuid = $muuid;
        $tr->job_id = $job_id;
        $tr->save();
    }
}
