<div class="text-secondary breadcrumb pr-0">
    <div class="row w-100">
        <div class="col-md pl-2 pr-0">
            <a href="?path="><i class="fas fa-home mr-2 text-success"></i> System File Explorer</a>
            @foreach ($breadcrumbs as $link)
            <span class="text-primary mr-1 ml-1">/</span>{!! $link !!}
            @endforeach
            <span class="text-primary mr-1 ml-1">/</span>
            {{ $_GET['file'] ?? (isset($_GET['create_new_file']) ? $helper->t('create_new_file') :'All Files')}}
        </div>
        <div class="col-md-auto text-right p-0">
            <a class="text-primary mr-1 ml-1 text-right" href="?path={{ $_GET['path'] ?? ''}}&create_new_file=yes">
                <i class="fas fa-plus-circle mr-1"></i>{{$helper->t('create_new_file')}}</a>
        </div>
    </div>
</div>
