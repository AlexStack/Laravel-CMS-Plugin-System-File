<?php

namespace Amila\LaravelCms\Plugins\SystemFile\Controllers;

use AlexStack\LaravelCms\Helpers\LaravelCmsHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SystemFileController extends Controller
{
    private $user = null;
    private $helper;

    public function __construct()
    {
        $this->helper = new LaravelCmsHelper();
    }

    public function checkUser()
    {
        if (! $this->user) {
            $this->user = $this->helper->hasPermission();
        }
    }

    public function show($form_data, $plugin, $plugin_settings)
    {
        $this->checkUser();
        $base_path = base_path();
        if (isset($form_data['path']) && '' != trim($form_data['path'])) {
            $real_path       = $base_path.'/'.trim($form_data['path']);
            $crumbs          = explode('/', trim($form_data['path']));
            $crumb_links     = [];
            $temp_path_str   = '';
            foreach ($crumbs as $crumb) {
                $temp_path_str = ('' == $temp_path_str) ? $crumb : $temp_path_str.'/'.$crumb;
                $crumb_links[] = '<a href="?path='.$temp_path_str.'">'.$crumb.'</a>';
            }

            if (! isset($form_data['file'])) {
                $crumb_links[count($crumbs) - 1] = '<span class="current">'.$crumb.'</span>';
            }
            $data['breadcrumbs'] = $crumb_links;

        // $this->helper->debug($crumb_links);
        } else {
            $real_path           = $base_path;
            $data['breadcrumbs'] = [];
        }
        $data['files'] = [];
        foreach (glob($real_path.'/*') as $file) {
            $pathinfo = pathinfo($file);
            $fn       = $pathinfo['basename'];

            $data['files'][$fn]             = lstat($file);
            $data['files'][$fn]['is_dir']   = is_dir($file);
            $data['files'][$fn]['path']     = str_replace($base_path.'/', '', $file);
            $data['files'][$fn]['suffix']   = $pathinfo['extension'] ?? '';
            $data['files'][$fn]['size_str'] = $this->humanFilesize($data['files'][$fn]['size']);
        }
        // $this->helper->debug($data);

        $data['plugin_settings'] = $plugin_settings;
        $data['plugin']          = $plugin;
        $data['helper']          = $this->helper;

        // edit a file
        if (isset($form_data['file']) && '' != trim($form_data['file'])) {
            $real_file_path = isset($form_data['path']) ? base_path($form_data['path'].'/'.$form_data['file']) : base_path($form_data['file']);
            if (! file_exists($real_file_path)) {
                exit($form_data['file'].' not exists!');
            }
            $mime_type = mime_content_type($real_file_path);
            if (false !== strpos($mime_type, 'text') || false !== strpos($mime_type, 'xml') || false !== strpos($mime_type, 'json') || false !== strpos($mime_type, 'svg') || false !== strpos($mime_type, 'javascript') || false !== strpos($mime_type, 'empty')) {
                $data['file_content'] = file_get_contents($real_file_path);
            } else {
                $data['file_content'] = false;
                if (false !== strpos($mime_type, 'image')) {
                    $data['image_preview_str'] =  '<img src="data: '.$mime_type.';base64,'.base64_encode(file_get_contents($real_file_path)).'" class="img-fluid">';
                }
            }
        } else {
            $data['file_content'] = 'no file';
            //$this->helper->debug($form_data);
        }

        return view($this->helper->bladePath('system-file.file-layout', 'plugins'), $data);
    }

    // public function create($form_data, $plugin, $plugin_settings)
    // {
    // }

    public function store($form_data, $plugin, $plugin_settings)
    {
        $real_file_path = isset($form_data['path']) ? base_path($form_data['path'].'/'.$form_data['filename']) : base_path($form_data['filename']);

        if (file_exists($real_file_path)) {
            echo '<script>alert("This file already exists!");history.back();</script>';
            exit();
        }

        $rs = file_put_contents($real_file_path, "\n\n\n\n\n\n\n\n");

        return redirect()->route('LaravelCmsAdminPlugins.show', ['plugin'=> $plugin->param_name, 'path'=>$form_data['path'], 'file'=>$form_data['filename']]);
    }

    public function edit($id, $plugin)
    {
        // uncomment exit() line to make sure your plugin method invoked
        // please check the php_class value if not invoked

        //exit('Looks good, the plugin\'s edit() method invoked. id='.$id.' <hr> FILE='.__FILE__.' <hr> PAGE TITLE='.$page->title);

        return $id;
    }

    public function update($form_data, $plugin, $plugin_settings)
    {
        // $this->helper->debug($form_data);

        $real_file_path = isset($form_data['path']) ? base_path($form_data['path'].'/'.$form_data['file']) : base_path($form_data['file']);

        $this->backupFile($real_file_path);

        $rs = file_put_contents($real_file_path, $form_data['file_content']);

        if ('json' == request()->response_type) {
            $result['success']         = false !== $rs;
            $result['success_content'] = 'File '.$form_data['file'].' modified';
            $result['error_message']   = 'Modify the file  '.$form_data['file'].' failed!';

            return response()->json($result);
        }

        return $rs;
    }

    public function destroy($form_data, $plugin, $plugin_settings)
    {
        $real_file_path = isset($form_data['path']) ? base_path($form_data['path'].'/'.$form_data['file']) : base_path($form_data['file']);

        $this->backupFile($real_file_path, 'delete');

        $rs = unlink($real_file_path);

        if ('json' == request()->response_type) {
            $result['success']         = false !== $rs;
            $result['success_content'] = 'File '.$form_data['file'].' deleted';
            $result['error_message']   = 'Delete the file  '.$form_data['file'].' failed!';

            return response()->json($result);
        }

        return $rs;
    }

    /*
     * Other methods.
     */

    public function humanFilesize($size, $precision = 2)
    {
        static $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        $step         = 1024;
        $i            = 0;
        while (($size / $step) > 0.9) {
            $size = $size / $step;
            ++$i;
        }

        return round($size, $precision).' '.$units[$i];
    }

    public function backupFile($real_file_path, $action='edit')
    {
        $file_backup_dir  = storage_path('app/laravel-cms/backups/system-files/'.date('Y-m'));
        if (! file_exists($file_backup_dir)) {
            mkdir($file_backup_dir, 0755, true);
        }
        $new_name = basename($real_file_path).'-'.$action.'-'.date('Y-m-d-His');

        return copy($real_file_path, $file_backup_dir.'/'.$new_name);
    }
}
