<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class CommitEmailsRequest extends Request {

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
     * https://laracasts.com/discuss/channels/laravel/inputgetarray-with-form-request
     * @return array
     */
    public function rules()
    {
        $rules = [

        ];

        foreach ($this->request->get('email') as $key => $value)
        {
            $rules['email.' . $key] = 'required|email';
        }

        return $rules;
    }
}
