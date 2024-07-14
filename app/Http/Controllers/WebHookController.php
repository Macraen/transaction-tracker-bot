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
        Log::info('Webhook Status: OK');
        $update = Telegram::commandsHandler(true);

        return response()->json(['status' => 'success']);
    }
}
