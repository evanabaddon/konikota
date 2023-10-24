<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCaborRequest;
use App\Http\Requests\StoreCaborRequest;
use App\Http\Requests\UpdateCaborRequest;
use App\Models\Cabor;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CaborController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('cabor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cabors = Cabor::with(['media'])->get();

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

        if ($request->input('logo', false)) {
            $cabor->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $cabor->id]);
        }

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

        if ($request->input('logo', false)) {
            if (! $cabor->logo || $request->input('logo') !== $cabor->logo->file_name) {
                if ($cabor->logo) {
                    $cabor->logo->delete();
                }
                $cabor->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($cabor->logo) {
            $cabor->logo->delete();
        }

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

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('cabor_create') && Gate::denies('cabor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Cabor();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
