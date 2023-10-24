@can('atlet_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.atlets.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.atlet.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.atlet.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-caborAtlets">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.atlet.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.atlet.fields.nik') }}
                        </th>
                        <th>
                            {{ trans('cruds.atlet.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.atlet.fields.kategori') }}
                        </th>
                        <th>
                            {{ trans('cruds.atlet.fields.cabor') }}
                        </th>
                        <th>
                            {{ trans('cruds.atlet.fields.foto') }}
                        </th>
                        <th>
                            {{ trans('cruds.atlet.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($atlets as $key => $atlet)
                        <tr data-entry-id="{{ $atlet->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $atlet->id ?? '' }}
                            </td>
                            <td>
                                {{ $atlet->nik ?? '' }}
                            </td>
                            <td>
                                {{ $atlet->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Atlet::KATEGORI_SELECT[$atlet->kategori] ?? '' }}
                            </td>
                            <td>
                                {{ $atlet->cabor->name ?? '' }}
                            </td>
                            <td>
                                @if($atlet->foto)
                                    <a href="{{ $atlet->foto->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $atlet->status ?? '' }}
                            </td>
                            <td>
                                @can('atlet_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.atlets.show', $atlet->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('atlet_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.atlets.edit', $atlet->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('atlet_delete')
                                    <form action="{{ route('admin.atlets.destroy', $atlet->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('atlet_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.atlets.massDestroy') }}",
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
  let table = $('.datatable-caborAtlets:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection