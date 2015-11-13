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

class MakeModel {
    use MakerTrait;

    public function __construct(ScaffoldMakeCommand $scaffoldCommand, Filesystem $files)
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

    }
}
