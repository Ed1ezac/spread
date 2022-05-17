<?php

namespace App\Http\Requests;

use App\Traits\VerifiesSmsInfo;
use Illuminate\Foundation\Http\FormRequest;

class VerifySmsRequest extends FormRequest
{
   // use VerifiesSmsInfo;
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
        if(request()->has(['id'])){
            return [
                'id' => ['required', 'numeric'],
                'sender' => ['required','min:1','max:11'],
                'message' => ['required', 'max:160'],
                'recipient_list_id'=>['required', 'numeric'],
                'order_no' => ['required'],
                'status' => ['required'],
                'send_at' => ['required'],
            ];
        }
        return [
            //
            'sender' => ['required','min:1','max:11'],
            'message' => ['required', 'max:160'],
            'recipient_list_id'=>['required', 'numeric'],
        ];
    }
    
}
