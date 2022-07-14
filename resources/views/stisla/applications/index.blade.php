@extends('stisla.layout')
@section('title', 'Applications')
@section('page_header', 'Applications')

@push('styles')
<link rel="stylesheet" href="{{ mix('/css/datatables.css') }}">
@endpush

@section('content')
<div class="section-body">
    <div class="row no-gutter align-items-center">
        <div class="col-12 col-md-6 col-lg-6 d-none d-sm-block">
            <div class="float-left">
                <h2 class="section-title">Personnel Area Applications</h2>
                <p class="section-lead">Master data of application.</p>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="float-right">
                <a href="{{ route('applications.index') }}" class="btn btn-sm btn-icon icon-left btn-light">
                    <i class="fa fa-sync"></i> Refresh
                </a>
                &nbsp;
                <a href="{{ route('applications.create') }}" class="btn btn-sm btn-icon icon-left btn-primary">
                    <i class="fas fa-plus-circle"></i> New Application
                </a>
            </div>
        </div>
    </div>
    <div class="clearfix">&nbsp;</div>
    <div class="row">
        <div class="col-12">
            <table id="dataTable" class="table table-hover table-borderless">
                <thead class="thead-default">
                    <th class="text-center">Name</th>
                    <th class="text-center">Target</th>
                    <th class="text-center">Updated</th>
                    <th class="text-center">Timestamps</th>
                </thead>
                <tbody>
                    @foreach($applications as $application)
                    <tr>
                        <td>
                            <strong class="text-lg">
                                @isset($application->icon)
                                    <i class="{{ $application->icon }}"></i>
                                @endisset
                                {{ $application->name }}
                            </strong>
                            <p>Target : {{ $application->target }}</p>
                            <div class="small">
                                <a class="text-muted delete" href="{{ route('applications.destroy', $application) }}"><i class="fa fa-trash"></i></a>
                                &nbsp;&nbsp;|&nbsp;
                                <a class="text-body" href="{{ route('applications.edit', $application) }}"><i class="fa fa-pencil-alt"></i>&nbsp;Edit</a>
                            </div>
                        </td>
                        <td>{{ $application->target }}</td>
                        <td>{{ $application->lastUpdate }}</td>
                        <td>
                            <p>
                                <em>Last Updated {{ $application->lastUpdate->diffForHumans(['aUnit' => true]) }}</em>,<br />
                                <small>Created at {{ $application->creationDate->toDayDateTimeString() }}</small>
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
            [2, 'desc']
        ],
        columnDefs: [{
            targets: [1, 2],
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