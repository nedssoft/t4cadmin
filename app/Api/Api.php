<?php

namespace T4C\Api;

use Illuminate\Container\Container;

abstract class Api {

    /**
     * Container instance.
     *
     * @var Container
     */
    protected $app;

    /**
     * Component constructor.
     *
     * @param Container $app
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    /**
     * Get the name of the plug in
     *
     * @return string
     */
    abstract public function name();
}