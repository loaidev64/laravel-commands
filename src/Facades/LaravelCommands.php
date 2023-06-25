<?php

namespace LoaiDev64\LaravelCommands\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LoaiDev64\LaravelCommands\LaravelCommands
 */
class LaravelCommands extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LoaiDev64\LaravelCommands\LaravelCommands::class;
    }
}
