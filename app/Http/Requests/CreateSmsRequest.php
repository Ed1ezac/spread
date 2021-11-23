<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use App\Models\RecipientList;
use App\Traits\VerifiesSmsInfo;
use App\Traits\EnsuresRolloutCompliance;
use Illuminate\Foundation\Http\FormRequest;

class CreateSmsRequest extends FormRequest
{
    use EnsuresRolloutCompliance, VerifiesSmsInfo;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sender' => ['required','max:11'],
            'message' => ['required', 'max:160'],
            'recipient-list-id'=>['required', 'numeric'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $request = request();
            $correctRecipients = $this->isUsersRecipientListId($request->input('recipient-list-id'));
            if (!$this->isUsersSenderName($request->input('sender'))) {
                $validator->errors()->add('Sender','Invalid sender, please select sender name again');
            }
            if (!$correctRecipients) {
                $validator->errors()->add('Recipients','Invalid recipients, please select a recipient list again');
            }
            if ($correctRecipients && $this->insufficientFunds()) {
                $validator->errors()->add('funds','You have insufficient funds');
            }
            if($this->dateIsTooFar()){
                $validator->errors()->add('period','Sending day must be within 14 days from today.');
            }
            if($this->dateIsTooEarly()){
                $validator->errors()->add('period','Sending time is in the past, should be future time.');
            }
            if(!$this->isWithinTimeBounds()){
                $validator->errors()->add('time','Sending time must be between 0700 and 2130 hrs.');
            }
            if($correctRecipients && !$this->rolloutWillCompleteInTime($request->only('recipient-list-id','sending_time','day','time'))){
                $validator->errors()->add('completion-time',
                'Unfortunately the rollout won\'t complete within the allowed time (7am to 9:30pm).');
            }
            if($this->userHasExecutingJob()){
                $validator->errors()->add('concurrency','Users are allowed only one rollout at a time.');
            }
            if($this->userHasCloselyQueuedJobs($request->input('sending_time') == 'later', ($request->input('day').''.$request->input('time')))){
                $validator->errors()->add('concurrency','Too many closely scheduled rollouts, separate by 2 hours at least.');
            }
            
        });
    }

    public function passedValidation(){
        if(!$this->isVacant()){
            $vacancyTime = $this->estimatedTimeTillVacant();
            if(Carbon::now()->diffInMinutes($vacancyTime) > 1){
                $this->merge(['vacant-in' => Carbon::now()->longAbsoluteDiffForHumans($vacancyTime)]);
            }
        }
    }

    private function insufficientFunds(){
        $request = request();
        $funds = $this->user()->funds;
        $recipientsCount = RecipientList::find($request->input('recipient-list-id'))->entries;
        return $funds->amount < $recipientsCount;
    }

    private function dateIsTooFar(){
        $request = request();
        return ($request->input('sending_time') == 'later') &&
            (Carbon::today()->diffInDays($request->input('day'))>14);
    }

    private function dateIsTooEarly(){
        $request = request();
        return ($request->input('sending_time') == 'later') &&
            ((Carbon::today()->diffInDays($request->input('day'), false)<1) ||
            (Carbon::now()->diffInSeconds($request->input('time'), false)<10));
    }
}
