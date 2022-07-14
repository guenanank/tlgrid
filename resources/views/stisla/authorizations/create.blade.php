@extends('stisla.layout')
@section('title', "Authorizations › Create")
@section('page_header', 'Authorizations')

@push('styles')
<link rel="stylesheet" href="{{ mix('/css/select2.css') }}">
@endpush

@section('content')
<div class="section-body">
    <div class="row no-gutter align-items-center">
        <div class="col-12 col-md-6 col-lg-6 d-none d-sm-block">
            <div class="float-left">
                <h2 class="section-title">Personnel Area Authorizations</h2>
                <p class="section-lead">Create new authorization.</p>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="float-right">
                <a href="{{ route('authorizations.index') }}" class="btn btn-sm btn-icon icon-left btn-light">
                    <i class="fa fa-arrow-circle-left"></i> Return
                </a>
            </div>
        </div>
    </div>
    <div class="clearfix">&nbsp;</div>
    <form method="POST" action="{{ route('authorizations.store') }}" class="ajaxForm form-group" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="appId">Application Name</label>
            <select name="appId" class="form-control select2" id="appId" aria-describedby="appIdHelp" title="Select application">
                <option></option>
                @foreach($applications as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            <small id="appIdHelp" class="form-text text-danger"></small>
        </div>

        <div class="form-group">
            <div class="control-label">Rules</div>
            <label class="custom-switch mt-2">
                <input type="checkbox" name="rules[]" value="viewAny" class="custom-switch-input" id="rulesViewAny" aria-describedby="rulesViewAnyHelp" checked>
                <span class="custom-switch-indicator"></span>
                <span class="custom-switch-description">View Any</span>
            </label>
            <small id="rulesViewAnyHelp" class="form-text text-danger"></small>

            <label class="custom-switch mt-2">
                <input type="checkbox" name="rules[]" value="view" class="custom-switch-input" id="rulesView" aria-describedby="rulesViewHelp">
                <span class="custom-switch-indicator"></span>
                <span class="custom-switch-description">View</span>
            </label>
            <small id="rulesViewHelp" class="form-text text-danger"></small>

            <label class="custom-switch mt-2">
                <input type="checkbox" name="rules[]" value="create" class="custom-switch-input" id="rulesCreate" aria-describedby="rulesCreateHelp">
                <span class="custom-switch-indicator"></span>
                <span class="custom-switch-description">Create</span>
            </label>
            <small id="rulesCreateHelp" class="form-text text-danger"></small>

            <label class="custom-switch mt-2">
                <input type="checkbox" name="rules[]" value="update" class="custom-switch-input" id="rulesUpdate" aria-describedby="rulesUpdateHelp">
                <span class="custom-switch-indicator"></span>
                <span class="custom-switch-description">Update</span>
            </label>
            <small id="rulesUpdateHelp" class="form-text text-danger"></small>

            <label class="custom-switch mt-2">
                <input type="checkbox" name="rules[]" value="delete" class="custom-switch-input" id="rulesDelete" aria-describedby="rulesDeleteHelp">
                <span class="custom-switch-indicator"></span>
                <span class="custom-switch-description">Delete</span>
            </label>
            <small id="rulesDeleteHelp" class="form-text text-danger"></small>

            <label class="custom-switch mt-2">
                <input type="checkbox" name="rules[]" value="restore" class="custom-switch-input" id="rulesRestore" aria-describedby="rulesRestoreHelp">
                <span class="custom-switch-indicator"></span>
                <span class="custom-switch-description">Restore</span>
            </label>
            <small id="rulesRestoreHelp" class="form-text text-danger"></small>

            <label class="custom-switch mt-2">
                <input type="checkbox" name="rules[]" value="forceDelete" class="custom-switch-input" id="rulesForceDelete" aria-describedby="rulesForceDeleteHelp">
                <span class="custom-switch-indicator"></span>
                <span class="custom-switch-description">Force Delete</span>
            </label>
            <small id="rulesForceDeleteHelp" class="form-text text-danger"></small>
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