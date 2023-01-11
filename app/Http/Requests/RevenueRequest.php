<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RevenueRequest extends FormRequest
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
       // dd('ta aqui');
        return [
            //'name' => ['required', 'string', 'max:255'],
        ];
    }

    //-------------------------------------------------------

    public function attibutes()
    {
        return [
           // 'name' => 'Nome'
        ];
    }
}
