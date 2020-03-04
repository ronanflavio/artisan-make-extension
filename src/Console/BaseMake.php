<?php

namespace Ronanflavio\ArtisanMakeExtension\Console;

use Illuminate\Console\Command;

abstract class BaseMake extends Command
{
    protected $basePath;

    protected $stubName;

    public function make(string $basePath, string $stubName)
    {
        $this->basePath = $basePath;
        $this->stubName = $stubName;

        $this->setAbstracts();

        $stub = $this->setStub();
        $namespace = $this->getNamespace();
        $className = $this->getClassName();
        $content = $this->setContent($stub, $namespace, $className);
        $this->createFile($content);
    }

    protected function setAbstracts()
    {
        $path = app_path($this->basePath);
        $fileName = $this->defineBaseFileName();

        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }

        if (!file_exists($path . DIRECTORY_SEPARATOR . $fileName)) {
            $stubName = $this->stubName . '-base';
            $contents = $this->setStub($stubName);
            file_put_contents($path . DIRECTORY_SEPARATOR . $fileName, $contents, 0);
        }
    }

    protected function defineBaseFileName()
    {
        switch ($this->stubName) {
            case 'services':
                return 'Service.php';
            case 'dto':
                return 'DataTransferObject.php';
            case 'repository':
                return 'Repository.php';
            default:
                return null;
        }
    }

    protected function createFile(string $content)
    {
        $context = $this->getContext();
        $path = empty($context) ? $this->basePath : $this->basePath . DIRECTORY_SEPARATOR . $context;
        $file = $this->getClassName() . '.php';
        $pathFile = $path . DIRECTORY_SEPARATOR . $file;

        if (is_dir(app_path($path))) {

            if (!file_exists(app_path($pathFile))) {
                file_put_contents(app_path($pathFile), $content, 0);
            }
        } else {
            mkdir(app_path($path), 0755, true);
            file_put_contents(app_path($pathFile), $content, 0);
        }
    }

    protected function setContent(string $stub, string $namespace, string $classname)
    {
        return str_replace(
            [ 'DummyNamespace', 'DummyClassName' ],
            [ $namespace, $classname ],
            $stub
        );
    }

    protected function getClassName()
    {
        $fullName = explode(DIRECTORY_SEPARATOR, $this->argument('name'));
        return $fullName[sizeof($fullName) - 1];
    }

    protected function getNamespace()
    {
        $namespace = 'App\\' . $this->basePath;
        $context = $this->getContext();
        return empty($context) ? $namespace : $namespace . '\\' . $context;
    }

    protected function getContext()
    {
        $fullName = explode(DIRECTORY_SEPARATOR, $this->argument('name'));
        $context = '';

        if (sizeof($fullName) > 1) {
            foreach ($fullName as $key => $item) {
                /** Indicates the namespace */
                if ($key < sizeof($fullName) - 1) {
                    $context .= empty($context) ? $item : '\\' . $item;
                }
            }
        }

        return $context;
    }

    protected function setStub($stubName = null)
    {
        $stubName = empty($stubName)
            ? $this->stubName
            : $stubName;

        $path = __DIR__
            . DIRECTORY_SEPARATOR
            . 'stubs'
            . DIRECTORY_SEPARATOR
            . $stubName
            . '.stub.php';

        return file_get_contents($path);
    }
}
