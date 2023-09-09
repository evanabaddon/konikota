@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.venue.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.venues.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.venue.fields.id') }}
                        </th>
                        <td>
                            {{ $venue->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venue.fields.name') }}
                        </th>
                        <td>
                            {{ $venue->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venue.fields.alamat') }}
                        </th>
                        <td>
                            {{ $venue->alamat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venue.fields.provinsi') }}
                        </th>
                        <td>
                            {{ $venue->provinsi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venue.fields.kota') }}
                        </th>
                        <td>
                            {{ $venue->kota }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.venues.index') }}">
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
            <a class="nav-link" href="#venue_pertandingans" role="tab" data-toggle="tab">
                {{ trans('cruds.pertandingan.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#venue_events" role="tab" data-toggle="tab">
                {{ trans('cruds.event.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="venue_pertandingans">
            @includeIf('admin.venues.relationships.venuePertandingans', ['pertandingans' => $venue->venuePertandingans])
        </div>
        <div class="tab-pane" role="tabpanel" id="venue_events">
            @includeIf('admin.venues.relationships.venueEvents', ['events' => $venue->venueEvents])
        </div>
    </div>
</div>

@endsection