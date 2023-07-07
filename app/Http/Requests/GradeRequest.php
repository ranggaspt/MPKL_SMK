<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradeRequest extends FormRequest
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
        return [
            'option_1' => 'required|string|max:3',
            'option_2' => 'required|string|max:3',
            'option_3' => 'required|string|max:3',
            'option_4' => 'required|string|max:3',
            'option_5' => 'required|string|max:3',
            // 'ratarata' => 'required|string|max:3',
        ];
    }
}
