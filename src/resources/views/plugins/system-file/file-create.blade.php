<form method="POST" id="modify-file-form" action="../plugins">
    <div class="col-md-12 mt-5 mb-5">
        <input type="hidden" name="_method" value="POST" id="form-method">
        <input type="hidden" name="plugin_name" value="{{$plugin->param_name}}">
        <input type="hidden" name="path" value="{{$_GET['path']??''}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        Filename: <input type="text" name="filename" value="" id="filename" required>
    </div>
    <div class="col-md-auto text-center">
        <div id="ajax-results"></div>
        <button type="submit" class="btn btn-success m-3"><i class="fas fa-save mr-2"></i>Create the file </button>

        <a href="?path={{$_GET['path']??''}}" class="btn btn-secondary m-3"><i class="fas fa-list-alt mr-2"></i>Return
            to the folder</a>
    </div>
</form>

<div class="w-100 mb-2"></div>
