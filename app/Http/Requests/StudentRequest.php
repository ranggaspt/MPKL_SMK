<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        $id = $this->get('id');
        if ($this->method() == 'PUT') {
            $email = 'required|unique:students,email,' . $id;
            $phone = 'required|unique:students,phone,' . $id;
            $photo = 'image|mimes:jpeg,png,jpg,gif|max:4096';
        } else {
            $email = 'required|unique:students,email,NULL';
            $phone = 'required|unique:students,phone,NULL';
            $photo = 'required|image|mimes:jpeg,png,jpg,gif|max:4096';
        }
        return [
            'name' => 'required|string|max:255',
            'gender' => 'required',
            'address' => 'required|string',
            'email' => $email,
            'phone' => $phone,
            'photo' => $photo
        ];
    }
}
