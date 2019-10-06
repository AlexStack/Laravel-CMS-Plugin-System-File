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

    public function show()
    {
        return 'sss show SystemFileController, test standalone plugin';
    }

    public function edit($id, $page)
    {
        // uncomment exit() line to make sure your plugin method invoked
        // please check the php_class value if not invoked

        //exit('Looks good, the plugin\'s edit() method invoked. id='.$id.' <hr> FILE='.__FILE__.' <hr> PAGE TITLE='.$page->title);

        return $id;
    }

    // public function store($form_data, $page, $plugin_settings)
    // {
    //     return $this->update($form_data, $page, $plugin_settings);
    // }

    public function update($form_data, $page, $plugin_settings)
    {
        //$this->helper->debug($form_data);
    }

    // public function destroy(Request $request, $id)
    // {
    //     //
    // }

    /*
     * Other methods.
     */
}
