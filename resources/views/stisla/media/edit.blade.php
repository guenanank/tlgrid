@extends('stisla.layout')
@section('title', 'Media › Edit')
@section('page_header', 'Media')

@push('styles')
<link rel="stylesheet" href="{{ mix('/css/colorpicker.css') }}">
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
                <h2 class="section-title">Publishing Media</h2>
                <p class="section-lead">Edit media.</p>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="float-right">
                <a href="{{ route('media.index') }}" class="btn btn-sm btn-icon icon-left btn-light">
                    <i class="fa fa-arrow-circle-left"></i> Return
                </a>
            </div>
        </div>
    </div>
    <div class="clearfix">&nbsp;</div>
    <form method="POST" action="{{ route('media.update', $medium) }}" class="ajaxForm" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-12 col-sm-12 col-md-3">
                <ul class="nav nav-pills flex-column" id="mediaTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="mandatory-tab" data-toggle="tab" href="#mandatory" role="tab" aria-controls="mandatory" aria-selected="true">Mandatory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="meta-tab" data-toggle="tab" href="#meta" role="tab" aria-controls="meta" aria-selected="true">Meta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="analytics-tab" data-toggle="tab" href="#analytics" role="tab" aria-controls="analytics" aria-selected="false">Analytics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="assets-tab" data-toggle="tab" href="#assets" role="tab" aria-controls="assets" aria-selected="false">Assets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="social-tab" data-toggle="tab" href="#social" role="tab" aria-controls="social" aria-selected="false">Social Media</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="masthead-tab" data-toggle="tab" href="#masthead" role="tab" aria-controls="masthead" aria-selected="false">Masthead</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-sm-12 col-md-9">
                <div class="tab-content no-padding" id="mediaTabContent">
                    <div class="tab-pane fade show active" id="mandatory" role="tabpanel" aria-labelledby="mandatory-tab">
                        <div class="form-group">
                            <label for="groupId">Group</label>
                            <select name="groupId" class="form-control select2" id="groupId" aria-describedby="groupIdHelp" title="Select media group">
                                @foreach($groups as $id => $name)
                                <option value="{{ $id }}" @selected($medium->groupId == $id)>{{ $name }}</option>
                                @endforeach
                            </select>
                            <small id="groupIdHelp" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input name="name" type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter media name" value="{{ $medium->name }}">
                            <small id="nameHelp" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="domain">Domain</label>
                            <input name="domain" type="text" class="form-control" id="domain" aria-describedby="domainHelp" placeholder="Enter media domain url" value="{{ $medium->domain }}">
                            <small id="domainHelp" class="form-text text-danger"></small>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="meta" role="tabpanel" aria-labelledby="meta-tab">
                        <div class="form-group">
                            <label for="metaTitle">Title</label>
                            <input name="meta[title]" type="text" class="form-control" aria-describedby="metaTitleHelp" placeholder="Enter title for media" value="{{ $medium->meta['title'] ?? $medium->meta['title'] }}">
                            <small id="metaTitleHelp" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="metaKeywords">Keywords</label>
                            <input name="meta[keywords]" type="text" class="form-control inputtags" aria-describedby="metaKeywordsHelp" placeholder="Enter keywords that describe the media (separated by comma)" value="{{ $medium->meta['keywords'] ?? $medium->meta['keywords'] }}">
                            <small id="metaKeywordsHelp" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="metaColor">Color</label>
                            <div class="input-group colorpickerinput colorpicker-element" data-colorpicker-id="2">
                                <input type="text" name="meta[color]" class="form-control" aria-describedby="metaColorHelp" placeholder="Enter color for media" value="{{ $medium->meta['color'] ?? $medium->meta['color'] }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="fas fa-fill-drip"></i>
                                    </div>
                                </div>
                            </div>
                            <small id="metaColorHelp" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="metaDescription">Description</label>
                            <textarea name="meta[description]" class="form-control autosize" aria-describedby="metaDescriptionHelp" placeholder="Ender media description">{{ $medium->meta['description'] ?? $medium->meta['description'] }}</textarea>
                            <small id="metaDescriptionHelp" class="form-text text-danger"></small>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="analytics" role="tabpanel" aria-labelledby="analytics-tab">
                        <div class="form-group">
                            <label for="analyticsGaId">Analytic ID</label>
                            <input name="analytics[gaId]" type="text" class="form-control" id="analyticsGaId" aria-describedby="analyticsGaIdHelp" placeholder="Enter media google analytics view id" value="{{ $medium->analytics['gaId'] ?? $medium->analytics['gaId'] }}">
                            <small id="analyticsGaIdHelp" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="analyticsYoutubeId">Youtube ID</label>
                            <input name="analytics[youtubeId]" type="text" class="form-control" id="analyticsYoutubeId" aria-describedby="analyticsYoutubeIdHelp" placeholder="Enter media youtube id" value="{{ $medium->analytics['youtubeId'] ?? $medium->analytics['youtubeId'] }}">
                            <small id="analyticsYoutubeIdHelp" class="form-text text-danger"></small>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="assets" role="tabpanel" aria-labelledby="assets-tab">
                        <div class="form-group">
                            <label for="assetsLogo">Logo</label>
                            <input type="file" name="assets[logo]" class="form-control-file fileinput-simple" aria-describedby="assetsLogoHelp" data-msg-placeholder="Chose media main logo" data-allowed-file-types="image">
                            <small id="assetsLogoHelp" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="assetsLogoAlt">Logo Alt</label>
                            <input type="file" name="assets[logoAlt]" class="form-control-file fileinput-simple" aria-describedby="assetsLogoAltHelp" data-msg-placeholder="Chose media logo alternate" data-allowed-file-types="image">
                            <small id="assetsLogoAltHelp" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="assetsIcon">Icon</label>
                            <input type="file" name="assets[icon]" class="form-control-file fileinput-simple" aria-describedby="assetsIconHelp" data-msg-placeholder="Chose media icon" data-allowed-file-types="image">
                            <small id="assetsIconHelp" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="assetsCss">Css</label>
                            <input type="file" name="assets[css]" class="form-control-file fileinput-simple" aria-describedby="assetsCssHelp" data-msg-placeholder="Chose media file css" data-allowed-file-extension="css" multiple>
                            <small id="assetsCssHelp" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="assetsJs">Js</label>
                            <input type="file" name="assets[js]" class="form-control-file fileinput-simple" aria-describedby="assetsJsHelp" data-msg-placeholder="Chose media file js" data-allowed-file-extension="js" multiple>
                            <small id="assetsJsHelp" class="form-text text-danger"></small>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
                        <div class="form-group">
                            <label for="socialFacebookPage">Facebook Page</label>
                            <input name="social[facebook][page]" type="text" class="form-control" id="socialFacebookPage" aria-describedby="socialFacebookPageHelp" placeholder="Enter facebook page" value="{{ $medium->social['facebook']['page'] ?? $medium->social['facebook']['page'] }}">
                            <small id="socialFacebookPageHelp" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="socialFacebookAppId">Facebook App ID</label>
                            <input name="social[facebook][appId]" type="text" class="form-control" id="socialFacebookAppId" aria-describedby="socialFacebookAppIdHelp" placeholder="Enter facebook application id" value="{{ $medium->social['facebook']['appId'] ?? $medium->social['facebook']['appId'] }}">
                            <small id="socialFacebookAppIdHelp" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="socialFacebookPageId">Facebook Page ID</label>
                            <input name="social[facebook][pageId]" type="text" class="form-control" id="socialFacebookPageId" aria-describedby="socialFacebookPageIdHelp" placeholder="Enter facebook page id" value="{{ $medium->social['facebook']['pageId'] ?? $medium->social['facebook']['pageId'] }}">
                            <small id="socialFacebookPageIdHelp" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="socialInstagram">Instagram Account</label>
                            <input name="social[instagram]" type="text" class="form-control" id="socialInstagram" aria-describedby="socialInstagramHelp" placeholder="Enter instagram account" value="{{ $medium->social['instagram'] ?? $medium->social['instagram'] }}">
                            <small id="socialInstagramHelp" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="socialTwitter">Twitter Page</label>
                            <input name="social[twitter]" type="text" class="form-control" id="socialTwitter" aria-describedby="socialTwitterHelp" placeholder="Enter twitter page" value="{{ $medium->social['twitter'] ?? $medium->social['twitter'] }}">
                            <small id="socialTwitterHelp" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="socialYoutube">Youtube Channel</label>
                            <input name="social[youtube]" type="text" class="form-control" id="socialYoutube" aria-describedby="socialYoutubeHelp" placeholder="Enter youtube channel" value="{{ $medium->social['youtube'] ?? $medium->social['youtube'] }}">
                            <small id="socialYoutubeHelp" class="form-text text-danger"></small>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="masthead" role="tabpanel" aria-labelledby="masthead-tab">
                        <div class="form-group">
                            <label for="mastheadAbout">About</label>
                            <textarea name="masthead[about]" class="summernote-simple" aria-describedby="mastheadAboutHelp" placeholder="Enter about media">{{ $medium->masthead['about'] ?? $medium->masthead['about'] }}</textarea>
                            <small id="mastheadAboutHelp" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="mastheadEditorial">Editorial</label>
                            <textarea name="masthead[editorial]" class="form-control summernote-simple" aria-describedby="mastheadEditorialHelp" placeholder="Enter media editorial">{{ $medium->masthead['editorial'] ?? $medium->masthead['editorial'] }}</textarea>
                            <small id="mastheadEditorialHelp" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="mastheadManagement">Management</label>
                            <textarea name="masthead[management]" class="form-control summernote-simple" aria-describedby="mastheadManagementHelp" placeholder="Enter media management">{{ $medium->masthead['management'] ?? $medium->masthead['management'] }}</textarea>
                            <small id="mastheadManagementHelp" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="mastheadContact">Contact</label>
                            <textarea name="masthead[contact]" class="form-control summernote-simple" aria-describedby="mastheadContactHelp" placeholder="Enter media contact">{{ $medium->masthead['contact'] ?? $medium->masthead['contact'] }}</textarea>
                            <small id="mastheadContactHelp" class="form-text text-danger"></small>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
                <button type="submit" class="btn btn-sm btn-icon icon-left btn-primary">
                    <i class="fas fa-check-circle"></i> Save Changes
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('jslib')
<script src="{{ mix('/js/colorpicker.js') }}"></script>
<script src="{{ mix('/js/select2.js') }}"></script>
<script src="{{ mix('/js/tagsinput.js') }}"></script>
<script src="{{ mix('/js/fileinput.js') }}"></script>
<script src="{{ mix('/js/fileinput-fa.js') }}"></script>
<script src="{{ mix('/js/summernote.js') }}"></script>
<script src="{{ mix('/js/summernote-fontawesome.js') }}"></script>
@endpush

@push('scripts')
<script>
    $(".colorpickerinput").colorpicker({
        format: 'hex',
        component: '.input-group-append',
    })

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