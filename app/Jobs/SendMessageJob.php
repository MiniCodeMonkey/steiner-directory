<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\RateLimiter;

class SendMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Client $twilioClient;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $phone, public string $message) {}

    /**
     * Execute the job.
     */
    public function handle(Client $twilioClient): void
    {
        $this->twilioClient = $twilioClient;

        $fromNumber = config('services.twilio.from_number');

        $executed = RateLimiter::attempt(
            'send-message:'.$this->phone,
            5,
            $this->sendMessageHandler()
        );

        if (!$executed) {
            info('Rate limit exceeded for ' . $this->phone);
        }
    }

    private function sendMessageHandler() {
        return function() {
            $fromNumber = config('services.twilio.from_number');
            info('To: ' . $this->phone . ' => ' . $this->message);

            if (!config('app.debug')) {
                $this->twilioClient->messages->create(
                    $phone,
                    [
                        'from' => $fromNumber,
                        'body' => $this->message
                    ]
                );
            }
        };
    }
}
