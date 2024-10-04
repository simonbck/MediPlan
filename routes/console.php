<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('app:used-medicaments-command', function () {})->purpose('Remove used medicaments')->dailyAt('00:00');
