<?php

namespace App\Http\Requests;

use App\Models\Cabor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCaborRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cabor_create');
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
