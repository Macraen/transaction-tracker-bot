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
        $callbackQuery = $this->getUpdate()->getRawResponse();
        Log::info($callbackQuery);
        $user = $callbackQuery->getFrom();

        $profileInfo = sprintf(
            "ID: %s\nІм'я: %s\nПрізвище: %s\nUsername: @%s",
            $user->getId(),
            $user->getFirstName(),
            $user->getLastName(),
            $user->getUsername()
        );

        $this->replyWithMessage([
            'text' => $profileInfo,
            'chat_id' => $callbackQuery->getMessage()->getChat()->getId(),
        ]);
    }
}
