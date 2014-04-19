<?php
/**
 * Created by PhpStorm.
 * User: mountain
 * Date: 4/19/14
 * Time: 1:55 PM
 */

namespace Sondt87\GzoneLibrary\Utils;


class InterfaceControllerGenerator extends AbsControllerGenerator
{

    public function gen($name)
    {
        //make folder
        $path = $this->appPath."/".$name;
        $this->makeDirectory($path);

        $stub = $this->files->get(__DIR__ . '/stubs/interface.stub');
        $stub = str_replace("{{folder}}", $name, $stub);
        $this->writeFileToFolder($stub, "Interface.php", $path);
    }
}