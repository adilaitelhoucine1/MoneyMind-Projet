<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Alerte;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'x';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Alerte::create([
            'user_id' => 5,
            'message' => " Attention :Test badrihno",
            'type' => 'budget_bas',
            'est_lu' => false
        ]);
    }
}
