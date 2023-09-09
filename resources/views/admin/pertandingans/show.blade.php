@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pertandingan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pertandingans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pertandingan.fields.id') }}
                        </th>
                        <td>
                            {{ $pertandingan->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pertandingan.fields.event') }}
                        </th>
                        <td>
                            {{ $pertandingan->event->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pertandingan.fields.cabor') }}
                        </th>
                        <td>
                            {{ $pertandingan->cabor->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pertandingan.fields.tgl_mulai') }}
                        </th>
                        <td>
                            {{ $pertandingan->tgl_mulai }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pertandingan.fields.tgl_selesai') }}
                        </th>
                        <td>
                            {{ $pertandingan->tgl_selesai }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pertandingan.fields.venue') }}
                        </th>
                        <td>
                            {{ $pertandingan->venue->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pertandingan.fields.hasil') }}
                        </th>
                        <td>
                            {{ App\Models\Pertandingan::HASIL_SELECT[$pertandingan->hasil] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pertandingan.fields.medali') }}
                        </th>
                        <td>
                            {{ App\Models\Pertandingan::MEDALI_SELECT[$pertandingan->medali] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pertandingans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection