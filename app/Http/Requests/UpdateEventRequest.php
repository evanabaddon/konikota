<?php

namespace App\Http\Requests;

use App\Models\Event;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEventRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'tgl_mulai' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'tgl_selesai' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'venues.*' => [
                'integer',
            ],
            'venues' => [
                'array',
            ],
            'cabors.*' => [
                'integer',
            ],
            'cabors' => [
                'array',
            ],
        ];
    }
}
