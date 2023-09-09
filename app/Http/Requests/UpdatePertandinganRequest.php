<?php

namespace App\Http\Requests;

use App\Models\Pertandingan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePertandinganRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pertandingan_edit');
    }

    public function rules()
    {
        return [
            'tgl_mulai' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'tgl_selesai' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
