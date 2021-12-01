<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use App\Models\Sms;
use App\Traits\EnsuresRolloutCompliance;
use Illuminate\Foundation\Http\FormRequest;

class ProcessScheduledImmediateRequest extends FormRequest
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
            //
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $request = request();
            $sms = Sms::find($request->id);
            $sending_day =  str_replace("-", ".",explode(" ", $sms->send_at)[0]);
            $sending_time = explode(" ", $sms->send_at)[1];
            $completionTimeArray = array(
                    'recipient-list-id' => $sms->recipient_list_id,
                    'sending_time' => 'later',
                    'day' =>  Carbon::createFromFormat("Y.m.d", $sending_day)->format('d.m.Y'),
                    'time' => Carbon::createFromFormat("H:i:s", $sending_time)->format('H:i')
            );
            if(!$this->isWithinTimeBounds()){
                $validator->errors()->add('time','Sending time must be between 0700 and 2130 hrs.');
            }
            if(!$this->rolloutWillCompleteInTime($completionTimeArray)){
                $validator->errors()->add('completion-time',
                'Unfortunately the rollout won\'t complete within the allowed time (7am to 9:30pm).');
            }
            if($this->userHasExecutingJob()){
                $validator->errors()->add('concurrency','Users are allowed only one rollout at a time.');
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
}
