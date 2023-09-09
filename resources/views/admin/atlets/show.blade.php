@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.atlet.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.atlets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.atlet.fields.id') }}
                        </th>
                        <td>
                            {{ $atlet->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atlet.fields.name') }}
                        </th>
                        <td>
                            {{ $atlet->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atlet.fields.kategori') }}
                        </th>
                        <td>
                            {{ App\Models\Atlet::KATEGORI_SELECT[$atlet->kategori] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atlet.fields.cabor') }}
                        </th>
                        <td>
                            {{ $atlet->cabor->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.atlets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection