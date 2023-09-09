@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.pertandingan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.pertandingans.update", [$pertandingan->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="event_id">{{ trans('cruds.pertandingan.fields.event') }}</label>
                <select class="form-control select2 {{ $errors->has('event') ? 'is-invalid' : '' }}" name="event_id" id="event_id">
                    @foreach($events as $id => $entry)
                        <option value="{{ $id }}" {{ (old('event_id') ? old('event_id') : $pertandingan->event->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('event'))
                    <div class="invalid-feedback">
                        {{ $errors->first('event') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pertandingan.fields.event_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cabor_id">{{ trans('cruds.pertandingan.fields.cabor') }}</label>
                <select class="form-control select2 {{ $errors->has('cabor') ? 'is-invalid' : '' }}" name="cabor_id" id="cabor_id">
                    @foreach($cabors as $id => $entry)
                        <option value="{{ $id }}" {{ (old('cabor_id') ? old('cabor_id') : $pertandingan->cabor->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('cabor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cabor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pertandingan.fields.cabor_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tgl_mulai">{{ trans('cruds.pertandingan.fields.tgl_mulai') }}</label>
                <input class="form-control date {{ $errors->has('tgl_mulai') ? 'is-invalid' : '' }}" type="text" name="tgl_mulai" id="tgl_mulai" value="{{ old('tgl_mulai', $pertandingan->tgl_mulai) }}">
                @if($errors->has('tgl_mulai'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tgl_mulai') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pertandingan.fields.tgl_mulai_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tgl_selesai">{{ trans('cruds.pertandingan.fields.tgl_selesai') }}</label>
                <input class="form-control date {{ $errors->has('tgl_selesai') ? 'is-invalid' : '' }}" type="text" name="tgl_selesai" id="tgl_selesai" value="{{ old('tgl_selesai', $pertandingan->tgl_selesai) }}">
                @if($errors->has('tgl_selesai'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tgl_selesai') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pertandingan.fields.tgl_selesai_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="venue_id">{{ trans('cruds.pertandingan.fields.venue') }}</label>
                <select class="form-control select2 {{ $errors->has('venue') ? 'is-invalid' : '' }}" name="venue_id" id="venue_id">
                    @foreach($venues as $id => $entry)
                        <option value="{{ $id }}" {{ (old('venue_id') ? old('venue_id') : $pertandingan->venue->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('venue'))
                    <div class="invalid-feedback">
                        {{ $errors->first('venue') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pertandingan.fields.venue_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.pertandingan.fields.hasil') }}</label>
                <select class="form-control {{ $errors->has('hasil') ? 'is-invalid' : '' }}" name="hasil" id="hasil">
                    <option value disabled {{ old('hasil', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Pertandingan::HASIL_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('hasil', $pertandingan->hasil) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('hasil'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hasil') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pertandingan.fields.hasil_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.pertandingan.fields.medali') }}</label>
                <select class="form-control {{ $errors->has('medali') ? 'is-invalid' : '' }}" name="medali" id="medali">
                    <option value disabled {{ old('medali', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Pertandingan::MEDALI_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('medali', $pertandingan->medali) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('medali'))
                    <div class="invalid-feedback">
                        {{ $errors->first('medali') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pertandingan.fields.medali_helper') }}</span>
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