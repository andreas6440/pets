<?php

namespace App\Http\Requests;

use App\Rules\MinDate;
use Illuminate\Foundation\Http\FormRequest;

class MascotaStore extends FormRequest
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
            'nombre' => 'required|max:255',
            'raza' => 'required|max:255',
            'fecha_nacimiento' => [
                'required',
                'date',
                'date_format:Y-m-d',
                new MinDate

            ]
        ];
    }
}