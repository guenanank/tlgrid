@extends('stisla.layout')
@section('title', 'Groups')
@section('page_header', 'Groups')

@push('styles')
<link rel="stylesheet" href="{{ mix('/css/datatables.css') }}">
@endpush

@section('content')
<div class="section-body">
    <div class="row no-gutter align-items-center">
        <div class="col-12 col-md-6 col-lg-6 d-none d-sm-block">
            <div class="float-left">
                <h2 class="section-title">Publishing Groups</h2>
                <p class="section-lead">Master data of group.</p>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="float-right">
                <a href="{{ route('groups.index') }}" class="btn btn-sm btn-icon icon-left btn-light">
                    <i class="fa fa-sync"></i> Refresh
                </a>
                &nbsp;
                <a href="{{ route('groups.create') }}" class="btn btn-sm btn-icon icon-left btn-primary">
                    <i class="fas fa-plus-circle"></i> New Group
                </a>
            </div>
        </div>
    </div>
    <div class="clearfix">&nbsp;</div>
    <div class="row">
        <div class="col-12">
            <table id="dataTable" class="table table-hover table-borderless">
                <thead class="thead-default">
                    <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Title</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Analytics ID</th>
                        <th class="text-center">Updated</th>
                        <th class="text-center">Timestamps</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($groups as $group)
                    <tr>
                        <td>
                            <strong class="text-lg">{{ $group->name }}</strong>
                            <p>{{ isset($group->meta['title']) ? $group->meta['title'] : null }}</p>
                            <div class="small">
                                <a class="text-muted delete" href="{{ route('groups.destroy', $group) }}"><i class="fa fa-trash"></i></a>
                                &nbsp;&nbsp;|&nbsp;
                                <a class="text-body" href="{{ route('groups.edit', $group) }}"><i class="fa fa-pencil-alt"></i>&nbsp;Edit</a>
                            </div>
                        </td>
                        <td>{{ isset($group->meta['title']) ? $group->meta['title'] : null }}</td>
                        <td>{{ isset($group->meta['description']) ? $group->meta['description'] : null }}</td>
                        <td>{{ isset($group->analytics['propertyId']) ? $group->analytics['propertyId'] : null }}</td>
                        <td>{{ $group->lastUpdate }}</td>
                        <td>
                            <p>
                                <em>Last Updated {{ $group->lastUpdate->diffForHumans(['aUnit' => true]) }}</em>,<br />
                                <small>Created at {{ $group->creationDate->toDayDateTimeString() }}</small>
                            </p>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('jslib')
<script src="{{ mix('/js/jquery.dataTables.js') }}"></script>
<script src="{{ mix('/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ mix('/js/select.bootstrap4.js') }}"></script>
@endpush

@push('scripts')
<script>
    $('table#dataTable').DataTable({
        order: [
            [3, 'desc']
        ],
        columnDefs: [{
            targets: [1, 2, 3, 4],
            visible: false
        }, {
            className: 'text-right',
            targets: [-1]
        }],
        drawCallback: function(settings) {
            $('table#dataTable thead').remove();
        },
    })
</script>
@endpush