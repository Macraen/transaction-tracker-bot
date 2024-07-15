<?php

namespace App\Telegram;

use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use Illuminate\Support\Stringable;

class Handler extends WebhookHandler
{
    public function start(): void
    {
        Telegraph::message('Вітаємо!')
            ->replyKeyboard(ReplyKeyboard::make()->buttons([
                ReplyButton::make("🗑️ Delete")->requestPoll(),
                ReplyButton::make("📖 Mark as Read")->requestPoll(),
                ReplyButton::make("👀 Open")->webApp('https://test.it'),
            ])->chunk(2))->send();

    }
    public function profile(): void
    {
        $this->reply('Вітаю!');
    }

    protected function handleUnknownCommand(Stringable $text): void
    {
        $this->reply('Невідома команда (');
    }

    protected function handleChatMessage(Stringable $text): void
    {
        $this->reply('Не розумію про що ти )');
    }
}
