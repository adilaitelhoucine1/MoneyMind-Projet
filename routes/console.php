<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('salary:add')->daily();
Schedule::command('app:saving-goals-management')->daily();
Schedule::command('app:check-seuil-budjet')->daily();
Schedule::command('app:wishlist-managament')->daily();
                            