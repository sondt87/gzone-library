<?php
/**
 * Created by PhpStorm.
 * User: mountain
 * Date: 4/17/14
 * Time: 11:03 AM
 */

namespace Sondt87\GzoneLibrary\Utils;

class MakeModelGenerator extends AbsGenerator
{

    public function gen($name, $table = '')
    {
        list($path, $stub) = $this->genBaseFile($name, $table);

        $this->writeFile($stub, $path);
    }


    /**
     * @param $name
     * @param $table
     * @return array
     */
    public function genBaseFile($name, $table)
    {
        if (!isset($table) || $table == '')
            $table = strtolower($name);

        $name = str_replace('_', '', $name);

        //gen Repository interface
        $path = $this->appPath . '/models/' . $name . '.php';

        $stub = $this->files->get(__DIR__ . '/stubs/Model.stub');

        $stub = str_replace("{{name}}", $name, $stub);
        $stub = str_replace("{{table}}", $table, $stub);
        return array($path, $stub);
    }


} 