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
        $this->publishes([
            __DIR__.'/config/l5scaffold.php' => config_path('l5scaffold.php'),
        ],'config');

        $this->publishes([
            __DIR__.'/templates/' => base_path('resources'),
        ],'templates');

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
	 * Register the commands.
	 */
    private function registerScaffoldGenerator()
    {
        $nameBase = 'command.larascaf.';
        $namespace = 'Laralib\\L5scaffold\\Commands\\';

        $commands = [
            'make',
            'model',
            'update',
            'file',
        ];

        foreach($commands as $command)
        {
            $class = $namespace.'Scaffold'.ucfirst($command).'Command';
            $bindname = $nameBase.'scaffold'.$command;
            $this->app->singleton($bindname, function ($app) use($class){
                return $app[$class];
            });

            $this->commands($bindname);
        }
    }

}

