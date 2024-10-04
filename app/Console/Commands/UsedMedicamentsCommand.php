<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UsedMedicamentsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:used-medicaments-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes daily used medicaments from stock';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();

        foreach($users as $user) {
            $this->info("Current user: {$user->username}!");

            $medicaments = $user->medicaments;

            foreach($medicaments as $medicament) {
                $this->info("Current medicament: {$medicament->name}!");
                $dailyUse = $medicament->pieces_morning+$medicament->pieces_midday+$medicament->pieces_evening+$medicament->pieces_night;
                $this->info("Daily use: {$dailyUse}!");
                $medicament->pieces = $medicament->pieces-$dailyUse;
                $medicament->save();
            }
        }
    }
}
