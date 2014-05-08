<?php
/**
 * Created by PhpStorm.
 * User: mountain
 * Date: 4/17/14
 * Time: 11:03 AM
 */

namespace Sondt87\GzoneLibrary\Utils;

use Illuminate\Filesystem\Filesystem;

class RepositoryGenerator extends AbsGenerator
{

    public function gen($name, $folder)
    {
        $folder .= '/Repo';
        $this->genBaseRepository($folder);
        $interfaceUsage = $this->genRepository($folder, $name);
        $this->genEloquentRepository($folder, $name);

        return $interfaceUsage;
    }

    private function genBaseRepository($folder)
    {
        $path = $this->appPath . '/' . $folder ;
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

    public function genRepositoryFile($source,$dist, $replacements = array()){
        if (!$this->files->exists($dist)) {
            $stub = $this->files->get($source);

            foreach($replacements as $key => $value){
                $stub = str_replace($key, $value, $stub);
            }

            $this->writeFile($stub, $dist);
        }
    }

    /**
     * Gen interface repository of $name
     * @param $folder
     * @param $name
     * @return string : namespace of interface.
     */
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

        return $folder.'/'.$name."/".$name."Repository";
    }

    /**
     * Gen class repository of $name
     * @param $folder
     * @param $name
     * @return string : namespace of class.
     */
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

        return $folder.'/'.$name;

    }

} 