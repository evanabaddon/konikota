<?php

namespace App\Http\Requests;

use App\Models\Pertandingan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPertandinganRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('pertandingan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:pertandingans,id',
        ];
    }
}
