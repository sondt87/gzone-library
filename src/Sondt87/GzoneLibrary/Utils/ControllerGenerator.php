<?php
/**
 * Created by PhpStorm.
 * User: mountain
 * Date: 4/7/14
 * Time: 2:42 PM
 */

namespace Sondt87\GzoneLibrary\Utils;


use Illuminate\Filesystem\Filesystem;

class ControllerGenerator {
    private $name;
    private $files;

    function __construct($name, Filesystem $files)
    {
        $this->name = ucfirst($name);
        $this->files = $files;
    }

    public function gen($path){
        //make folder
        $this->makeDirectory($this->name, $path);

        $path = $path."/".$this->name;

        $this->genInterface($path);
        $this->genBaseController($path);
        $this->genController($path, array("API","Backend","Frontend"));
    }


    protected function genInterface($path){
        $stub = $this->files->get(__DIR__.'/stubs/interface.stub');
        $stub = str_replace("{{folder}}",$this->name, $stub);
        $this->writeFile($stub, "Interface", $path);
    }

    protected function genBaseController($path){
        $stub = $this->files->get(__DIR__.'/stubs/base_controller.stub');
        $stub = str_replace("{{folder}}",$this->name, $stub);
        $this->writeFile($stub, "BaseController", $path);
    }

    protected function genController($path,$types ){
        foreach($types as $type){
            $stub = $this->files->get(__DIR__.'/stubs/controller.stub');
            $stub = str_replace("{{folder}}",$this->name, $stub);
            $stub = str_replace("{{type}}",$type, $stub);
            $this->writeFile($stub, $type."Controller", $path);
        }
    }
    /**
     * Create the directory for the controller.
     *
     * @param  string  $controller
     * @param  string  $path
     * @return void
     */
    protected function makeDirectory($controller, $path)
    {
        if ( ! $this->files->isDirectory($full = $path.'/'.$controller))
        {
            $this->files->makeDirectory($full, 0777, true);
        }
    }

    /**
     * Write the completed stub to disk.
     *
     * @param  string  $stub
     * @param  string  $fileName
     * @param  string  $path
     * @return void
     */
    protected function writeFile($stub, $fileName, $path)
    {
        if ( ! $this->files->exists($fullPath = $path."/{$fileName}.php"))
        {
            return $this->files->put($fullPath, $stub);
        }
    }
} 