<div class="col-md-12">
    <table class="table table-striped table-hover" id="file-list-table">
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

    <div class="col-md text-right mb-3 folder-action">
        <a href="?delete_path={{$_GET['path']??''}}" class="btn btn-outline-info btn-sm btn-delete"><i
                class="far fa-trash-alt"></i><span></span></a>

    </div>
</div>

<script>
    var allow_delete_folder="{{$plugin_settings['allow_delete_folder'] ?? 'only_empty'}}";
    $(function(){
        $('.btn-delete').click(function(e){
            if ( $(this).hasClass('confirm-delete') ){
                if ( allow_delete_folder == 'no_sub_folder' && $("#file-list-table i.fa-folder").length > 0 ){
                    alert("Your delete folder setting ("+allow_delete_folder+") does not allow it to continue!");
                    e.preventDefault();
                    return false;
                }
                if ( allow_delete_folder == 'only_empty' && ( $("#file-list-table i.fa-folder").length > 0 || $("#file-list-table i.fa-file").length > 0 ) ){
                    alert("Your delete folder setting ("+allow_delete_folder+") does not allow it to continue!");
                    e.preventDefault();
                    return false;
                }
                return true;
            } else {
                e.preventDefault();
                $(this).find('span').addClass('ml-1').html('{{$helper->t('plugin-system-file.confirm_to_delete')}}');
                $(this).addClass('btn-outline-danger confirm-delete');
                return false;
            }
        });
    });
</script>
