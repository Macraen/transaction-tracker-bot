<?php

namespace App\Commands;

use Illuminate\Support\Facades\Log;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

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
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->setOneTimeKeyboard(true)
            ->row([
                Keyboard::button('1'),
                Keyboard::button('2'),
                Keyboard::button('3'),
            ])
            ->row([
                Keyboard::button('4'),
                Keyboard::button('5'),
                Keyboard::button('6'),
            ]);
        $this->replyWithChatAction([
            'action' => Actions::TYPING
        ]);
        $this->replyWithMessage([
            'text' => 'Welcome to the club body',
            'reply_markup' => $reply_markup
        ]);
    }
}
