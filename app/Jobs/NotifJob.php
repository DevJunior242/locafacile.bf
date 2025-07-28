<?php

namespace App\Jobs;

use App\Models\Livreur;
use App\Models\Publish;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\LivraisonNotification;

class NotifJob implements ShouldQueue
{
    use  Queueable, Dispatchable,  SerializesModels, SerializesModels, InteractsWithQueue;

    /**
     * Create a new job instance.
     */
    protected $publish;
    public function __construct(Publish $publish)
    {
        $this->publish = $publish;
        Log::info('notif job created', [
            'publish' => $publish->id
        ]);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
         Log::info('notif handle job ', [
            'publish' => $this->publish->id,
            'user' => $this->publish->user->id
        ]);

        //job 
          Livreur::where('ville', $this->publish->ville)
                    ->chunkById(count: 50, callback: function ($livreurs){
                        $startTime = microtime(true);
                        $memoryUse = memory_get_usage();
                        foreach ($livreurs as $livreur) {
                            $livreur->user->notify(new LivraisonNotification($this->publish));
                        }

                        //temps de traitement  
                        $endTime = microtime(true);
                        $endMemory = memory_get_usage();

                        $duration = round($endTime - $startTime, 2);
                        $memoryUsage = round(($endMemory - $memoryUse) / 1024 / 1024, 2);

                        Log::info('notif send to users', [
                            'livreurs' => $livreurs->count(),
                            'duration' => $duration . 'seconds',
                            'memoryusage' => $memoryUsage . 'MB',
                        ]);
                    });
    }
}
