@extends('stisla.layout')
@section('title', 'Media')
@section('page_header', 'Media')

@push('styles')
<link rel="stylesheet" href="{{ mix('/css/datatables.css') }}">
@endpush

@section('content')
<div class="section-body">
    <div class="row no-gutter align-items-center">
        <div class="col-12 col-md-6 col-lg-6 d-none d-sm-block">
            <div class="float-left">
                <h2 class="section-title">Publishing Media</h2>
                <p class="section-lead">Master data of media.</p>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="float-right">
                <a href="{{ route('media.index') }}" class="btn btn-sm btn-icon icon-left btn-light">
                    <i class="fa fa-sync"></i> Refresh
                </a>
                &nbsp;
                <a href="{{ route('media.create') }}" class="btn btn-sm btn-icon icon-left btn-primary">
                    <i class="fas fa-plus-circle"></i> New Media
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
                        <th class="text-center">Group Name</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Analytics ID</th>
                        <th class="text-center">Updated</th>
                        <th class="text-center">Timestamps</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($media as $medium)
                    <tr>
                        <td>
                            <div class="media">
                                <img class="mr-3" width="64" src="{{ Storage::url(implode('', $medium->assets['logo']))}}" alt="{{ $medium->name }}" />
                                <div class="media-body">
                                    <strong class="text-lg">
                                        <a href="{{ $medium->domain }}" target="_blank">{{ $medium->name }}</a>
                                    </strong>
                                    <p>{{ isset($medium->meta['title']) ? $medium->meta['title'] : null }}</p>
                                </div>
                            </div>
                            <div class="small">
                                <a class="text-muted delete" href="{{ route('media.destroy', $medium) }}"><i class="fas fa fa-trash"></i></a>
                                &nbsp;|&nbsp;
                                <a class="text-body" href="{{ route('media.edit', $medium) }}"><i class="fas fa fa-pencil-alt"></i>&nbsp;Edit</a>
                            </div>
                        </td>
                        <td>{{ isset($medium->meta['title']) ? $medium->meta['title'] : null }}</td>
                        <td>{{ $medium->groupId }}</td>
                        <td>{{ isset($medium->meta['description']) ? $medium->meta['description'] : null }}</td>
                        <td>{{ isset($medium->analytics['gaId']) ? $medium->analytics['gaId'] : null }}</td>
                        <td>{{ $medium->lastUpdate }}</td>
                        <td>
                            <p>
                                <em>Last Updated {{ $medium->lastUpdate->diffForHumans(['aUnit' => true]) }}</em>,<br />
                                <small>Created at {{ $medium->creationDate->toDayDateTimeString() }}</small>
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
            [5, 'desc']
        ],
        columnDefs: [{
            targets: [1, 2, 3, 4, 5],
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