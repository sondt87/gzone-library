<?php
namespace Sondt87\GzoneLibrary\Utils;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ControllerUtilCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'util:make_controller';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create controller in a folder with interface, abs, cms, api of controller';


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
        $this->line("Created controller: '".$name."'");
        $this->createController($name);
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('name', InputArgument::REQUIRED, 'name of controller.'),
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

    private function createController($name)
    {
        $path = $this->app['path'];
        $fileSystem = $this->app['files'];

        //gen interface
        $generator = new InterfaceControllerGenerator($path,$fileSystem);
        $generator->gen($name);

        //base controller
        $generator = new BaseControllerGenerator($path,$fileSystem);
        $generator->gen($name);
        //controller type
        $generator = new ControllerGenerator($path,$fileSystem);

        $generator->gen($name,'API');
        $generator->gen($name,'Frontend');
        $generator->gen($name,'Backend');
    }

}
