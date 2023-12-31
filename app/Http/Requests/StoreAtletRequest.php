<?php

namespace App\Http\Requests;

use App\Models\Atlet;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAtletRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('atlet_create');
    }

    public function rules()
    {
        return [
            'nik' => [
                'string',
                'nullable',
            ],
            'name' => [
                'string',
                'nullable',
            ],
            'status' => [
                'string',
                'nullable',
            ],
        ];
    }
}
