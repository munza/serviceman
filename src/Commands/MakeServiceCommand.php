<?php

namespace Munza\Serviceman\Commands;

use Illuminate\Console\Command;
use Munza\Serviceman\Traits\StubFormattable;

class MakeServiceCommand extends Command
{
    use StubFormattable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service:command {name} {service} {-- no-handler : generate command without handler}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service command class';

    /**
     * Type of generator.
     *
     * @var string
     */
    public $generator = "command";

    /**
     * Template string.
     * Will not be overwritten with stub if it is not empty.
     *
     * @return string
     */
    public $template = "";

    /**
     * Location of stub file.
     * Will be ignored if $this->template is not empty.
     *
     * @return string
     */
    public $stub = __DIR__.'/../../resources/stubs/Command.stub';

    /**
     * List of variables to be replaced in template with command arguments.
     *
     * @return array
     */
    public $variables = [
        'name',
        'service',
    ];

    /**
     * String to prepend before filename.
     *
     * @var string
     */
    public $prepend = "";

    /**
     * String to append after filename before extension.
     *
     * @var string
     */
    public $append = "";

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

        $this->info('Command created.');

        if (! $this->option('no-handler')) {
            $this->call('make:service:handler', [
                'name'         => $this->argument('name').'Handler',
                'command-name' => $this->argument('name'),
                'service'      => $this->argument('service'),
            ]);
        }
    }
}
