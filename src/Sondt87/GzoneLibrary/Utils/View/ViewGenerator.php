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
        $modelName = strtolower($modelName);
        $directory = $this->appPath . "/views/" . $modelName;
        $this->makeDirectory($directory);

        foreach($filesName as $fileName ){
            $filePath = $directory . "/" . $fileName . ".blade.php";
            $this->writeFile("",$filePath);
        }
    }


}