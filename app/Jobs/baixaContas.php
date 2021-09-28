<?php

namespace App\Jobs;

use App\Http\Controllers\Register\ContasRegister;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Contas_a_Pagar;


class baixaContas implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Contas_a_Pagar $contas)
    {
        $this->contas = $contas;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Contas_a_Pagar $contas)
    {
        $this->app->bindMethod([ContasRegister::class, 'baixaContas'], function ($job, $app) {
            return $job->handle($app->make(ContasRegister::class));
        });
    }
}
