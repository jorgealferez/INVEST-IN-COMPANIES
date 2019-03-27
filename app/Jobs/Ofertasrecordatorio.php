<?php

namespace App\Jobs;

use App\Oferta;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Ofertasrecordatorio
{
    use Dispatchable, Queueable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
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
