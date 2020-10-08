<?php


namespace App;


class Postcard
{
//    public static function any()
//    {
//        dd('inside');
//    }

    protected static function resolveFacade($name)
    {
//        dd(app()[$name]);
        return app()[$name];
    }

    public static function __callStatic($method, $arguments)
    {
//        dd($method);
        return (self::resolveFacade('Postcard'))
                ->$method(...$arguments);
    }

}
