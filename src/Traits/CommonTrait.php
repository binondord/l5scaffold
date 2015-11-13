<?php

namespace Laralib\L5scaffold\Traits;

use Laralib\L5scaffold\Makes\MakeModel;

trait CommonTrait {
    protected function useUtf8Encoding($argument)
    {
        return iconv(mb_detect_encoding($argument, mb_detect_order(), true), "UTF-8", $argument);
    }

    /**
     * Generate names
     *
     * @param string $config
     * @return mixed
     * @throws \Exception
     */
    public function getObjName($config = 'Name')
    {

        $names = [];
        $args_name = $this->argument('name');


        // Name[0] = Tweet
        $names['Name'] = str_singular(ucfirst($args_name));
        // Name[1] = Tweets
        $names['Names'] = str_plural(ucfirst($args_name));
        // Name[2] = tweets
        $names['names'] = str_plural(strtolower(preg_replace('/(?<!^)([A-Z])/', '_$1', $args_name)));
        // Name[3] = tweet
        $names['name'] = str_singular(strtolower(preg_replace('/(?<!^)([A-Z])/', '_$1', $args_name)));


        if (!isset($names[$config])) {
            throw new \Exception("Position name is not found");
        };


        return $names[$config];


    }

    public function getModelDefinitionFile()
    {
        //do checking here
    }

    /**
     * Generate the desired migration.
     */
    protected function makeMigration()
    {
        new MakeMigration($this, $this->files);
    }


    /**
     * Generate an Eloquent model, if the user wishes.
     */
    protected function makeModel()
    {
        new MakeModel($this, $this->files);
    }


    /**
     * Generate a Seed
     */
    private function makeSeed()
    {
        new MakeSeed($this, $this->files);
    }



    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the model. (Ex: Post)'],
        ];
    }


    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['schema', 's', InputOption::VALUE_REQUIRED, 'Schema to generate scaffold files. (Ex: --schema="title:string")', null],
            ['form', 'f', InputOption::VALUE_OPTIONAL, 'Use Illumintate/Html Form facade to generate input fields', false]
        ];
    }


    /**
     * Make a Controller with default actions
     */
    private function makeController()
    {

        new MakeController($this, $this->files);

    }


    /**
     * Setup views and assets
     *
     */
    private function makeViews()
    {

        foreach ($this->views as $view) {
            // index, create, show, edit
            new MakeView($this, $this->files, $view);
        }


        $this->info('Views created successfully.');

        $this->info('Route::resource("'.$this->getObjName("names").'","'.$this->getObjName("Name").'Controller"); // Add this line in routes.php');

    }

    protected function dumpAutoload()
    {
        $this->info('Dump-autoload...');
        $this->composer->dumpAutoloads();
    }


    /**
     * Make a layout.blade.php with bootstrap
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function makeViewLayout()
    {
        new MakeLayout($this, $this->files);
    }


    /**
     * Get access to $meta array
     * @return array
     */
    public function getMeta()
    {
        return $this->meta;
    }

    protected function prepFire()
    {
        $this->info('Configuring ' . $this->getObjName("Name") . '...');

        // Setup migration and saves configs
        $this->meta['action'] = 'create';
        $this->meta['var_name'] = $this->getObjName("name");
        $this->meta['table'] = $this->getObjName("names"); // Store table name
    }

    protected function prepFileFire()
    {
        $this->info('Scaffold from file starting... ');
    }

    protected function prepUpdateFire()
    {
        $this->info('Scaffold Update starting... ');
    }
}