@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.venue.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.venues.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.venue.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.venue.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="alamat">{{ trans('cruds.venue.fields.alamat') }}</label>
                <input class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}" type="text" name="alamat" id="alamat" value="{{ old('alamat', '') }}">
                @if($errors->has('alamat'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alamat') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.venue.fields.alamat_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="provinsi">{{ trans('cruds.venue.fields.provinsi') }}</label>
                <input class="form-control {{ $errors->has('provinsi') ? 'is-invalid' : '' }}" type="text" name="provinsi" id="provinsi" value="{{ old('provinsi', '') }}">
                @if($errors->has('provinsi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('provinsi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.venue.fields.provinsi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kota">{{ trans('cruds.venue.fields.kota') }}</label>
                <input class="form-control {{ $errors->has('kota') ? 'is-invalid' : '' }}" type="text" name="kota" id="kota" value="{{ old('kota', '') }}">
                @if($errors->has('kota'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kota') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.venue.fields.kota_helper') }}</span>
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