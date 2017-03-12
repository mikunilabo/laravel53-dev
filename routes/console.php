<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

/**
 * Laravel Default Command...
 */
Artisan::command('inspire', function (){
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

/**
 * Refresh...
 */
Artisan::command('refresh', function (){
    $this->call('config:cache');
    $this->call('route:cache');
    $this->call('view:clear');
    $this->call('optimize');
})->describe('Do Refresh Commands!');
