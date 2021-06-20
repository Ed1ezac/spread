<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use App\Models\Reserve;
use Illuminate\Foundation\Http\FormRequest;

class DeductReserveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasRole(User::Administrator);
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => ['required','numeric','min:1'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->insufficientReserveFunds()) {
                $validator->errors()->add('amount','Reserve amount is lower than amount entered for deduction.');
            }
        });
    }

    private function insufficientReserveFunds(){
        $request = request();
        return Reserve::first()->amount < $request->input('amount');
    }
}
