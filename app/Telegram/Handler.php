<?php

namespace App\Telegram;

use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use Illuminate\Support\Stringable;

class Handler extends WebhookHandler
{
    public function start(): void
    {
        Telegraph::message('Вітаємо!')
            ->replyKeyboard(ReplyKeyboard::make()->buttons([
                Button::make("🗑️ Delete")->action("delete")->param('id', 1),
                Button::make("📖 Mark as Read")->action("read")->param('id', 1),
                Button::make("👀 Open")->url('https://test.it'),
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
