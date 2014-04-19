<?php
/**
 * Created by PhpStorm.
 * User: mountain
 * Date: 4/19/14
 * Time: 1:59 PM
 */

namespace Sondt87\GzoneLibrary\Utils;


use Illuminate\Filesystem\Filesystem;

class AbsControllerGenerator extends AbsGenerator {

    function __construct($appPath,Filesystem $fileSystem)
    {
        parent::__construct($appPath.'/controllers',$fileSystem);
    }

    /**
     * @param $name
     * @param $type: base_controller | controller
     * @return mixed|string
     */
    protected function getContentStub($name,$type){
        $stub = $this->files->get(__DIR__.'/stubs/'.$type.'_content.stub');
        $stub = str_replace("{{folder}}",$name, $stub);
        return $stub;
    }
}