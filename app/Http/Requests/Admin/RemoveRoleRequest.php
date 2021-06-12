<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class RemoveRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasRole(User::Administrator) || 
            $this->user()->hasRole(User::Moderator);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role' => ['required'],
            'userId' => ['required'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->userHasRole()) {
                $validator->errors()->add('error','Trying to remove a role that the user doesn\'t have.');
            }
        });
    }

    private function userHasRole(){
        $request = request();
        return User::find($request->input('userId'))->hasRole($request->input('role'));
    }
}
