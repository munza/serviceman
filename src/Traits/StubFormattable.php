<?php

namespace Munza\Serviceman\Traits;

trait StubFormattable
{
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->checkFileExists();
        $this->loadTemplateFromStub();
        $this->replaceVariablesInTemplate();
        $this->createFileFromTemplate();

        $this->info(ucwords($this->generator).' created.');
    }

    /**
     * Generate target file path.
     *
     * @return string
     */
    private function getTargetFilePath()
    {
        return $this->generateTargetFilePath($this->generator, $this->getFileName());
    }

    /**
     * Generate target file path name for a path type and filename.
     *
     * @param  string  $pathType
     * @param  string  $fileName
     * @return string
     */
    private function generateTargetFilePath($pathType, $fileName)
    {
        return $this->replaceVariablesInPath(
            $this->joinPaths([
                config('serviceman.generator.basePath'),
                config('serviceman.generator.paths.'.$pathType),
                $fileName.'.php',
            ])
        );
    }

    /**
     * Join path array and return full path string.
     *
     * @param  array   $paths
     * @return string
     */
    private function joinPaths(array $paths)
    {
        return str_replace("\\", "/", implode("/", $paths));
    }

    /**
     * Replace variables in the full path.
     *
     * @param  string   $path
     * @return string
     */
    private function replaceVariablesInPath($path)
    {
        foreach ($this->variables as $variable)
        {
            $value = $variable == "name"
                     ? $this->getFileName()
                     : $this->argument($variable);

            $path = str_replace('{{ '.$variable.' }}', $value, $path);
        }

        return $path;
    }

    /**
     * Check and alert if target file already exists.
     *
     * @return void
     */
    private function checkFileExists()
    {
        if (file_exists($this->getTargetFilePath())) {
            $this->info('File already exists!');
            exit();
        }
    }

    /**
     * Create file from template.
     *
     * @return void
     */
    private function createFileFromTemplate()
    {
        if (! file_exists($this->getTargetDirectoryPath())) {
            \File::makeDirectory($this->getTargetDirectoryPath(), 0755, true);
        }

        file_put_contents($this->getTargetFilePath(), $this->template);
    }

    /**
     * Load template string from stub file.
     *
     * @return void
     */
    private function loadTemplateFromStub()
    {
        $this->template = file_get_contents($this->stub);
    }

    /**
     * Replace variables in the template string.
     *
     * @return void
     */
    private function replaceVariablesInTemplate()
    {
        if ($this->template != "") {
            foreach ($this->variables as $variable)
            {
                $value = $variable == "name"
                         ? $this->getFileName()
                         : $this->argument($variable);

                $this->template = str_replace('{{ '.$variable.' }}', $value, $this->template);
            }
        }
    }

    /**
     * Get the directory of the targeted file.
     *
     * @return string
     */
    private function getTargetDirectoryPath()
    {
        $explodedPath = explode("/", $this->getTargetFilePath());
        $fileName = array_pop($explodedPath);

        return implode("/", $explodedPath);
    }

    /**
     * Return the filename by prepending and appending.
     *
     * @return string
     */
    private function getFileName()
    {
        return $this->prepend.$this->argument('name').$this->append;
    }
}
