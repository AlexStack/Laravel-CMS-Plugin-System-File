<div class="col-md-auto mt-5 mb-5">
    <form method="POST" id="modify-file-form" action="../plugins">
        <input type="hidden" name="_method" value="POST" id="form-method">
        <input type="hidden" name="plugin_name" value="{{$plugin->param_name}}">
        <input type="hidden" name="path" value="{{$_GET['path']??''}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-file"></i></span>
            </div>
            <div class="custom-file">
                <input type="text" class="form-control" placeholder="Filename" aria-label="filename" required="required"
                    pattern="[^\\/:\x22*?<>|]+" aria-describedby="basic-addon2" name="filename" id="filename" />
            </div>
            <div class="input-group-append">
                <button class="btn btn-success" type="submit"
                    id="inputGroupFileAddon05">{{$helper->t('plugin-system-file.create_new_file')}}</button>
            </div>
        </div>
    </form>
</div>

{{-- <div class="w-100"></div> --}}

{{-- create new folder --}}
<div class="col-md-auto mt-5 mb-5">
    <form method="POST" id="modify-file-form" action="../plugins">
        <input type="hidden" name="_method" value="POST" id="form-method">
        <input type="hidden" name="plugin_name" value="{{$plugin->param_name}}">
        <input type="hidden" name="path" value="{{$_GET['path']??''}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="is_dir" value="dir">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-folder"></i></span>
            </div>
            <div class="custom-file">
                <input type="text" class="form-control" placeholder="Foldername" aria-label="filename"
                    required="required" pattern="[^\\/:\x22*?<>|]+" aria-describedby="basic-addon2" name="filename"
                    id="folder" />
            </div>
            <div class="input-group-append">
                <button class="btn btn-warning" type="submit"
                    id="inputGroupFileAddon06">{{$helper->t('plugin-system-file.create_new_folder')}}</button>
            </div>
        </div>
    </form>
</div>

<div class="w-100"></div>

<div class="col-md-auto text-center mb-5">
    <div id="ajax-results"></div>
    <a href="?path={{$_GET['path']??''}}" class="btn btn-secondary m-3"><i
            class="fas fa-list-alt mr-2"></i>{{$helper->t('plugin-system-file.return_to_the_folder')}}</a>
</div>


<div class="w-100 mb-2"></div>
