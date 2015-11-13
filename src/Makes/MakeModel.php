<?php
/**
 * Created by PhpStorm.
 * User: fernandobritofl
 * Date: 4/22/15
 * Time: 10:34 PM
 */

namespace Laralib\L5scaffold\Makes;


use Illuminate\Filesystem\Filesystem;
use Laralib\L5scaffold\Commands\ScaffoldMakeCommand;
use Laralib\L5scaffold\Traits\MakerTrait;
use Laralib\L5scaffold\Contracts\ScaffoldCommandInterface;

class MakeModel {
    use MakerTrait;

    public function __construct(ScaffoldCommandInterface $scaffoldCommand, Filesystem $files)
    {
        $this->files = $files;
        $this->scaffoldCommandObj = $scaffoldCommand;

        $this->start();
    }


    protected function start()
    {

        $name = $this->scaffoldCommandObj->getObjName('Name');
        $modelPath = $this->getPath($name, 'model');

        if (! $this->files->exists($modelPath)) {
            if ($this->scaffoldCommandObj->confirm($modelPath . ' already exists! Do you wish to overwrite? [yes|no]')) {
                // Put file
                $this->files->put($modelPath, $this->compileModelStub($name));
            }
        }else{
            $this->files->put($modelPath, $this->compileModelStub($name));
        }

    }

    protected function compileModelStub($name)
    {
        $modelAndProperties = $this->askForModelAndFields();

        $moreTables = trim($modelAndProperties) == "q" ? false : true;
    }

    private function showInformation()
    {
        $this->info('MyNamespace\Book title:string year:integer');
        $this->info('With relation: Book belongsTo Author title:string published:integer');
        $this->info('Multiple relations: University hasMany Course, Department name:string city:string state:string homepage:string )');
        $this->info('Or group like properties: University hasMany Department string( name city state homepage )');
    }

    /**
     *  Prompt user for model and properties and return result
     *
     * @return string
     */
    private function askForModelAndFields()
    {
        $modelAndFields = $this->command->ask('Add model with its relations and fields or type "q" to quit (type info for examples) ');

        if($modelAndFields == "info")
        {
            $this->showInformation();

            $modelAndFields = $this->scaffoldCommandObj->ask('Now your turn: ');
        }

        return $modelAndFields;
    }
}
