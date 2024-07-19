<?php

namespace App\Telegram;

use App\Models\User;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

class Handler extends WebhookHandler
{
    protected array $patterns = [
        'bitcoin' => '/^1[1-9A-HJ-NP-Za-km-z]{25,34}$|^3[1-9A-HJ-NP-Za-km-z]{25,34}$/',
        'ethereum' => '/^0x[a-fA-F0-9]{40}$/',
        'litecoin' => '/^[LM3][a-km-zA-HJ-NP-Z1-9]{26,33}$/',
        'dogecoin' => '/^D{1}[5-9A-HJ-NP-U]{1}[1-9A-HJ-NP-Za-km-z]{32}$/',
        'bitcoin_cash' => '/^q[a-z0-9]{41}$/',
        'ripple' => '/^r[1-9A-HJ-NP-Za-km-z]{25,34}$/',
        'cardano' => '/^Ae2tdPwUPEYy[0-9A-Za-z]{50,}$/',
        'polkadot' => '/^1[a-km-zA-HJ-NP-Z1-9]{47}$/',
        'binance' => '/^bnb[a-z0-9]{38}$/',
    ];

    public function start(): void
    {
        Telegraph::message('Вітаємо!')
            ->replyKeyboard(ReplyKeyboard::make()->buttons([
                ReplyButton::make("Додати адресу"),
                ReplyButton::make("Всі адреси"),
                ReplyButton::make("Повідомлення"),
                ReplyButton::make("Профіль"),
            ])->resize()->chunk(2))->send();
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
        elseif ($this->walletServices($text)['is_wallet'])
//            $user = User::create([
//                'name' => $request->input('full_name'),
//                'email' => $request->input('email'),
//                'password' => Hash::make(Str::random(16)),
//            ]);
            $this->reply('Адресу успішно додано! Мережа: '.$this->walletServices($text)['network']);
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

    public function walletServices($text): array
    {
        foreach ($this->patterns as $network => $pattern) {
            if (preg_match($pattern, $text)) {
                return [
                    'is_wallet' => true,
                    'network' => $network,
                ];
            }
        }
        return [
            'is_wallet' => false,
            'network' => null,
        ];
    }
}
