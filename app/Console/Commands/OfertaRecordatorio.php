<?php

namespace App\Console\Commands;

use App\Oferta;
use Carbon\Carbon;
use Illuminate\Console\Command;

class OfertaRecordatorio extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:OfertaRecordatorio';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia un email recordando las ofertas de más de 6 meses';

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
        $ofertas_antiguas=Oferta::where('active', '1')
            ->where('approved', '1')
            ->where("created_at", "<=", Carbon::now()->subMonths(6))
            ->get();

        foreach ($ofertas_antiguas as $oferta) {
            $oferta->NotificacionOfertaRecordatorio();
        }
    }
}
