<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\App\Models\Pertandingan',
            'date_field' => 'tanggal',
            'field'      => 'id',
            'prefix'     => 'Pertandingan',
            'suffix'     => '',
            'route'      => 'admin.pertandingans.edit',
        ],
        [
            'model'      => '\App\Models\Event',
            'date_field' => 'tgl_mulai',
            'field'      => 'tgl_mulai',
            'prefix'     => 'Event',
            'suffix'     => '',
            'route'      => 'admin.events.edit',
        ],
    ];

    public function index()
    {
        $events = [];
        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];

                if (! $crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . ' ' . $model->{$source['field']} . ' ' . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
