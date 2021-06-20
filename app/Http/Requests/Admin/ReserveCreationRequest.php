<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ReserveCreationRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole(User::Administrator);
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
}
