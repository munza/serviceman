<?php

namespace Munza\Serviceman\Support;

use Joselfonseca\LaravelTactician\CommandBusInterface;

abstract class Service
{
    /**
     * Command Bus Interface.
     *
     * @var \Joselfonseca\LaravelTactician\CommandBusInterface
     */
    protected $bus;

    /**
     * List of registered handlers.
     *
     * @var array
     */
    protected $handlers = [];

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->bus = app(CommandBusInterface::class);

        foreach ($this->handlers as $command => $handler) {
            $this->bus->addHandler($command, $handler);
        }
    }
}
