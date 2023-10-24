@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.atlet.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.atlets.update", [$atlet->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="nik">{{ trans('cruds.atlet.fields.nik') }}</label>
                <input class="form-control {{ $errors->has('nik') ? 'is-invalid' : '' }}" type="text" name="nik" id="nik" value="{{ old('nik', $atlet->nik) }}">
                @if($errors->has('nik'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nik') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atlet.fields.nik_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.atlet.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $atlet->name) }}">
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
                        <option value="{{ $key }}" {{ old('kategori', $atlet->kategori) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
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
                        <option value="{{ $id }}" {{ (old('cabor_id') ? old('cabor_id') : $atlet->cabor->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <label for="foto">{{ trans('cruds.atlet.fields.foto') }}</label>
                <div class="needsclick dropzone {{ $errors->has('foto') ? 'is-invalid' : '' }}" id="foto-dropzone">
                </div>
                @if($errors->has('foto'))
                    <div class="invalid-feedback">
                        {{ $errors->first('foto') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atlet.fields.foto_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('cruds.atlet.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', $atlet->status) }}">
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atlet.fields.status_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.fotoDropzone = {
    url: '{{ route('admin.atlets.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="foto"]').remove()
      $('form').append('<input type="hidden" name="foto" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="foto"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($atlet) && $atlet->foto)
      var file = {!! json_encode($atlet->foto) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="foto" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection