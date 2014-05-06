<?php
/**
 * Created by PhpStorm.
 * User: mountain
 * Date: 5/6/14
 * Time: 10:42 AM
 */

namespace Sondt87\GzoneLibrary\Utils;

use Illuminate\Console\Command;
use Sondt87\GzoneLibrary\Utils\View\ViewGenerator;
use Symfony\Component\Console\Input\InputArgument;


class MakeViewCommand extends Command{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'util:make_views';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'util:make_views view_name => views/view_name/[all,create,edit,show].blade.php';


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

        $this->line("Created successfully");
        $this->create($name);
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

    private function create($name)
    {
        $path = $this->app['path'];
        $fileSystem = $this->app['files'];
        //gen views
        $generator = new ViewGenerator($path,$fileSystem);
        $generator->gen($name);
    }

} 