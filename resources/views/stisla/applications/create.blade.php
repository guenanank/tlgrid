@extends('stisla.layout')
@section('title', "Applications › Create")
@section('page_header', 'Applications')

@push('styles')
<link rel="stylesheet" href="{{ mix('/css/select2.css') }}">
@endpush

@section('content')
<div class="section-body">
    <div class="row no-gutter align-items-center">
        <div class="col-12 col-md-6 col-lg-6 d-none d-sm-block">
            <div class="float-left">
                <h2 class="section-title">Personnel Area Applications</h2>
                <p class="section-lead">Create new application.</p>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="float-right">
                <a href="{{ route('applications.index') }}" class="btn btn-sm btn-icon icon-left btn-light">
                    <i class="fa fa-arrow-circle-left"></i> Return
                </a>
            </div>
        </div>
    </div>
    <div class="clearfix">&nbsp;</div>
    <form method="POST" action="{{ route('applications.store') }}" class="ajaxForm form-group" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter application name">
            <small id="nameHelp" class="form-text text-danger"></small>
        </div>

        <div class="form-group">
            <label for="target">Target</label>
            <input name="target" type="text" class="form-control" id="target" aria-describedby="targetHelp" placeholder="Enter application target route">
            <small id="targetHelp" class="form-text text-danger"></small>
        </div>

        <div class="form-group">
            <label for="sub">Sub From</label>
            <select name="sub" class="form-control select2" id="sub" aria-describedby="subHelp" title="Select application parent">
                <option></option>
                @foreach($applications as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            <small id="subHelp" class="form-text text-danger"></small>
        </div>

        <div class="form-group">
            <label for="icon">Icon</label>
            <input name="icon" type="text" class="form-control" id="icon" aria-describedby="iconHelp" placeholder="Enter application icon">
            <small id="iconHelp" class="form-text text-danger"></small>
        </div>

        <div class="form-group row mb-4">
            <div class="col-sm-12 col-md-7">
                <button type="submit" class="btn btn-sm btn-icon icon-left btn-primary">
                    <i class="fas fa-check-circle"></i> Submit data
                </button>
            </div>
        </div>

    </form>
</div>
@endsection

@push('jslib')
<script src="{{ mix('/js/select2.js') }}"></script>
@endpush

@push('scripts')
<script>

</script>
@endpush