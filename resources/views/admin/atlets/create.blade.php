@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.atlet.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.atlets.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.atlet.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atlet.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.atlet.fields.kategori') }}</label>
                <select class="form-control {{ $errors->has('kategori') ? 'is-invalid' : '' }}" name="kategori" id="kategori">
                    <option value disabled {{ old('kategori', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Atlet::KATEGORI_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('kategori', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('kategori'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kategori') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atlet.fields.kategori_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cabor_id">{{ trans('cruds.atlet.fields.cabor') }}</label>
                <select class="form-control select2 {{ $errors->has('cabor') ? 'is-invalid' : '' }}" name="cabor_id" id="cabor_id">
                    @foreach($cabors as $id => $entry)
                        <option value="{{ $id }}" {{ old('cabor_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('cabor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cabor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atlet.fields.cabor_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection