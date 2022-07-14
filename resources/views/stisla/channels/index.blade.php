@extends('stisla.layout')
@section('title', 'Channels')
@section('page_header', 'Channels')

@push('styles')
<link rel="stylesheet" href="{{ mix('/css/datatables.css') }}">
@endpush

@section('content')
<div class="section-body">
    <div class="row no-gutter align-items-center">
        <div class="col-12 col-md-6 col-lg-6 d-none d-sm-block">
            <div class="float-left">
                <h2 class="section-title">Publishing Channels</h2>
                <p class="section-lead">Master data of channel.</p>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="float-right">
                <a href="{{ route('channels.index') }}" class="btn btn-sm btn-icon icon-left btn-light">
                    <i class="fa fa-sync"></i> Refresh
                </a>
                &nbsp;
                <a href="{{ route('channels.create') }}" class="btn btn-sm btn-icon icon-left btn-primary">
                    <i class="fas fa-plus-circle"></i> New Channel
                </a>
            </div>
        </div>
    </div>
    <div class="clearfix">&nbsp;</div>
    <div class="row">
        <div class="col-12">
            <table id="dataTable" class="table table-hover table-borderless">
                <caption class="small">*Highlighted lines are channels that are not displayed on the web.</caption>
                <thead class="thead-default">
                    <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Media</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Keywords</th>
                        <th class="text-center">Timestamps</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($channels as $channel)
                    @continue(empty($channel->media))
                    <tr class="{{ $channel->isDisplayed ? '' : 'bg-gray-200' }}">
                        <td>
                            <strong class="text-lg">
                                <a href="{{ $channel->media->domain . '/' . $channel->slug }}" target="_blank">{{ $channel->name }}</a>
                            </strong> &mdash; <em>{{ $channel->media->name }}</em>
                            <p>{{ $channel->meta['title'] }}</p>
                            <div class="small">
                                <a class="text-gray-500 delete" href="{{ route('channels.destroy', ['id' => $channel->id]) }}"><i class="fas fa fa-trash"></i></a>
                                &nbsp;|&nbsp;
                                <a class="text-gray-600" href="{{ route('channels.edit', ['id' => $channel->id]) }}"><i class="fas fa fa-pencil-alt"></i>&nbsp;Edit</a>
                            </div>
                        </td>
                        <td>{{ $channel->media->name }}</td>
                        <td>{{ $channel->meta['description'] }}</td>
                        <td>{{ $channel->meta['keywords'] }}</td>
                        <td>
                            <p>
                                <em>Last Updated {{ $channel->lastUpdate->diffForHumans(['aUnit' => true]) }}</em>,<br />
                                <small>Created at {{ $channel->creationDate->toDayDateTimeString() }}</small>
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