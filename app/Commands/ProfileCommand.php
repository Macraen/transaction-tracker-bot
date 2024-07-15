<?php

namespace App\Commands;

use Illuminate\Support\Facades\Log;
use Telegram\Bot\Commands\Command;

class ProfileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected string $name = 'profile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected string $description = 'Інформація про користувача';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
//        $callbackQuery = $this->getUpdate()->getCallbackQuery();
//        $callbackQuery = $this->getUpdate()->getRawResponse();
          $username = $this->getUpdate()->getMessage()->from->username;

        $profileInfo = sprintf(
            "Ви: %s\nДата реєстрації: 25.06.2023",
            $username
        );

        $this->replyWithMessage([
            'text' => $profileInfo,
        ]);
    }
}
