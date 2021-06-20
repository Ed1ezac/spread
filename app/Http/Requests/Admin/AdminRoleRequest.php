<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //($this->user()->email_verified_at != null) &&
        return (
            ($this->user()->email === 'ed1ezac@gmail.com')||
            ($this->user()->email === 'edgarsrs@yahoo.com')||
            ($this->user()->email === 'buffaloitbotswana@gmail.com')         
        );
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
