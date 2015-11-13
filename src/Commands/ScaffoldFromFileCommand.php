<?php

namespace Laralib\L5scaffold\Commands;

use Illuminate\Console\AppNamespaceDetectorTrait;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Composer;
use Laralib\L5scaffold\Makes\MakeController;
use Laralib\L5scaffold\Makes\MakeLayout;
use Laralib\L5scaffold\Makes\MakeMigration;
use Laralib\L5scaffold\Makes\MakeModel;
use Laralib\L5scaffold\Traits\MakerTrait;
use Laralib\L5scaffold\Traits\CommonTrait;
use Laralib\L5scaffold\Makes\MakeSeed;
use Laralib\L5scaffold\Makes\MakeView;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ScaffoldFromFileCommand extends Command {
    use AppNamespaceDetectorTrait, MakerTrait, CommonTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'scaffold:file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Makes table, controller, model, views, seeds, and repository from file";

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {

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
}