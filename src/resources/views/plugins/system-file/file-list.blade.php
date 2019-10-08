<div class="col-md">
    <table class="table table-striped table-hover">
        <tbody>
            @forelse ($files as $filename => $f)
            <tr>
                <td class="filename">
                    @if ( $f['is_dir'])
                    <a href="?path={{$f['path']}}">
                        <i class="fas fa-folder text-warning mr-2"></i>
                        {{$filename}}
                    </a>
                    @else
                    <a href="?path={{ $_GET['path'] ?? ''}}&file={{$filename}}">
                        <i class="far fa-file mr-2"></i>
                        {{$filename}}</a>
                    @endif
                </td>
                <td class="text-right size">
                    {{$f['is_dir'] ? '-' : $f['size_str']}}
                    <span class="ml-3 d-none d-md-inline-block mtime">
                        {{date("Y-m-d H:i:s",$f['mtime']) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td>
                    <div class="text-info text-center">{{$helper->t('no_results')}}</div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
