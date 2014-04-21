<?php namespace Sondt87\GzoneLibrary;

use Illuminate\Support\ServiceProvider;
use Sondt87\GzoneLibrary\Utils\ControllerUtilCommand;
use Sondt87\GzoneLibrary\Utils\MakeAllCommand;
use Sondt87\GzoneLibrary\Utils\MakeModelCommand;
use Sondt87\GzoneLibrary\Utils\RepositoryCommand;

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
        //util:make_controller
        $this->app->bindShared("com.libs.command.utils.controller.make", function($app){

            return new ControllerUtilCommand($app);
        });

        $this->commands("com.libs.command.utils.controller.make");

        //util:make_repository
        $this->app->bindShared("com.libs.command.utils.repository.make", function($app){

            return new RepositoryCommand($app);
        });

        $this->commands("com.libs.command.utils.repository.make");

        //util:make_model
        $this->app->bindShared("com.libs.command.utils.model.make", function($app){

            return new MakeModelCommand($app);
        });

        $this->commands("com.libs.command.utils.model.make");

        //util:make_all
        $this->app->bindShared("com.libs.command.utils.all.make", function($app){

            return new MakeAllCommand($app);
        });

        $this->commands("com.libs.command.utils.all.make");
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
