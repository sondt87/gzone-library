<?php
/**
 * Created by PhpStorm.
 * User: mountain
 * Date: 4/17/14
 * Time: 11:03 AM
 */

namespace Sondt87\GzoneLibrary\Utils;

use Illuminate\Filesystem\Filesystem;

class MakeModelGenerator
{

    private $appPath;
    private $files;

    function __construct($appPath, Filesystem $files)
    {
        $this->files = $files;
        $this->appPath = $appPath;
    }

    public function gen($name, $table)
    {
        if(!isset($table) || $table == '')
            $table = strtolower($name);

        $name = str_replace('_','',$name);

        //gen Repository interface
        $path = $this->appPath . '/models/' . $name . '.php';

        $stub = $this->files->get(__DIR__ . '/stubs/Model.stub');

        $stub = str_replace("{{name}}", $name, $stub);
        $stub = str_replace("{{table}}", $table, $stub);

        $this->writeFile($stub, $path);
    }


    protected function writeFile($stub, $path)
    {
        if (!$this->files->exists($path)) {
            return $this->files->put($path, $stub);
        }
    }

    /**
     * Create the directory for the controller.
     *
     * @param  string $controller
     * @param  string $path
     * @return void
     */
    protected function makeDirectory($path)
    {
        if (!$this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true);
        }
    }

} 