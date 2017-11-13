<?php

namespace App\Console\Commands;

use App\Service\TelegramService;
use Illuminate\Console\Command;

class TelegramUninstallWebhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:uninstall-webhook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Telegram uninstall webhook';

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
        try {
            TelegramService::uninstallWebhook();
            $this->info('Webhook is already deleted');
        }catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
