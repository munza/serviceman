<?php

namespace Munza\Serviceman\Commands;

use Illuminate\Console\Command;
use Munza\Serviceman\Traits\StubFormattable;

class MakeServiceMiddleware extends Command
{
    use StubFormattable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service:middleware {name} {service}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service middleware class';

    /**
     * Type of generator.
     *
     * @var string
     */
    public $generator = "middleware";

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
    public $stub = __DIR__.'/../../resources/stubs/Middleware.stub';

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
}
