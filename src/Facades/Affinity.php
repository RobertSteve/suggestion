<?php

use Illuminate\Support\Facades\Facade;

class Affinity extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'Affinity\AffinityClient';
    }

}