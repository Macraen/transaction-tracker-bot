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
//        Telegraph::message('Вітаємо!')
//            ->replyKeyboard(ReplyKeyboard::make()->buttons([
//                ReplyButton::make("📖 Mark as Read")->requestPoll(),
//                ReplyButton::make("👀 Profile"),
//            ])->chunk(2))->send();
        Telegraph::message('hello world')
            ->replyKeyboard(ReplyKeyboard::make()->buttons([
                Button::make('Delete')->action('delete')->param('id', '42'),
                Button::make('open')->url('https://test.it'),
                Button::make('Web App')->webApp('https://web-app.test.it'),
                Button::make('Login Url')->loginUrl('https://loginUrl.test.it'),
            ]))->send();

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
