<?php
/**
 * Created by PhpStorm.
 * User: mountain
 * Date: 4/17/14
 * Time: 11:03 AM
 */

namespace Sondt87\GzoneLibrary\Utils;

use Illuminate\Filesystem\Filesystem;

class RepositoryGenerator
{
    private $name;
    private $appPath;
    private $files;

    function __construct($appPath, Filesystem $files)
    {
        $this->files = $files;
        $this->appPath = $appPath;
    }

    public function gen($name, $folder)
    {
        $this->name = ucfirst($name);
        $this->genBaseRepository($folder);
        $this->genRepository($folder, $name);
        $this->genEloquentRepository($folder, $name);
    }

    private function genBaseRepository($folder)
    {
        $path = $this->appPath . '/' . $folder;
        $this->makeDirectory($path);

        //gen interface
        if (!$this->files->exists($path = $this->appPath . '/' . $folder . '/IRepository.php')) {
            $stub = $this->files->get(__DIR__ . '/stubs/IRepository.stub');
            $nameSpace = str_replace("/", "\\", $folder);
            $stub = str_replace("{{folder}}", $nameSpace, $stub);
            $this->writeFile($stub, $path);
        }

        //gen abstract class
        if (!$this->files->exists($path = $this->appPath . '/' . $folder . '/AbstractRepository.php')) {
            $stub = $this->files->get(__DIR__ . '/stubs/AbstractRepository.stub');
            $nameSpace = str_replace("/", "\\", $folder);
            $stub = str_replace("{{folder}}", $nameSpace, $stub);
            $this->writeFile($stub, $path);
        }


    }

    private function genRepository($folder, $name)
    {
        //gen Repository interface
        $path = $this->appPath . '/' . $folder . '/' . $name;
        $this->makeDirectory($path);

        $path = $path . '/' . $name . 'Repository.php';

        $stub = $this->files->get(__DIR__ . '/stubs/Repository.stub');
        $nameSpace = str_replace("/", "\\", $folder);
        $stub = str_replace("{{folder}}", $nameSpace, $stub);
        $stub = str_replace("{{name}}", $name, $stub);
        $this->writeFile($stub, $path);
    }

    private function genEloquentRepository($folder, $name)
    {
        $path = $this->appPath . '/' . $folder . '/' . $name;
        $this->makeDirectory($path);
        $path = $path . '/Eloquent' . $name . 'Repository.php';

        //gen Repository interface
        $stub = $this->files->get(__DIR__ . '/stubs/EloquentRepository.stub');
        $nameSpace = str_replace("/", "\\", $folder);
        $stub = str_replace("{{folder}}", $nameSpace, $stub);
        $stub = str_replace("{{name}}", $name, $stub);
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