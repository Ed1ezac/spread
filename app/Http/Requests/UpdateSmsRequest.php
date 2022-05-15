<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use App\Models\Sms;
use App\Models\RecipientList;
use App\Traits\VerifiesSmsInfo;
use App\Traits\EnsuresRolloutCompliance;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSmsRequest extends FormRequest
{
    use EnsuresRolloutCompliance, VerifiesSmsInfo;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasRole('client');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['required'],
            'sender' => ['required','max:11'],
            'message' => ['required', 'max:160'],
            'recipient_list_id'=>['required', 'numeric'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $request = request();
            if ($this->insufficientFunds()) {
                $validator->errors()->add('error','you have insufficient funds');
            }
            if($this->dateIsTooFar()){
                $validator->errors()->add('period','Sending day must be within 14 days from today.');
            }
            if($this->dateIsTooEarly()){
                $validator->errors()->add('period','Sending time is in the past, should be future time.');
            }
            if(!$this->isWithinTimeBounds()){
                $validator->errors()->add('time','Sending time must be between 0700 and 1900 hrs.');
            }
            if(!$this->rolloutWillCompleteInTime($request->only('recipient_list_id','sending_time','day','time'))){
                $validator->errors()->add('completion-time',
                'Unfortunately the rollout won\'t complete within the allowed time (7am to 9:30pm).');
            }
            // if($this->userHasCloselyQueuedJobs(
            //     $request->input('sending_time') == 'later', 
            //     ($request->input('day').''.$request->input('time')),
            //     Sms::find($request->input('id'))->job_id)){
            //     $validator->errors()->add('concurrency','Too many closely scheduled rollouts, separate by 2 hours at least.');
            // }
        });
    }

    private function insufficientFunds(){
        $request = request();
        $funds = $this->user()->funds;
        $recipientsCount = RecipientList::find($request->input('recipient_list_id'))->entries;
        return $funds->amount < $recipientsCount;
    }

    private function dateIsTooFar(){
        $request = request();
        return ($request->input('sending_time') == 'later') &&
            (Carbon::today()->diffInDays($request->input('day'))>14);
    }

    private function dateIsTooEarly(){
        $request = request();
        $daysDiff = Carbon::today()->diffInDays($request->input('day'), false);
        if(($request->input('sending_time') == 'later')){
            if($daysDiff == 0){
                return (Carbon::now()->diffInSeconds($request->input('time'), false)<10);
            }else if($daysDiff<0){
                return true;
            }
        }
        return false;
    }
}
