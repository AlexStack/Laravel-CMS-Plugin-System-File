<form method="POST" id="modify-file-form" class="w-100">
    <div class="col-md-12">
        <input type="hidden" name="_method" value="PUT" id="form-method">
        <textarea class="form-control" rows="10" id="file_content"
            name="file_content">{{$file_content ?? 'file can not preview & edit online'}}</textarea>
    </div>
    <div class="col-md-auto text-center">
        <div id="ajax-results"></div>
        <button type="submit" class="btn btn-success m-3"><i
                class="fas fa-save mr-2"></i>{{$helper->t('plugin-system-file.modify_the_file')}}</button>

        <a href="?path={{$_GET['path']??''}}" class="btn btn-secondary m-3"><i
                class="fas fa-list-alt mr-2"></i>{{$helper->t('plugin-system-file.return_to_the_folder')}}</a>

        <button type="submit" class="btn btn-outline-info m-3 btn-delete"><i
                class="far fa-trash-alt"></i><span></span></button>
    </div>
</form>

<div class="w-100 mb-2"></div>

@if( isset($file_history) && ! empty($file_history) )
<ul class="list-group mb-5 file-history">
    <li class="list-group-item list-group-item-dark"><i
            class="fas fa-clinic-medical mr-1"></i>{{$helper->t('plugin-system-file.file_history')}}</li>
    @foreach($file_history as $file=>$folder)
    <li class="list-group-item list-group-item-action"><a
            href="?path=storage/app/laravel-cms/backups/system-files/{{$folder}}&file={{$file}}"
            target="_blank">{{$file}}</a></li>
    @endforeach
</ul>
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/codemirror.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/codemirror.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/mode/javascript/javascript.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/js-beautify/1.10.2/beautify.min.js"></script>

<style>
    .CodeMirror {
        border: 1px solid #eee;
        height: auto;
    }
</style>


<script>
    function handelAction(form){
        // if ( !confirm("{{$helper->t('delete_message')}}") ) {
        //     return false;
        // }

        $.ajax({
            url : location.href,
            type: $('#form-method').val(),
            data : {
                _token: "{{ csrf_token() }}",
                response_type: "json",
                file_content: $('#file_content').val()
            },
            dataType: 'json',
            cache: false,
            success: function (rs) {
                console.log('laravel-cms-system-file Submission was successful.');
                console.log(rs);
                if ( rs.success ){
                    $('#ajax-results').hide().html(rs.success_content).addClass('mt-2 alert alert-success').fadeIn('slow').delay(4000).fadeOut('slow');
                    if ( $('#form-method').val() == 'DELETE'){
                        setTimeout(function(){
                            window.location.href = '?path={{$_GET['path']??''}}';
                        }, 3000);
                    }
                } else {
                    //alert('Error: ' + rs.error_message);
                    $('#ajax-results').hide().html(rs.error_message).addClass('mt-2 alert alert-danger').fadeIn('slow').delay(4000).fadeOut('slow');
                }
            },
            error: function (rs) {
                //console.log('laravel-cms-system-file : An error occurred.');
                console.log(rs);
                $('#ajax-results').hide().html('An error occurred.').addClass('mt-2alert alert-danger').fadeIn('slow').delay(8000).fadeOut('slow');
            },
        }).done(function(rs){
            // console.log('laravel-cms-inquiry-delete submitted');
            // console.log(rs);
        });

        return false;
    }


    $(function(){
        var CodeMirrorEditor = CodeMirror.fromTextArea(document.getElementById("file_content"), {
            lineNumbers: true,
            //readOnly：false,
            styleActiveLine: true,
            mode: 'application/json',
            matchBrackets: true,
            lineWrapping: true,
            htmlMode: true,
        });

        $('#modify-file-form').submit(function(e){
            e.preventDefault();
            var form = $(this);
            var text = CodeMirrorEditor.getValue();
            return handelAction(form, 'edit');
        });

        $('.btn-delete').click(function(e){
            if ( $(this).hasClass('confirm-delete') ){
                $('#form-method').val('DELETE');
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
