<?php

namespace App\Console\Commands;

use App\Services\TelegramService;
use Illuminate\Console\Command;
use Telegram;

class TelegramInstallWebhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:install-webhook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Telegram install webhook';

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
        $url = config('app.webhook-url');
        $this->info('URL - '.$url);

        try {
            TelegramService::installWebhook();
            $this->info('Web hook is installed!');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }

    }
}
