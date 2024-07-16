<?php

namespace App\Telegram;

use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Support\Stringable;

class Handler extends WebhookHandler
{
    public function start(): void
    {
        Telegraph::message('Вітаємо!')
            ->replyKeyboard(ReplyKeyboard::make()->buttons([
                ReplyButton::make("Додати адресу"),
                ReplyButton::make("Всі адреси"),
                ReplyButton::make("Повідомлення"),
                ReplyButton::make("Профіль"),
            ])->chunk(2))->send();

    }

    protected function handleUnknownCommand(Stringable $text): void
    {
        $this->reply('Невідома команда (');
    }

    protected function handleChatMessage(Stringable $text): void
    {
        if ($text == "Профіль")
            $this->profile();
        elseif ($text == "Додати адресу")
            $this->addAddress();
        else
            $this->reply('Не розумію про що ти (');
    }

    public function profile(): void
    {
        $this->reply('Вітаю!');
    }

    public function addAddress(): void
    {
        $this->reply('Введіть адресу гаманця');
    }
}
