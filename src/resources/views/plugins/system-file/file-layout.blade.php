@extends($helper->bladePath('includes.layout','b'))

@section('content')

<link href="{{$helper->assetUrl('../plugins/system-file/css/main.css') }}" rel="stylesheet">

<div class="container plugin-system-file">
    <div class="row justify-content-center mt-2">
        <div class="col-md-12">
            @include($helper->bladePath('system-file.file-crumb','plugins'))
        </div>

        @if ( isset($_GET['file']) && $file_content !== false )

        @include($helper->bladePath('system-file.file-edit','plugins'))

        @elseif ( isset($_GET['file']) && $file_content === false )

        <div class="col-md-12 text-center text-info">{{$helper->t('plugin-system-file.file_can_not_edit')}}</div>
        @if( isset($image_preview_str) )
        <div class="col-md-12 text-center m-2 img-preview">{!! $image_preview_str !!}</div>
        @endif

        @elseif ( isset($_GET['create_new_file']))

        @include($helper->bladePath('system-file.file-create','plugins'))

        @elseif ( isset($_GET['show_file_history']))

        @include($helper->bladePath('system-file.file-history','plugins'))

        @else

        @include($helper->bladePath('system-file.file-list','plugins'))

        @endif

        <div class="col-md-12 mt-2 text-secondary shortcuts">
            <img src="/laravel-cms/plugins/system-file/images/favicon-32x32.png" width="16"
                class="align-top shortcut-logo" />
            {{$helper->t('plugin-system-file.cms_shortcuts')}} :
            <a href="?path=resources/views/vendor/laravel-cms" class="btn btn-outline-secondary btn-sm">Templates</a>
            <a href="?path=public/laravel-cms" class="btn btn-outline-secondary btn-sm">Assets</a>
            <a href="?path=app/LaravelCms" class="btn btn-outline-secondary btn-sm">Plugin Controllers</a>

            <a href="?path=resources/lang/vendor/laravel-cms" class="btn btn-outline-secondary btn-sm">Lang</a>

            <a href="?path=storage/app/laravel-cms/backups" class="btn btn-outline-secondary btn-sm">Backups</a>

        </div>
    </div>
</div>

@endsection
