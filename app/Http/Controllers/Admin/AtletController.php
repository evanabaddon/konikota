<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAtletRequest;
use App\Http\Requests\StoreAtletRequest;
use App\Http\Requests\UpdateAtletRequest;
use App\Models\Atlet;
use App\Models\Cabor;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AtletController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('atlet_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $atlets = Atlet::with(['cabor', 'media'])->get();

        $cabors = Cabor::get();

        return view('admin.atlets.index', compact('atlets', 'cabors'));
    }

    public function create()
    {
        abort_if(Gate::denies('atlet_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cabors = Cabor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.atlets.create', compact('cabors'));
    }

    public function store(StoreAtletRequest $request)
    {
        $atlet = Atlet::create($request->all());

        if ($request->input('foto', false)) {
            $atlet->addMedia(storage_path('tmp/uploads/' . basename($request->input('foto'))))->toMediaCollection('foto');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $atlet->id]);
        }

        return redirect()->route('admin.atlets.index');
    }

    public function edit(Atlet $atlet)
    {
        abort_if(Gate::denies('atlet_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cabors = Cabor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $atlet->load('cabor');

        return view('admin.atlets.edit', compact('atlet', 'cabors'));
    }

    public function update(UpdateAtletRequest $request, Atlet $atlet)
    {
        $atlet->update($request->all());

        if ($request->input('foto', false)) {
            if (! $atlet->foto || $request->input('foto') !== $atlet->foto->file_name) {
                if ($atlet->foto) {
                    $atlet->foto->delete();
                }
                $atlet->addMedia(storage_path('tmp/uploads/' . basename($request->input('foto'))))->toMediaCollection('foto');
            }
        } elseif ($atlet->foto) {
            $atlet->foto->delete();
        }

        return redirect()->route('admin.atlets.index');
    }

    public function show(Atlet $atlet)
    {
        abort_if(Gate::denies('atlet_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $atlet->load('cabor');

        return view('admin.atlets.show', compact('atlet'));
    }

    public function destroy(Atlet $atlet)
    {
        abort_if(Gate::denies('atlet_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $atlet->delete();

        return back();
    }

    public function massDestroy(MassDestroyAtletRequest $request)
    {
        $atlets = Atlet::find(request('ids'));

        foreach ($atlets as $atlet) {
            $atlet->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('atlet_create') && Gate::denies('atlet_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Atlet();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
