<?php

namespace App\Telegram;

use DefStudio\Telegraph\Handlers\WebhookHandler;

class Handler extends WebhookHandler
{
    public function profile(): void
    {
        $this->reply('ПРОБИЛА');
    }
}
