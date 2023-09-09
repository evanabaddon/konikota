<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPertandinganRequest;
use App\Http\Requests\StorePertandinganRequest;
use App\Http\Requests\UpdatePertandinganRequest;
use App\Models\Cabor;
use App\Models\Event;
use App\Models\Pertandingan;
use App\Models\Venue;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PertandinganController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('pertandingan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pertandingans = Pertandingan::with(['event', 'cabor', 'venue'])->get();

        $events = Event::get();

        $cabors = Cabor::get();

        $venues = Venue::get();

        return view('admin.pertandingans.index', compact('cabors', 'events', 'pertandingans', 'venues'));
    }

    public function create()
    {
        abort_if(Gate::denies('pertandingan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cabors = Cabor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $venues = Venue::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pertandingans.create', compact('cabors', 'events', 'venues'));
    }

    public function store(StorePertandinganRequest $request)
    {
        $pertandingan = Pertandingan::create($request->all());

        return redirect()->route('admin.pertandingans.index');
    }

    public function edit(Pertandingan $pertandingan)
    {
        abort_if(Gate::denies('pertandingan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cabors = Cabor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $venues = Venue::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pertandingan->load('event', 'cabor', 'venue');

        return view('admin.pertandingans.edit', compact('cabors', 'events', 'pertandingan', 'venues'));
    }

    public function update(UpdatePertandinganRequest $request, Pertandingan $pertandingan)
    {
        $pertandingan->update($request->all());

        return redirect()->route('admin.pertandingans.index');
    }

    public function show(Pertandingan $pertandingan)
    {
        abort_if(Gate::denies('pertandingan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pertandingan->load('event', 'cabor', 'venue');

        return view('admin.pertandingans.show', compact('pertandingan'));
    }

    public function destroy(Pertandingan $pertandingan)
    {
        abort_if(Gate::denies('pertandingan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pertandingan->delete();

        return back();
    }

    public function massDestroy(MassDestroyPertandinganRequest $request)
    {
        $pertandingans = Pertandingan::find(request('ids'));

        foreach ($pertandingans as $pertandingan) {
            $pertandingan->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
