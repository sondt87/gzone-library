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
        $this->line("Start create controller: ".$name);

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
//			array('path', InputArgument::OPTIONAL, 'path to locate.'),
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
//			array('name', null, InputOption::VALUE_REQUIRED, 'Name of controller', null),
			array('path', null, InputOption::VALUE_REQUIRED, 'path to folder', null),
		);
	}

    private function createController($name)
    {
        $path = $this->app['path'].'/controllers';

        $generator = new ControllerGenerator($name,$this->app['files']);
        $generator->gen($path);
    }

}
