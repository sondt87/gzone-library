<?php
/**
 * Created by PhpStorm.
 * User: mountain
 * Date: 4/17/14
 * Time: 9:49 AM
 * use to generate base repository of application
 *  - IRepository
 *  - AbstractRepository
 */

namespace Sondt87\GzoneLibrary\Utils;

use \Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class RepositoryCommand extends Command{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'util:make_repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create repository';

    /**
     * the application
     *
     * @var application
     */
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

        $this->createController($name,$folder);

        $this->line("Created repository '".$name."'");
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array("name", InputArgument::REQUIRED, 'name of repository.'),
			array('folder', InputArgument::REQUIRED, 'repo folder.')
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
        $appPath = $this->app['path'];

        $generator = new RepositoryGenerator($appPath,$this->app['files']);
        $generator->gen($name, $folder);
    }

}