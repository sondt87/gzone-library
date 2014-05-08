<?php
/**
 * Created by PhpStorm.
 * User: mountain
 * Date: 4/19/14
 * Time: 1:50 PM
 */

namespace Sondt87\GzoneLibrary\Utils;

use Illuminate\Filesystem\Filesystem;

abstract class AbsGenerator {

    protected $files;
    protected $appPath;

    public function __construct($appPath, Filesystem $files)
    {
        $this->files = $files;
        $this->appPath = $appPath;
    }

    /**
     * Get stub content from stub file.
     *
     * @param $name
     * @return string empty if file is not exist
     */
    public function getStub($name){

        $path = __DIR__ . '/stubs/' . $name;
        if(!$this->files->exists($path)) return "";
        $stub = $this->files->get($path);
        return $stub;
    }
    /**
     * Create the directory for the controller.
     *
     * @param  string  $controller
     * @param  string  $path
     * @return void
     */
    protected function makeDirectory($path)
    {
        if ( ! $this->files->isDirectory($path))
        {
            $this->files->makeDirectory($path, 0777, true);
        }
    }

    /**
     * Write the completed stub to disk.
     *
     * @param  string  $stub
     * @param  string  $fileName
     * @param  string  $folder
     * @return void
     */
    protected function writeFileToFolder($stub, $fileName, $folder)
    {
        if ( ! $this->files->exists($fullPath = $folder."/{$fileName}"))
        {
            return $this->files->put($fullPath, $stub);
        }
    }
    /**
     * Write the completed stub to disk.
     *
     * @param  string  $stub
     * @param  string  $path of file
     * @return void
     */
    protected function writeFile($stub, $path)
    {
        if ( ! $this->files->exists($path))
        {
            return $this->files->put($path, $stub);
        }
    }


} 