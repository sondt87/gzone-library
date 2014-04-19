<?php
/**
 * Created by PhpStorm.
 * User: mountain
 * Date: 4/18/14
 * Time: 4:49 PM
 */

namespace Sondt87\GzoneLibrary\Utils;


use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class MakeModelCommand extends Command{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'util:make_model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create model into folder models from model template';


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
        $table = $this->argument("table");
        $this->line("Created model: '".$name."'");
        $this->createController($name,$table);
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
            array('table', InputArgument::OPTIONAL, 'name of table of model.'),
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

    private function createController($name,$table)
    {
        $path = $this->app['path'];

        $generator = new MakeModelGenerator($path,$this->app['files']);
        $generator->gen($name,$table);
    }
} 