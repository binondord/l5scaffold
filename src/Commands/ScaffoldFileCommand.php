<?php namespace Laralib\L5scaffold\Commands;

use Illuminate\Console\AppNamespaceDetectorTrait;
use Illuminate\Foundation\Composer;
use Laralib\L5scaffold\Makes\MakeController;
use Laralib\L5scaffold\Makes\MakeLayout;
use Laralib\L5scaffold\Makes\MakeMigration;
use Laralib\L5scaffold\Makes\MakeModel;
use Laralib\L5scaffold\Traits\CommonTrait;
use Laralib\L5scaffold\Makes\MakeSeed;
use Laralib\L5scaffold\Makes\MakeView;
use Laralib\L5scaffold\Migrations\Scaffold;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Laralib\L5scaffold\Contracts\ScaffoldCommandInterface;

class ScaffoldFileCommand extends ScaffoldCommand implements ScaffoldCommandInterface
{
    use AppNamespaceDetectorTrait, CommonTrait;

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
        $scaffold = new Scaffold($this);

        $this->info('Please wait while all your files are generated...');

        $scaffold->createModelsFromFile($this->argument('file'));

        $this->info('Finishing...');

        $this->call('clear-compiled');

        $this->call('optimize');

        $this->info('Done!');

        /*
        $this->prepFileFire();

        $this->dumpAutoload();
        */
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['file', InputArgument::REQUIRED, 'The filename of the model definition.'],
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