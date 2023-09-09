@can('pertandingan_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.pertandingans.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.pertandingan.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.pertandingan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-eventPertandingans">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.pertandingan.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.pertandingan.fields.event') }}
                        </th>
                        <th>
                            {{ trans('cruds.pertandingan.fields.cabor') }}
                        </th>
                        <th>
                            {{ trans('cruds.pertandingan.fields.tgl_mulai') }}
                        </th>
                        <th>
                            {{ trans('cruds.pertandingan.fields.tgl_selesai') }}
                        </th>
                        <th>
                            {{ trans('cruds.pertandingan.fields.venue') }}
                        </th>
                        <th>
                            {{ trans('cruds.pertandingan.fields.hasil') }}
                        </th>
                        <th>
                            {{ trans('cruds.pertandingan.fields.medali') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pertandingans as $key => $pertandingan)
                        <tr data-entry-id="{{ $pertandingan->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $pertandingan->id ?? '' }}
                            </td>
                            <td>
                                {{ $pertandingan->event->name ?? '' }}
                            </td>
                            <td>
                                {{ $pertandingan->cabor->name ?? '' }}
                            </td>
                            <td>
                                {{ $pertandingan->tgl_mulai ?? '' }}
                            </td>
                            <td>
                                {{ $pertandingan->tgl_selesai ?? '' }}
                            </td>
                            <td>
                                {{ $pertandingan->venue->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Pertandingan::HASIL_SELECT[$pertandingan->hasil] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Pertandingan::MEDALI_SELECT[$pertandingan->medali] ?? '' }}
                            </td>
                            <td>
                                @can('pertandingan_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.pertandingans.show', $pertandingan->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('pertandingan_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.pertandingans.edit', $pertandingan->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('pertandingan_delete')
                                    <form action="{{ route('admin.pertandingans.destroy', $pertandingan->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('pertandingan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.pertandingans.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-eventPertandingans:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection