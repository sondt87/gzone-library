<?php
/**
 * Created by PhpStorm.
 * User: mountain
 * Date: 5/6/14
 * Time: 9:53 AM
 */

namespace Sondt87\GzoneLibrary\Utils\View;

use Sondt87\GzoneLibrary\Utils\AbsGenerator;

class ViewGenerator extends AbsGenerator{

    /**
     * @param $modelName
     * @param array $filesName : default array('all','create','edit','show')
     */
    public function gen($modelName, $filesName = array('all','create','edit','show'))
    {

        $directory = $this->appPath . "/views/" . strtolower($modelName);
        $this->makeDirectory($directory);

        foreach($filesName as $fileName ){
            $stub = $this->getStub('view_'.$fileName.'.stub');
            $stub = str_replace('{{name}}',$modelName,$stub);
            $filePath = $directory . "/" . $fileName . ".blade.php";
            $this->writeFile($stub,$filePath);
        }
    }


}