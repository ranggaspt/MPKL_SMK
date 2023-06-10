<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JournalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            $photo = 'image|mimes:pdf|max:4096';
        } else {
            $photo = 'required|image|mimes:pdf|max:4096';
        }
        return [
            'list_jurnals' => 'required|string|max:255',
            'photo' => $photo
        ];
    }
}
