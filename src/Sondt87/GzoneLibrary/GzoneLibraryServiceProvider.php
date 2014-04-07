<?php namespace Sondt87\GzoneLibrary;

use Illuminate\Support\ServiceProvider;
use Sondt87\GzoneLibrary\Utils\ControllerUtilCommand;

class GzoneLibraryServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
    private function registerCommand()
    {
        $this->app->bindShared("com.libs.command.utils.controller.make", function($app){

            return new ControllerUtilCommand($app);
        });

        $this->commands("com.libs.command.utils.controller.make");
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('sondt87.gzone.library');
    }

    public function boot(){
        $this->package("sondt87/gzone-library");
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommand();
    }
}
