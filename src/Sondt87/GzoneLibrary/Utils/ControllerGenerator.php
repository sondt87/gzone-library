<?php
/**
 * Created by PhpStorm.
 * User: mountain
 * Date: 4/7/14
 * Time: 2:42 PM
 */

namespace Sondt87\GzoneLibrary\Utils;


use Illuminate\Filesystem\Filesystem;

class ControllerGenerator extends AbsControllerGenerator{

    /**
     * @param $name
     * @param $type : API | Frontend | Backend
     * @param $hasContent
     * @param $usageRepository: use ProjectName\Repo\NameOfRepository
     * @return void
     */
    public function gen($name, $type, $hasContent = false, $usageRepository = ''){
        //make folder
        $path = $this->appPath."/".$name;
        $this->makeDirectory($path);

        $stub = $this->files->get(__DIR__.'/stubs/controller.stub');
        $stub = str_replace("{{folder}}",$name, $stub);
        $stub = str_replace("{{type}}",$type, $stub);

        if($hasContent){
            $contenStub = $this->getContentStub($name,'controller');
            $stub = str_replace("{{content}}",$contenStub, $stub);
        }else{
            $stub = str_replace("{{content}}",'', $stub);
        }

        $stub = str_replace("{{use_repository}}",$usageRepository, $stub);

        $this->writeFileToFolder($stub, $type."Controller.php", $path);
    }

} 