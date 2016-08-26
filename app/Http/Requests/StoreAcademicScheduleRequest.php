<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreAcademicScheduleRequest extends Request
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
            'start_date'  => 'required',
            'finish_date' => 'required'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'start_date.required'  => 'Es necesario colocar la fecha inicio',
            'finish_date.required' => 'Es necesario colocar la fecha de finalización'
        ];
    }
}
