<?php
use Illuminate\Support\Facades\Schedule;

Schedule::command('app:used-medicaments-command')->dailyAt('00:00');
