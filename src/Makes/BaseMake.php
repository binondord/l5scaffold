<?php namespace Laralib\L5scaffold\Makes;

use Laralib\L5scaffold\Contracts\ScaffoldCommandInterface;
use Illuminate\Filesystem\Filesystem;

class BaseMake
{
	/**
     * The Filesystem instance.
     *
     * @var $files
     */
    protected $files;

	/**
     * The ScaffoldCommandInterface instance.
     *
     * @var $command
     */
    protected $scaffoldCommandObj;

	function __construct(ScaffoldCommandInterface $command, Filesystem $files)
    {
    	$this->files = $files;
        $this->command = $command;
    }
}