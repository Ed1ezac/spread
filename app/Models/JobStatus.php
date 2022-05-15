<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobStatus extends Model
{
    const STATUS_QUEUED = 'queued';
    const STATUS_EXECUTING = 'executing';
    const STATUS_FINISHED = 'finished';
    const STATUS_FAILED = 'failed';
    const STATUS_RETRYING = 'retrying';

    use SoftDeletes;

    protected $fillable = [
        'job_id', 'user_id', 'trackable_id', 'uuid', 'status', 'queue', 'attempts', 'progress_now', 
        'progress_max', 'fail_error', 'started_at', 'finished_at'
    ];

    public $dates = ['started_at', 'finished_at', 'created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeMine($query){
        return $query->where('user_id', Auth::id());
    }

    public function scopeWithId($query, $id){
        return $query->where('id', $id);
    }

    public function scopeforModelId($query, $modelId){
        return $query->where('trackable_id', $modelId);
    }

    public function scopeOnQueue($query, $queue){
        return $query->where('queue', $queue);
    }

    public function scopeWithStatus($query, $status){
        return $query->where('status', $status);
    }

    public function scopeForJob($query, $jobId){
        return $query->where('job_id', $jobId);
    }

    public function markAsExecuting(){
        $this->update([
            'status' => self::STATUS_EXECUTING,
            'started_at' => now(),
        ]);
    }

    public function markAsFinished(){
        $this->update([
            'status' => self::STATUS_FINISHED,
            'finished_at' => now(),
        ]);
    }

    public function markAsFailed($message){
        $this->update([
            'status' => self::STATUS_FAILED,
            'finished_at' => now(),
        ]);

        $this->recordFailError($message);
    }

    public function markAsRetrying(){
        $this->update([
            'status' => self::STATUS_RETRYING,
            'started_at' => now(),
        ]);
    }

    private function recordFailError(string $message){
        $this->update(['fail_error' => $message]);
    }
}
