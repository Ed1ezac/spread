<?php

namespace App\Http\Requests;

use App\Models\SenderName;
use Illuminate\Foundation\Http\FormRequest;

class CreateSenderNameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $count = SenderName::where('id', $this->user()->id)->count();
        return $count <=3;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'sender-name' => ['required','unique:sender_names,sender_name','max:11'],
            'reason' => ['required', 'max:180'],
            'company-name' => ['required'],
            'company-address'=>['required'],
            'tax-number' => ['required'],
            'contact'=>['required', 'numeric'],
        ];
    }
}
