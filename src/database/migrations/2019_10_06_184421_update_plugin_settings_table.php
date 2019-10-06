<?php

use AlexStack\LaravelCms\Models\LaravelCmsSetting;
use Illuminate\Database\Migrations\Migration;

class UpdatePluginSettingsTable extends Migration
{
    private $config;
    private $table_name;

    public function __construct()
    {
        $this->config     = include base_path('config/laravel-cms.php');
        $this->table_name = $this->config['table_name']['settings'];
    }

    /**
     * Run the migrations.
     */
    public function up()
    {
        $setting_data = [
            'category'        => 'plugin',
            'param_name'      => 'page-tab-system-file',
            'input_attribute' => '{"rows":10,"required":"required"}',
            'enabled'         => 1,
            'sort_value'      => 40,
            'abstract'        => 'Laravel system file explorer, can view & edit files online. <a href="https://www.laravelcms.tech" target="_blank"><i class="fas fa-link mr-1"></i>Tutorial</a>',
            'param_value'     => '{
"plugin_name" : "System File Explorer",
"blade_file" : "system-file",
"tab_name" : "<i class=\'fab fa-ubuntu mr-1\'></i>__(system,file)",
"php_class"  : "Amila\\\\LaravelCms\\\\Plugins\\\\SystemFile\\\\Controllers\\\\SystemFileController",
"number_per_page" : 40,
"plugin_type" : "standalone"
}',
        ];
        LaravelCmsSetting::UpdateOrCreate(
            ['category'=>'plugin', 'param_name' => 'system-file'],
            $setting_data
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        LaravelCmsSetting::where('param_name', 'page-tab-system-file')->where('category', 'plugin')->delete();
    }
}
