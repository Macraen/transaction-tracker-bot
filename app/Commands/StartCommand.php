<?php

namespace App\Commands;

use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected string $name = 'start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected string $description = 'Start command';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->replyWithMessage([
            'text' => 'Welcome to the club body'
        ]);
    }
}
