@extends('stisla.layout')
@section('title', "Groups › Create")
@section('page_header', 'Groups')

@push('styles')
<link rel="stylesheet" href="{{ mix('/css/summernote.css') }}">
@endpush

@section('content')
<div class="section-body">
    <div class="row no-gutter align-items-center">
        <div class="col-12 col-md-6 col-lg-6 d-none d-sm-block">
            <div class="float-left">
                <h2 class="section-title">Publishing Groups</h2>
                <p class="section-lead">Create new group.</p>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="float-right">
                <a href="{{ route('groups.index') }}" class="btn btn-sm btn-icon icon-left btn-light">
                    <i class="fa fa-arrow-circle-left"></i> Return
                </a>
            </div>
        </div>
    </div>
    <div class="clearfix">&nbsp;</div>
    <form method="POST" action="{{ route('groups.store') }}" class="ajaxForm form-group" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="code">Code</label>
            <input name="code" type="text" class="form-control" id="code" aria-describedby="codeHelp" placeholder="Enter group code">
            <small id="codeHelp" class="form-text text-danger"></small>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter group name">
            <small id="nameHelp" class="form-text text-danger"></small>
        </div>
        <div class="form-group">
            <label for="analyticsPropertyId">Analytics</label>
            <input name="analytics[propertyId]" type="text" class="form-control" id="analyticsPropertyId" aria-describedby="analyticsPropertyIdHelp" placeholder="Enter group google analytics property id">
            <small id="analyticsPropertyIdHelp" class="form-text text-danger"></small>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Metadata</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input name="meta[title]" type="text" class="form-control" aria-describedby="metaTitleHelp" placeholder="Title for group">
                    <small id="metaTitleHelp" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <textarea name="meta[description]" class="form-control autosize" aria-describedby="metaDescriptionHelp" placeholder="Group description"></textarea>
                    <small id="metaDescriptionHelp" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <textarea name="meta[privacy]" class="form-control summernote-simple" aria-describedby="metaPrivacyHelp" placeholder="Group privacy rules"></textarea>
                    <small id="metaPrivacyHelp" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <textarea name="meta[guideline]" class="form-control summernote-simple" aria-describedby="metaGuidelineHelp" placeholder="Group cyber media guideline"></textarea>
                    <small id="metaGuidelineHelp" class="form-text text-danger"></small>
                </div>
            </div>
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
<script src="{{ mix('/js/summernote.js') }}"></script>
<script src="{{ mix('/js/summernote-fontawesome.js') }}"></script>
@endpush

@push('scripts')
<script>
    
</script>
@endpush