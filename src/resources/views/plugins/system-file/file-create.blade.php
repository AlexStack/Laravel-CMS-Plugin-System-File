<form method="POST" id="modify-file-form" action="../plugins">
    <div class="col-md-12 mt-5 mb-5">
        <input type="hidden" name="_method" value="POST" id="form-method">
        <input type="hidden" name="plugin_name" value="{{$plugin->param_name}}">
        <input type="hidden" name="path" value="{{$_GET['path']??''}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{-- Filename: <input type="text" name="filename" value="" id="filename" required> --}}


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

    </div>
    <div class="col-md-auto text-center mb-5">
        <div id="ajax-results"></div>
        {{-- <button type="submit" class="btn btn-success m-3"><i class="fas fa-save mr-2"></i>Create the file </button> --}}

        <a href="?path={{$_GET['path']??''}}" class="btn btn-secondary m-3"><i
                class="fas fa-list-alt mr-2"></i>{{$helper->t('plugin-system-file.return_to_the_folder')}}</a>
    </div>
</form>

<div class="w-100 mb-2"></div>
