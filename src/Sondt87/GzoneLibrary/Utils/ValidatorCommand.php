<?php
/**
 * Created by PhpStorm.
 * User: mountain
 * Date: 5/8/14
 * Time: 4:18 PM
 */

namespace Sondt87\GzoneLibrary\Utils;


use Illuminate\Console\Command;
use Sondt87\GzoneLibrary\Utils\Validator\ValidatorGenerator;
use Symfony\Component\Console\Input\InputArgument;

class ValidatorCommand extends Command{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'util:make_validator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'util:make_validator name folder => [folder]/Validator/[name]Validator.php';


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
        $this->create($name,$folder);
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
            array('folder', InputArgument::REQUIRED, 'path to store validator'),
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

    private function create($name,$folder)
    {
        $path = $this->app['path'];
        $fileSystem = $this->app['files'];
        //gen views
        $generator = new ValidatorGenerator($path,$fileSystem);
        $generator->gen($name, $folder);
    }

} 