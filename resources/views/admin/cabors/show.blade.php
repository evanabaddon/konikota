@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cabor.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cabors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cabor.fields.id') }}
                        </th>
                        <td>
                            {{ $cabor->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cabor.fields.logo') }}
                        </th>
                        <td>
                            @if($cabor->logo)
                                <a href="{{ $cabor->logo->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cabor.fields.name') }}
                        </th>
                        <td>
                            {{ $cabor->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cabors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#cabor_pertandingans" role="tab" data-toggle="tab">
                {{ trans('cruds.pertandingan.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#cabor_atlets" role="tab" data-toggle="tab">
                {{ trans('cruds.atlet.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#cabor_events" role="tab" data-toggle="tab">
                {{ trans('cruds.event.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="cabor_pertandingans">
            @includeIf('admin.cabors.relationships.caborPertandingans', ['pertandingans' => $cabor->caborPertandingans])
        </div>
        <div class="tab-pane" role="tabpanel" id="cabor_atlets">
            @includeIf('admin.cabors.relationships.caborAtlets', ['atlets' => $cabor->caborAtlets])
        </div>
        <div class="tab-pane" role="tabpanel" id="cabor_events">
            @includeIf('admin.cabors.relationships.caborEvents', ['events' => $cabor->caborEvents])
        </div>
    </div>
</div>

@endsection