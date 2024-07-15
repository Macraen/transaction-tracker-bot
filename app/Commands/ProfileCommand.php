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
        $firstname = $this->getUpdate()->getMessage()->from->first_name;

        $profileInfo = sprintf(
            "IНФОРМАЦІЯ ПРО АККАУНТ\n\nІм'я: %s\nЛогін: %s\nДата реєстрації: 25.06.2023",
            $firstname, $username
        );

        $this->replyWithMessage([
            'text' => $profileInfo,
        ]);
    }
}
