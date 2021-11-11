<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use App\Models\RecipientList;
use Illuminate\Foundation\Http\FormRequest;

class CreateSmsRequest extends FormRequest
{
    use EnsuresRolloutCompliance;
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
            'sender' => ['required','max:16'],
            'message' => ['required', 'max:140'],
            'recipient-list-id'=>['required', 'numeric'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $request = request();
            if ($this->insufficientFunds()) {
                $validator->errors()->add('funds','You have insufficient funds');
            }
            if($this->dateIsTooFar()){
                $validator->errors()->add('period','Sending day must be within 14 days from today.');
            }
            if(!$this->isWithinTimeBounds()){
                $validator->errors()->add('time','Sending time must be between 0700 and 2130.');
            }
            if($this->rolloutWillCompleteInTime(RecipientList::find($request->input('recipient-list-id'))->entries)){
                $validator->errors()->add('completion-time',
                'This rollout will not complete with allowed times (7am to 2130pm) due to the rollout queue or large size of recipients.');
            }
            if($this->userHasExecutingJob()){
                $validator->errors()->add('concurrency','Users are allowed only one rollout at a time.');
            }
            if($this->userHasCloselyQueuedJobs($request->input('sending_time') == 'later')){
                $validator->errors()->add('concurrency','Too many closely scheduled rollouts, separate by 2 hours at least.');
            }
            if(!$this->isVacant()){
                $vacancyTime = $this->estimatedTimeTillVacant();
                if(Carbon::now()->subMinutes($vacancyTime) > 1){
                    $request->merge(['vacant-in', $vacancyTime]);
                }
            }
        });
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
}
