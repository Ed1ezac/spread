<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
//use App\Models\Funds;
use Illuminate\Foundation\Http\FormRequest;

class DeductUserFundsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasRole(User::Administrator);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => ['required','numeric','min:1'],
            'userId' => ['required'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if($this->insufficientUserFunds()) {
                $validator->errors()->add('error','User\'s funds are lower than the amount entered for deduction!');
            }
        });
    }

    private function insufficientUserFunds(){
        $request = request();
        return User::find($request->input('userId'))
            ->funds->amount < $request->input('amount');
    }
}
