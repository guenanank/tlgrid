@extends('stisla.layout')
@section('title', 'Authorizations')
@section('page_header', 'Authorizations')

@push('styles')
<link rel="stylesheet" href="{{ mix('/css/datatables.css') }}">
@endpush

@section('content')
<div class="section-body">
    <div class="row no-gutter align-items-center">
        <div class="col-12 col-md-6 col-lg-6 d-none d-sm-block">
            <div class="float-left">
                <h2 class="section-title">Personnel Area Authorizations</h2>
                <p class="section-lead">Master data of authorization.</p>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="float-right">
                <a href="{{ route('authorizations.index') }}" class="btn btn-sm btn-icon icon-left btn-light">
                    <i class="fa fa-sync"></i> Refresh
                </a>
                &nbsp;
                <a href="{{ route('authorizations.create') }}" class="btn btn-sm btn-icon icon-left btn-primary">
                    <i class="fas fa-plus-circle"></i> New Authorization
                </a>
            </div>
        </div>
    </div>
    <div class="clearfix">&nbsp;</div>
    <div class="row">
        <div class="col-12">
            <table id="dataTable" class="table table-hover table-borderless">
                <thead class="thead-default">
                    <th class="text-center">Application</th>
                    <th class="text-center">Rules</th>
                    <th class="text-center">Updated</th>
                    <th class="text-center">Timestamps</th>
                </thead>
                <tbody>
                    @foreach($authorizations as $authorization)
                    <tr>
                        <td>
                            <strong class="text-lg">{{ $authorization->application->name }}</strong>
                            <p>Rules : {{ $authorization->rules_name }} </p>
                            <div class="small">
                                <a class="text-muted delete" href="{{ route('authorizations.destroy', $authorization) }}"><i class="fa fa-trash"></i></a>
                                &nbsp;&nbsp;|&nbsp;
                                <a class="text-body" href="{{ route('authorizations.edit', $authorization) }}"><i class="fa fa-pencil-alt"></i>&nbsp;Edit</a>
                            </div>
                        </td>
                        <td></td>
                        <td>{{ $authorization->lastUpdate }}</td>
                        <td>
                            <p>
                                <em>Last Updated {{ $authorization->lastUpdate->diffForHumans(['aUnit' => true]) }}</em>,<br />
                                <small>Created at {{ $authorization->creationDate->toDayDateTimeString() }}</small>
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