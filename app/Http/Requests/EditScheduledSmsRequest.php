<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditScheduledSmsRequest extends FormRequest
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
            'id' => ['required'],
            'status' => ['required'],
            'sender' => ['required','max:11'],
            'user_id' => ['required', 'numeric'],
            'send_at' => ['required'],            
            'message' => ['required', 'max:160'],
            'recipient_list_id'=>['required', 'numeric'],
            'order_no' => ['required', 'min:10']
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            //$validator->errors()->add('error','ooof.. something is not right, try loging out then login.');
        });
    }
}
