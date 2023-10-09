<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    // setup all validation roles
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:32'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:4']
        ];
    }


    //    prepare then user request key for setup the database table key
    //    like user post key userName the camelcase but database rules accepted it is user_name
    //    so the userName to make is user_name for save the database  key in using prepare for validation method
    //    protected function prepareForValidation()
    //    {
    //        $this->merge([
    //            'user_name' => $this->userName
    //             bd_key     => request_key
    //        ]);
    //    }


    // return custom validation message
    public function messages(): array
    {
        return[
            'name.required' => 'Please enter a name',
            'name.min' => 'Please enter a name at last of :attribute characters',
            'email.required' => "Please enter an email address",
            'email.email' => 'The entered email address not valid',
            'email.unique' => 'The enter email address is already taken'
        ];
    }


}
