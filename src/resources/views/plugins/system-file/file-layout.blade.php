@extends($helper->bladePath('includes.layout','b'))

@inject('str', 'Illuminate\Support\Str')

@section('content')

<div class="container">
    <div class="row justify-content-center mt-2">
        <div class="col-md">
            <div class="text-secondary breadcrumb">
                <a href="?path="><i class="fas fa-home mr-2 text-success"></i> System File Explorer</a>
                @foreach ($breadcrumbs as $link)
                <span class="text-primary mr-1 ml-1">/</span>{!! $link !!}
                @endforeach
                <span class="text-primary mr-1 ml-1">/</span> {{ $_GET['file'] ?? 'All Files'}}
            </div>
        </div>
        <div class="w-100 "></div>

        @if ( isset($_GET['file']) && $file_content !== false )

        @include($helper->bladePath('system-file.file-edit','plugins'))

        @elseif ( isset($_GET['file']) && $file_content === false )

        <div class="col-md-12 text-center text-info">This file can not edit online</div>
        @if( isset($image_preview_str) )
        <div class="col-md-12 text-center m-2 img-preview">{!! $image_preview_str !!}</div>
        @endif

        @elseif ( isset($_GET['create_new_file']))

        @include($helper->bladePath('system-file.file-create','plugins'))

        @else

        @include($helper->bladePath('system-file.file-list','plugins'))

        @endif

    </div>
</div>

@endsection
