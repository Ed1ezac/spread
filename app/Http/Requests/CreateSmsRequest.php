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
            'sender' => ['required','max:11'],
            'message' => ['required', 'max:160'],
            'recipient_list_id'=>['required', 'numeric'],
            'order_no' => ['required', 'min:10']
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
            if($this->dateIsTooEarly()){
                $validator->errors()->add('period','Sending time is in the past, should be future time.');
            }
            if($this->hasTwoPendingJobs()){
                $validator->errors()->add('concurrency','Users are allowed two queued rollouts at most.');
            }
            if(!$this->isWithinTimeBounds()){
                $validator->errors()->add('time','Sending time must be between 0700 and 1900 hrs.');
            }
            if(!$this->rolloutWillCompleteInTime($request->only('recipient_list_id','sending_time','day','time'))){
                $validator->errors()->add('completion-time',
                'Unfortunately the rollout won\'t complete within the allowed time (7am to 9:30pm).');
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
