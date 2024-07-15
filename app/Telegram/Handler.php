<?php

namespace App\Telegram;

use DefStudio\Telegraph\Handlers\WebhookHandler;

class Handler extends WebhookHandler
{
    public function aboutMe(): void
    {
        $this->reply('ПРОБИЛА');
    }
}
