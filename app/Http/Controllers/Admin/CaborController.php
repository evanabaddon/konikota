<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCaborRequest;
use App\Http\Requests\StoreCaborRequest;
use App\Http\Requests\UpdateCaborRequest;
use App\Models\Cabor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CaborController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('cabor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cabors = Cabor::all();

        return view('admin.cabors.index', compact('cabors'));
    }

    public function create()
    {
        abort_if(Gate::denies('cabor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cabors.create');
    }

    public function store(StoreCaborRequest $request)
    {
        $cabor = Cabor::create($request->all());

        return redirect()->route('admin.cabors.index');
    }

    public function edit(Cabor $cabor)
    {
        abort_if(Gate::denies('cabor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cabors.edit', compact('cabor'));
    }

    public function update(UpdateCaborRequest $request, Cabor $cabor)
    {
        $cabor->update($request->all());

        return redirect()->route('admin.cabors.index');
    }

    public function show(Cabor $cabor)
    {
        abort_if(Gate::denies('cabor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cabor->load('caborPertandingans', 'caborAtlets', 'caborEvents');

        return view('admin.cabors.show', compact('cabor'));
    }

    public function destroy(Cabor $cabor)
    {
        abort_if(Gate::denies('cabor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cabor->delete();

        return back();
    }

    public function massDestroy(MassDestroyCaborRequest $request)
    {
        $cabors = Cabor::find(request('ids'));

        foreach ($cabors as $cabor) {
            $cabor->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
