<?php

namespace App\Http\Requests;

use App\Models\Venue;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVenueRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('venue_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'alamat' => [
                'string',
                'nullable',
            ],
            'provinsi' => [
                'string',
                'nullable',
            ],
            'kota' => [
                'string',
                'nullable',
            ],
        ];
    }
}
