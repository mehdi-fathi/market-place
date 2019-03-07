<?php
// app/Facades/SomeExampleClass.php.
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class ApiOutputMaker extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ApiOutputMaker';
    }
}
