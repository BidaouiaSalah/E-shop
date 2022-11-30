<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        // $emailValidation = auth()->user() ?  : "required|email|unique:users"
        return [
            "email" => "required|email",
            "fullName" => "required",
            "adress" => "required",
            "city" => "required",
            "nameOnCart" => "required"
        ];
    }
    public function messages()
    {
        return [
            "email.unique" => "You already have an account, Please <a href='/login'>Login</a> to continue"
        ];
    }
}
