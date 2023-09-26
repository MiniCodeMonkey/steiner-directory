<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PretendTextMessageSendCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'text {message} {--from=+4512345678}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pretend sending text message';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('POST', config('app.url') . ':8000/webhook', [
            'json' => [
                'From' => $this->option('from'),
                'Body' => $this->argument('message')
            ]
        ]);

        echo (string)$res->getBody();
    }
}
