<?php
/**
 * Created by PhpStorm.
 * User: mountain
 * Date: 5/8/14
 * Time: 4:09 PM
 */

namespace Sondt87\GzoneLibrary\Utils\Validator;


use Sondt87\GzoneLibrary\Utils\AbsGenerator;

class ValidatorGenerator extends AbsGenerator{
    public function gen($name, $folder){
        $folder = $folder . '/Validator';

        $this->genAbsValidator($folder);
        $this->genValidator($name,$folder);
    }

    public function genAbsValidator($folder){

        $path = $this->appPath .'/'. $folder ;
        $this->makeDirectory($path);

        $stub = $this->getStub('validator_abs.stub');
        $folder = str_replace('/','\\',$folder);
        $stub = str_replace('{{folder}}',$folder,$stub);

        $this->writeFileToFolder($stub,'AbsValidator.php',$path);
    }

    public function genValidator($name,$folder){
        $path = $this->appPath .'/'. $folder;

        $folder = str_replace('/','\\',$folder);
        $stub = $this->getStub('validator.stub');
        $stub = str_replace('{{folder}}',$folder,$stub);
        $stub = str_replace('{{name}}',$name,$stub);

        $this->writeFileToFolder($stub,$name.'Validator.php',$path);
    }
} 