<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComplaintRequest extends FormRequest
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
        $id = $this->get('id');
        if ($this->method() == 'PUT') {
            $message = 'required|string|max:255' . $id;
        } else {
            $message = 'required|string|max:255' . $id;
        }
        return [
            'message_complaint' => $message,
            // 'validation_message' => 'required|string',
        ];
    }
}
