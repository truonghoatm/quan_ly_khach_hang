<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique|min:1|max:30',
            'email' => 'required|unique|min:1|max:20',
            'dob' => 'required|min:18'
        ];
    }

    public function messages()
    {
        $message = [
            'name.required' => 'Khong duoc bo trong o nay',
            'name.min' => 'ten phai co it nhat 1 ky tu',
            'email.required'=>'Dia chi email khong duoc de trong',

        ];
        return $message;
    }
}
