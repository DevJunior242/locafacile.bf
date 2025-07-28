<?php

namespace App\Jobs;

use App\Models\Publish;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
 
class UpdatePublishJob implements ShouldQueue
{
    use  Queueable, Dispatchable,  SerializesModels, SerializesModels, InteractsWithQueue;

    /**
     * Create a new job instance.
     */
    protected $event;
    protected $status;
    public function __construct($event, $status)
    {
        $this->event = $event;
        $this->status = $status;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $transaction =  $this->event->data->object;
        $publishId = $transaction->metadata['publish_id'] ?? null;
        if (!$publishId) {
            Log::warning('fedapay webhook', ['error' => 'no publis_id']);
            return;
        }
        $publish = Publish::find($publishId);
        if (!$publish) {
            Log::warning('fedapay webhook', ['error' => 'no publish found']);
            return;
        }

        $publish->status = $this->status;
        $publish->save();
        Log::info('status updated', [
            'publish' => $publish,
        ]);
    }
}
