<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use App\Models\RecipientList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CreateSmsRequest extends FormRequest
{
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
            if ($this->insufficientFunds()) {
                $validator->errors()->add('funds','You have insufficient funds');
            }
            if($this->dateIsTooFar()){
                $validator->errors()->add('period','Sending day must be within 14 days from today.');
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
