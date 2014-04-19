<?php
/**
 * Created by PhpStorm.
 * User: mountain
 * Date: 4/19/14
 * Time: 2:01 PM
 */

namespace Sondt87\GzoneLibrary\Utils;


class BaseControllerGenerator extends AbsControllerGenerator {
    public function gen($name, $hasContent = false, $usageRepository = ''){
        //make folder
        $path = $this->appPath."/".$name;
        $this->makeDirectory($path);

        $stub = $this->files->get(__DIR__.'/stubs/base_controller.stub');
        $stub = str_replace("{{folder}}",$name, $stub);
        if($hasContent){
            $contenStub = $this->getContentStub($name,'base_controller');
            $stub = str_replace("{{content}}",$contenStub, $stub);
        }else{
            $stub = str_replace("{{content}}",'', $stub);
        }

        $stub = str_replace("{{use_repository}}",$usageRepository, $stub);

        $this->writeFileToFolder($stub, "BaseController.php", $path);
    }
} 