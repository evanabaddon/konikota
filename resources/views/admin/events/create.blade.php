@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.event.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.events.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.event.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tgl_mulai">{{ trans('cruds.event.fields.tgl_mulai') }}</label>
                <input class="form-control date {{ $errors->has('tgl_mulai') ? 'is-invalid' : '' }}" type="text" name="tgl_mulai" id="tgl_mulai" value="{{ old('tgl_mulai') }}">
                @if($errors->has('tgl_mulai'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tgl_mulai') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.tgl_mulai_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tgl_selesai">{{ trans('cruds.event.fields.tgl_selesai') }}</label>
                <input class="form-control date {{ $errors->has('tgl_selesai') ? 'is-invalid' : '' }}" type="text" name="tgl_selesai" id="tgl_selesai" value="{{ old('tgl_selesai') }}">
                @if($errors->has('tgl_selesai'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tgl_selesai') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.tgl_selesai_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="venues">{{ trans('cruds.event.fields.venue') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('venues') ? 'is-invalid' : '' }}" name="venues[]" id="venues" multiple>
                    @foreach($venues as $id => $venue)
                        <option value="{{ $id }}" {{ in_array($id, old('venues', [])) ? 'selected' : '' }}>{{ $venue }}</option>
                    @endforeach
                </select>
                @if($errors->has('venues'))
                    <div class="invalid-feedback">
                        {{ $errors->first('venues') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.venue_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cabors">{{ trans('cruds.event.fields.cabor') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('cabors') ? 'is-invalid' : '' }}" name="cabors[]" id="cabors" multiple>
                    @foreach($cabors as $id => $cabor)
                        <option value="{{ $id }}" {{ in_array($id, old('cabors', [])) ? 'selected' : '' }}>{{ $cabor }}</option>
                    @endforeach
                </select>
                @if($errors->has('cabors'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cabors') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.cabor_helper') }}</span>
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