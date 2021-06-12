<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSmsRequest extends FormRequest
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
            'smsId' => ['required'],
            'sender' => ['required','max:16'],
            'message' => ['required', 'max:140'],
            'recipient-list-id'=>['required', 'numeric'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->insufficientFunds()) {
                $validator->errors()->add('error','you have insufficient funds');
            }
        });
    }

    private function insufficientFunds(){
        $request = request();
        $funds = $this->user()->funds;
        $recipientsCount = RecipientList::find($request->input('recipient-list-id'))->entries;
        return $funds->amount < $recipientsCount;
    }
}
