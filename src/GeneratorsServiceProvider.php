<?php

namespace Laralib\L5scaffold;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;

class GeneratorsServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//

	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{

		$this->registerScaffoldGenerator();

	}


	/**
	 * Register the make:scaffold generator.
	 */
	private function registerScaffoldGenerator()
	{
        $nameBase = 'command.larascaf.';
        $namespace = 'Laralib\\L5scaffold\\Commands\\';

        $cmds = [
            'scaffoldmake' => 'ScaffoldMakeCommand',
            'scaffoldmodel' => 'ScaffoldModelCommand',
            'scaffoldupdate' => 'ScaffoldUpdateCommand',
            'scaffoldfile' => 'ScaffoldFileCommand',
        ];

        foreach($cmds as $name => $className)
        {
            $class = $namespace.$className;
            $bindname = $nameBase.$name;
            $this->app->singleton($bindname, function ($app) use($class){
                return $app[$class];
            });

            $this->commands($bindname);
        }
	}


}
