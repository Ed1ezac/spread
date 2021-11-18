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
            'sender' => ['required','min:1','max:11'],
            'message' => ['required', 'max:160'],
            'recipient-list-id'=>['required', 'numeric'],
        ];
    }
    
}
