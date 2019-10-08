<div class="text-secondary breadcrumb pr-0">
    <div class="row w-100">
        <div class="col-md pl-2 pr-0 text-truncate">
            <a href="?home"><i
                    class="fas fa-home mr-2 text-success"></i>{{ $helper->t('plugin-system-file.system_file_explorer') }}</a>
            @foreach ($breadcrumbs as $link)
            <span class="text-primary mr-1 ml-1">/</span>{!! $link !!}
            @endforeach
            <span class="text-primary mr-1 ml-1">/</span>
            {{ $_GET['file'] ?? (isset($_GET['create_new_file']) ? $helper->t('plugin-system-file.create_new_file') : $helper->t('plugin-system-file.all_files') )}}
        </div>
        <div class="col-md-auto text-right p-0">

            <a class="text-primary mr-1 ml-1" href="?path={{ $_GET['path'] ?? ''}}&create_new_file=yes">
                <i class="fas fa-plus-circle mr-1"></i>{{$helper->t('plugin-system-file.create_new_file')}}</a>

            <a class="text-info  mr-1 ml-1" href="?show_file_history=yes">
                <i class="fas fa-hospital-symbol mr-1"></i>{{$helper->t('plugin-system-file.file_history')}}</a>

        </div>
    </div>
</div>
