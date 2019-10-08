<div class="col-md">
    <table class="table table-striped table-hover">
        <tbody>
            @forelse ($file_history as $filename => $date_str)
            <tr>
                <td class="filename">
                    @if ( strpos($date_str,'Deleted') === false )
                    <a href="?fullpath={{$filename}}">
                        <i class="far fa-file mr-2"></i>{{$filename}}</a>
                    @else
                    <del class="text-info"><i class="far fa-file mr-2"></i>{{$filename}}</del>
                    @endif

                </td>
                <td class="text-right size">
                    <span class="ml-3 d-none d-md-inline-block mtime">
                        {{ $date_str }}
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
