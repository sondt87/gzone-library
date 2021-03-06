<?php
/**
 * Created by PhpStorm.
 * User: mountain
 * Date: 4/18/14
 * Time: 4:49 PM
 */

namespace Sondt87\GzoneLibrary\Utils;


use Illuminate\Console\Command;
use Sondt87\GzoneLibrary\Utils\Validator\ValidatorGenerator;
use Sondt87\GzoneLibrary\Utils\View\ViewGenerator;
use Symfony\Component\Console\Input\InputArgument;

class MakeAllCommand extends Command{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'util:make_all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '{util:make_all ModelName folder} => [folder]/Repo, [folder]/Validator generated automatically model, repository, controllers, views';

    protected $app;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($app)
    {
        parent::__construct();
        $this->app = $app;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $name = $this->argument("name");
        $folder = $this->argument("folder");
        $this->line("Created successfully");
        $this->createController($name,$folder);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('name', InputArgument::REQUIRED, 'name of model.'),
            array('folder', InputArgument::REQUIRED, 'path to store repository, validator'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
        );
    }

    private function createController($name,$folder)
    {
        $path = $this->app['path'];
        $fileSystem = $this->app['files'];

        $generator = new MakeModelGenerator($path,$fileSystem);
        $generator->gen($name);

        $generator = new RepositoryGenerator($path,$fileSystem);
        $repoUsage = $generator->gen($name, $folder);
        $repoUsage = str_replace("/","\\",$repoUsage);
        $repoUsage = "use ".$repoUsage. ";";

        //gen controller

        //gen interface
        $generator = new InterfaceControllerGenerator($path,$fileSystem);
        $generator->gen($name);

        //base controller
        $generator = new BaseControllerGenerator($path,$fileSystem);
        $generator->gen($name,true,$repoUsage);

        //controller type
        $generator = new ControllerGenerator($path,$fileSystem);

        $generator->gen($name,'API', false);
        $generator->gen($name,'Frontend', true, $folder);
        $generator->gen($name,'Backend', true, $folder);

        //gen views
        $generator = new ViewGenerator($path,$fileSystem);
        $generator->gen($name);

        //gen validator
        $generator = new ValidatorGenerator($path,$fileSystem);
        $generator->gen($name,$folder);

    }
}
