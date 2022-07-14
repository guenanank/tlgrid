@extends('stisla.layout')
@section('title', "Channels › Create")
@section('page_header', 'Channels')

@push('styles')
<link rel="stylesheet" href="{{ mix('/css/select2.css') }}">
<link rel="stylesheet" href="{{ mix('/css/tagsinput.css') }}">
<link rel="stylesheet" href="{{ mix('/css/summernote.css') }}">
<link rel="stylesheet" href="{{ mix('/css/fileinput.css') }}">
@endpush

@section('content')
<div class="section-body">
    <div class="row no-gutter align-items-center">
        <div class="col-12 col-md-6 col-lg-6 d-none d-sm-block">
            <div class="float-left">
                <h2 class="section-title">Publishing Channels</h2>
                <p class="section-lead">Create new channel.</p>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="float-right">
                <a href="{{ route('channels.index') }}" class="btn btn-sm btn-icon icon-left btn-light">
                    <i class="fa fa-arrow-circle-left"></i> Return
                </a>
            </div>
        </div>
    </div>
    <div class="clearfix">&nbsp;</div>
    <form method="POST" action="{{ route('channels.store') }}" class="ajaxForm" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="mediaId">Media</label>
            <select name="mediaId" class="form-control select2" id="mediaId" aria-describedby="mediaIdHelp" title="Select media">
                @foreach($groups as $group)
                <optgroup label="{{ $group->name }}">
                    @foreach($group->media as $media)
                    <option value="{{ $media->id }}" data-subtext="{{ $media->meta['title'] }}">{{ $media->name }}</option>
                    @endforeach
                </optgroup>
                @endforeach
            </select>
            <small id="mediaIdHelp" class="form-text text-danger"></small>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter channel name">
            <small id="nameHelp" class="form-text text-danger"></small>
        </div>
        <div class="form-group">
            <label for="sub">Sub From</label>
            <select name="sub" class="form-control select2" id="sub" aria-describedby="subHelp" title="Select parent channel">
                @foreach($parent as $channel)
                <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                @endforeach
            </select>
            <small id="subHelp" class="form-text text-danger"></small>
        </div>
        <div class="form-group">
            <label for="sort">Order</label>
            <input name="sort" type="number" class="form-control" id="sort" aria-describedby="sortHelp" placeholder="Enter channel sort order">
            <small id="sortHelp" class="form-text text-danger"></small>
        </div>
        <div class="form-group">
            <div class="control-label">Is Displayed Channel</div>
            <label class="custom-switch mt-2">
                <input type="checkbox" name="isDisplayed" value="1" class="custom-switch-input" id="isDisplayed" aria-describedby="isDisplayedHelp" checked>
                <span class="custom-switch-indicator"></span>
                <span class="custom-switch-description">Show channel</span>
            </label>
            <small id="isDisplayedHelp" class="form-text text-danger"></small>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Metadata</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input name="meta[title]" type="text" class="form-control" aria-describedby="metaTitleHelp" placeholder="Title for channel">
                    <small id="metaTitleHelp" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="keyword">Keyword</label>
                    <input name="meta[keyword]" type="text" class="form-control inputtags" aria-describedby="metaKeywordHelp" placeholder="Keywords that describe the channel (separated by comma)">
                    <small id="metaKeywordHelp" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="meta[description]" class="summernote-simple" aria-describedby="metaDescriptionHelp" placeholder="Channel description"></textarea>
                    <small id="metaDescriptionHelp" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <input type="hidden" name="meta[cover]" />
                    <input type="file" name="cover" class="custom-file-input fileinput-simple" aria-describedby="metaCoverHelp" data-msg-placeholder="Chose cover file">
                    <small id="metaCoverHelp" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="analyticsPropertyId">Analytics</label>
                    <input name="analytics[propertyId]" type="text" class="form-control" id="analyticsPropertyId" aria-describedby="analyticsPropertyIdHelp" placeholder="Enter channel google analytics property id">
                    <small id="analyticsPropertyIdHelp" class="form-text text-danger"></small>
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
<script src="{{ mix('/js/select2.js') }}"></script>
<script src="{{ mix('/js/tagsinput.js') }}"></script>
<script src="{{ mix('/js/fileinput.js') }}"></script>
<script src="{{ mix('/js/fileinput-fa.js') }}"></script>
<script src="{{ mix('/js/summernote.js') }}"></script>
<script src="{{ mix('/js/summernote-fontawesome.js') }}"></script>
@endpush

@push('scripts')
<script>
    $('.inputtags').tagsinput('items')

    $.fn.fileinputBsVersion = '4.6.1'
    $('.fileinput-simple').fileinput({
        theme: 'fa',
        browseLabel: 'Find',
        showRemove: false,
        showUpload: false,
        showPreview: false
    })
</script>
@endpush