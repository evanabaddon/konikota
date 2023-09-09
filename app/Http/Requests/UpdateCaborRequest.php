<?php

namespace App\Http\Requests;

use App\Models\Cabor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCaborRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cabor_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
