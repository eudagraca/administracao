<?php

namespace App\Console;

use App\Tarefas;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $tarefas = Tarefas::whereHas('requisicaoTransporte', function (Builder $query) {
                $query->whereHas('preRequisicao', function (Builder $builder) {

                })->whereDate('dia_exata', '<=', Carbon::now());
            })->where('status', 0)->get();

            foreach ($tarefas as $tarefa) {
                $ob = $tarefa->requisicaoTransporte->preRequisicao;
                $ob->estado = "atrasada";
                $ob->save();
            }
        })->timezone('Africa/Maputo')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
