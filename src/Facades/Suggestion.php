<?php

namespace Suggestion\Facades;

use Illuminate\Support\Facades\Facade;

class Suggestion extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'Suggestion\SuggestionClient';
    }

}