<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Telegram\Bot\BotsManager;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Laravel\Facades\Telegram;

class WebHookController extends Controller
{
    private BotsManager $botsManager;

    public function __construct(BotsManager $botsManager)
    {
        $this->botsManager = $botsManager;
    }

    /**
     * Handle the incoming request.
     * @throws TelegramSDKException
     */
    public function webhook(Request $request): \Illuminate\Http\JsonResponse
    {
//        $webhook = $this->botsManager->bot()->commandsHandler(true);
        $update = Telegram::commandsHandler(true);

        if ($update->isType('callback_query')) {
            $callbackQuery = $update->getCallbackQuery();
            $data = $callbackQuery->getData();
            $message = $callbackQuery->getMessage();

            if ($data === 'profile') {
                $user = $callbackQuery->getFrom();

                $profileInfo = sprintf(
                    "ID: %s\nІм'я: %s\nПрізвище: %s\nUsername: @%s",
                    $user->getId(),
                    $user->getFirstName(),
                    $user->getLastName(),
                    $user->getUsername()
                );

                Telegram::sendMessage([
                    'chat_id' => $message->getChat()->getId(),
                    'text' => $profileInfo,
                ]);
            }
        }

        return response()->json(['status' => 'success']);
    }
}
