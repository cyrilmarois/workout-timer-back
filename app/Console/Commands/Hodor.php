<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Cycle;
use App\Models\Sound;
use App\Models\Type;
use Illuminate\Console\Command;

class Hodor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hodor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //dd(Sound::with('round')->firstOrFail()->toArray());
        dd(Cycle::with('sound')->firstOrFail()->toArray());

    }
}
